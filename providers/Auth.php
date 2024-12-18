<?php
namespace App\Providers;
use App\Providers\View;

class Auth {
    static public function session(){
        if(isset($_SESSION['finger_print']) and $_SESSION['finger_print']===md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'])){
            return true;
        }else{
            return view::redirect('login');
        }
    }

    static public function privilege($id){
        if($_SESSION['privilege_id']===$id){
            return true;
        }else{
            return view::redirect('login');
        }
    }

    // Verifie si un utilisateur est connecter (ou un inviter)
    static public function checkUserSession() {
        return isset($_SESSION['user_id']) || isset($_SESSION['guest_id']);
    }

    // Methode pour creer un utilisateur inviter
    static public function createGuestUser() {
        // Verifie si un utilisateur inviter existe deja
        if (!isset($_SESSION['guest_id'])) {
            // Creer un utilisateur inviter avec des informations par defaut
            $_SESSION['guest_id'] = uniqid('guest_');
            $_SESSION['user_name'] = 'Guest';
            $_SESSION['privilege_id'] = 2;
            $_SESSION['finger_print'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
        }
    }
}
