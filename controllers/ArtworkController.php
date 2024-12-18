<?php 

namespace App\Controllers;

use App\Models\Artwork;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class ArtworkController
{
    public function __construct(){
        Auth::session();
        if (!Auth::checkUserSession()) {
            $userController = new UserController();
            $userController->createGuestUser();
        }
        // Enregistrer la visite de la page
        $logController = new LogController();
        $logController->store(['visited_page' => $_SERVER['REQUEST_URI']]);
    }

    public function index()
    {
        if(Auth::checkUserSession()){
            $artwork = new Artwork();
            $artworks = $artwork->select(); // Récupère toutes les œuvres

            if ($artworks) {
                return View::render('artworks/index', ['artworks' => $artworks]);
            } else {
                return View::render('error', ['msg' => 'Impossible de récupérer les œuvres']);
            }
        }
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $artwork = new Artwork();
            $artworkData = $artwork->selectWithCategory($data['id']); // Récupère une œuvre avec son artiste et sa catégorie

            if ($artworkData) {
                return View::render('artworks/show', ['artwork' => $artworkData]);
            } else {
                return View::render('error', ['msg' => 'Impossible de trouver cette œuvre']);
            }
        }
        return View::render('error');
    }

    public function create()
    {
        return View::render('artworks/create');
    }

    public function store($data)
    {
        // Vérification de l'image
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['image']['tmp_name'];
            $imageName = basename($_FILES['image']['name']);
            $uploadDir = 'uploads/';
            $imagePath = $uploadDir . $imageName;

            if (move_uploaded_file($imageTmpPath, $imagePath)) {
                $data['image'] = $imageName;
            }
        }

        // Validation et insertion
        $validator = new Validator();
        $validator->field('title', $data['title'])->min(2)->max(150);
        $validator->field('description', $data['description'])->required();
        $validator->field('artists_id', $data['artists_id'], 'Artist')->required()->number();

        if ($validator->isSuccess()) {
            $artwork = new Artwork();
            $insert = $artwork->insert($data); // Insère une œuvre dans la base de données

            if ($insert) {
                return View::redirect('artworks');
            } else {
                return View::render('error', ['msg' => 'Échec de la création de l\'œuvre']);
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('artworks/create', ['error' => $errors, 'inputs' => $data]);
        }
    }

    public function edit()
    {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            View::render('error');
            return;
        }

        $id = $_GET['id'];
        $artwork = Artwork::findById($id); // Appel statique de la méthode findById

        if (!$artwork) {
            View::render('error');
            return;
        }

        $artwork['title'] = $_POST['title'] ?? $artwork['title'];
        $artwork['description'] = $_POST['description'] ?? $artwork['description'];
        $artwork['artists_id'] = $_POST['artists_id'] ?? $artwork['artists_id'];

        // Traitement de l'upload de l'image
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $imagePath = $this->uploadImage($_FILES['image']);
            if ($imagePath) {
                $artwork['image'] = $imagePath;
            }
        }

        $this->saveArtwork($artwork);

        View::redirect('artworks/show?id=' . $artwork['id']);
    }
    

    public function update($data = [], $get = [])
    {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['image']['tmp_name'];
            $imageName = basename($_FILES['image']['name']);
            $uploadDir = 'uploads/';
            $imagePath = $uploadDir . $imageName;

            if (move_uploaded_file($imageTmpPath, $imagePath)) {
                $data['image'] = $imageName;
            }
        }

        // Validation et mise à jour
        $validator = new Validator();
        $validator->field('title', $data['title'])->min(2)->max(150);
        $validator->field('description', $data['description'])->required();
        $validator->field('artists_id', $data['artists_id'], 'Artist')->required()->number();

        if ($validator->isSuccess()) {
            $artwork = new Artwork();
            $update = $artwork->update($data, $get['id']); // Met à jour une œuvre par son ID

            if ($update) {
                return View::redirect('artworks/show?id=' . $get['id']);
            } else {
                return View::render('error', ['msg' => 'Échec de la mise à jour de l\'œuvre']);
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('artworks/edit', ['error' => $errors, 'inputs' => $data]);
        }
    }

    public function delete($data)
    {
        if (isset($data['id']) && $data['id'] != null) {
            $artwork = new Artwork();
            $delete = $artwork->delete($data['id']); // Supprime une œuvre par son ID

            if ($delete) {
                return View::redirect('artworks');
            } else {
                return View::render('error', ['msg' => 'Échec de la suppression de l\'œuvre']);
            }
        }
        return View::render('error');
    }

    private function uploadImage($image) {
        $uploadDirectory = __DIR__ . '/../uploads/';
        $imageName = basename($image['name']);
        $uploadFile = $uploadDirectory . $imageName;

        // Vérifier si le fichier peut être déplacé dans le dossier uploads
        if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
            return $imageName;  // Retourner le nom du fichier image
        }

        return false;  // Si l'upload echoue
    }

    private function saveArtwork($artwork)
    {
        $artworkModel = new Artwork();

        $updateData = [
            'title' => $artwork['title'],
            'description' => $artwork['description'],
            'artists_id' => $artwork['artists_id'],
            'image' => $artwork['image'] ?? null // Si l'image existe, on l'ajoute, sinon on la laisse à null
        ];

        // Mise à jour de l'œuvre
        return $artworkModel->update($updateData, $artwork['id']);
    }
}