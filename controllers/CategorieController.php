<?php

namespace App\Controllers;

use App\Models\Categorie;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class CategorieController
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
            $categorie = new Categorie();
            $categories = $categorie->select(); // Récupère toutes les catégories

            if ($categories) {
                return View::render('categories/index', ['categories' => $categories]);
            } else {
                return View::render('error', ['msg' => 'Impossible de récupérer les catégories']);
            }
        }
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $categorie = new Categorie();
            $categorieData = $categorie->selectId($data['id']); // Récupère une catégorie par son ID

            if ($categorieData) {
                return View::render('categories/show', ['categorie' => $categorieData]);
            } else {
                return View::render('error', ['msg' => 'Impossible de trouver cette catégorie']);
            }
        }
        return View::render('error');
    }

    public function create()
    {
        return View::render('categories/create');
    }

    public function store($data)
    {
        $validator = new Validator();
        $validator->field('name', $data['name'])->min(2)->max(150)->required();
        $validator->field('artworks_id', $data['artworks_id'], 'Artwork')->required()->number();

        if ($validator->isSuccess()) {
            $categorie = new Categorie();
            $insert = $categorie->insert($data); // Insère une catégorie dans la base de données

            if ($insert) {
                return View::redirect('categories');
            } else {
                return View::render('error', ['msg' => 'Échec de la création de la catégorie']);
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('categories/create', ['errors' => $errors, 'inputs' => $data]);
        }
    }

    public function edit($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $categorie = new Categorie();
            $categorieData = $categorie->selectId($data['id']); // Récupère une catégorie par son ID

            if ($categorieData) {
                return View::render('categories/edit', ['categorie' => $categorieData]);
            } else {
                return View::render('error', ['msg' => 'Impossible de trouver cette catégorie']);
            }
        }
        return View::render('error');
    }

    public function update($data = [], $get = [])
    {
        if (isset($get['id']) && $get['id'] != null) {
            $validator = new Validator();
            $validator->field('name', $data['name'])->min(2)->max(150)->required();
            $validator->field('artworks_id', $data['artworks_id'], 'Artwork')->required()->number();

            if ($validator->isSuccess()) {
                $categorie = new Categorie();
                $update = $categorie->update($data, $get['id']); // Met à jour une catégorie par son ID

                if ($update) {
                    return View::redirect('categories/show?id=' . $get['id']);
                } else {
                    return View::render('error', ['msg' => 'Échec de la mise à jour de la catégorie']);
                }
            } else {
                $errors = $validator->getErrors();
                return View::render('categories/edit', ['errors' => $errors, 'inputs' => $data]);
            }
        }
        return View::render('error');
    }

    public function delete($data)
    {
        if (isset($data['id']) && $data['id'] != null) {
            $categorie = new Categorie();
            $delete = $categorie->delete($data['id']); // Supprime une catégorie par son ID

            if ($delete) {
                return View::redirect('categories');
            } else {
                return View::render('error', ['msg' => 'Échec de la suppression de la catégorie']);
            }
        }
        return View::render('error');
    }
}