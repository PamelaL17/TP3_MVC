<?php

namespace App\Controllers;

use App\Models\Exhibition;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class ExhibitionController
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
            $exhibition = new Exhibition();
            $exhibitions = $exhibition->select(); // Récupère toutes les expositions

            if ($exhibitions) {
                return View::render('exhibitions/index', ['exhibitions' => $exhibitions]);
            } else {
                return View::render('error', ['msg' => 'Impossible de récupérer les expositions']);
            }
        }
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $exhibition = new Exhibition();
            $exhibitionData = $exhibition->selectWithArtist($data['id']); // Récupère l'exposition avec l'artiste

            if ($exhibitionData) {
                return View::render('exhibitions/show', ['exhibition' => $exhibitionData]);
            } else {
                return View::render('error', ['msg' => 'Impossible de trouver cette exposition']);
            }
        }
        return View::render('error');
    }

    public function create()
    {
        return View::render('exhibitions/create');
    }

    public function store($data)
    {
        $validator = new Validator();
        $validator->field('name', $data['name'])->min(2)->max(150);
        $validator->field('date', $data['date'])->required();
        $validator->field('artist_id', $data['artist_id'], 'Artist')->required()->number();

        if ($validator->isSuccess()) {
            $exhibition = new Exhibition();
            $insert = $exhibition->insert($data); // Insère une exposition dans la base de données

            if ($insert) {
                return View::redirect('exhibitions');
            } else {
                return View::render('error', ['msg' => 'Échec de la création de l\'exposition']);
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('exhibitions/create', ['errors' => $errors, 'inputs' => $data]);
        }
    }

    public function edit($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $exhibition = new Exhibition();
            $exhibitionData = $exhibition->selectId($data['id']); // Récupère une exposition par son ID

            if ($exhibitionData) {
                return View::render('exhibitions/edit', ['exhibition' => $exhibitionData]);
            } else {
                return View::render('error', ['msg' => 'Impossible de trouver cette exposition']);
            }
        }
        return View::render('error');
    }

    public function update($data = [], $get = [])
    {
        if (isset($get['id']) && $get['id'] != null) {
            $validator = new Validator();
            $validator->field('name', $data['name'])->min(2)->max(150);
            $validator->field('date', $data['date'])->required();
            $validator->field('artists_id', $data['artists_id'], 'Artist')->required()->number();

            if ($validator->isSuccess()) {
                $exhibition = new Exhibition();
                $update = $exhibition->update($data, $get['id']); // Met à jour une exposition par son ID

                if ($update) {
                    return View::redirect('exhibitions/show?id=' . $get['id']);
                } else {
                    return View::render('error', ['msg' => 'Échec de la mise à jour de l\'exposition']);
                }
            } else {
                $errors = $validator->getErrors();
                return View::render('exhibitions/edit', ['errors' => $errors, 'inputs' => $data]);
            }
        }
        return View::render('error');
    }

    public function delete($data)
    {
        if (isset($data['id']) && $data['id'] != null) {
            $exhibition = new Exhibition();
            $delete = $exhibition->delete($data['id']); // Supprime une exposition par son ID

            if ($delete) {
                return View::redirect('exhibitions');
            } else {
                return View::render('error', ['msg' => 'Échec de la suppression de l\'exposition']);
            }
        }
        return View::render('error');
    }
}