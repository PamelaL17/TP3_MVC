<?php

namespace App\Controllers;

use App\Models\Artist;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;
use App\Controllers\UserController;

class ArtistController
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
            $artist = new Artist();
            $artists = $artist->select(); // Récupère tous les artistes

            if ($artists) {
                return View::render('artists/index', ['artists' => $artists]);
            } else {
                return View::render('error', ['msg' => 'Impossible de récupérer les artistes']);
            }
        }
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $artist = new Artist();
            $artistData = $artist->selectId($data['id']); // Récupère un artiste par son ID

            if ($artistData) {
                return View::render('artists/show', ['artist' => $artistData]);
            } else {
                return View::render('error', ['msg' => 'Impossible de trouver cet artiste']);
            }
        }
        return View::render('error');
    }

    public function create()
    {
        return View::render('artists/create');
    }

    public function store($data)
    {
        $validator = new Validator();
        $validator->field('name', $data['name'])->min(2)->max(50);
        $validator->field('biography', $data['biography'])->required();

        if ($validator->isSuccess()) {
            $artist = new Artist();
            $insert = $artist->insert($data); // Insère un artiste dans la base de données

            if ($insert) {
                return View::redirect('artists');
            } else {
                return View::render('error', ['msg' => 'Échec de la création de l\'artiste']);
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('artists/create', ['errors' => $errors, 'inputs' => $data]);
        }
    }

    public function edit($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $artist = new Artist();
            $artistData = $artist->selectId($data['id']); // Récupère un artiste par son ID

            if ($artistData) {
                return View::render('artists/edit', ['artist' => $artistData]);
            } else {
                return View::render('error', ['msg' => 'Impossible de trouver cet artiste']);
            }
        }
        return View::render('error');
    }

    public function update($data = [], $get = [])
    {
        if (isset($get['id']) && $get['id'] != null) {
            $validator = new Validator();
            $validator->field('name', $data['name'])->min(2)->max(50);
            $validator->field('biography', $data['biography'])->required();

            if ($validator->isSuccess()) {
                $artist = new Artist();
                $update = $artist->update($data, $get['id']); // Met à jour un artiste par son ID

                if ($update) {
                    return View::redirect('artists/show?id=' . $get['id']);
                } else {
                    return View::render('error', ['msg' => 'Échec de la mise à jour de l\'artiste']);
                }
            } else {
                $errors = $validator->getErrors();
                return View::render('artists/edit', ['errors' => $errors, 'inputs' => $data]);
            }
        }
        return View::render('error');
    }

    public function delete($data)
    {
        if (isset($data['id']) && $data['id'] != null) {
            $artist = new Artist();
            $delete = $artist->delete($data['id']); // Supprime un artiste par son ID

            if ($delete) {
                return View::redirect('artists');
            } else {
                return View::render('error', ['msg' => 'Échec de la suppression de l\'artiste']);
            }
        }
        return View::render('error');
    }
}