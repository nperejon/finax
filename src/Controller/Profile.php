<?php
namespace Source\Controller;
use Source\Core\CsrfToken;
use Source\Core\SessionManager;

class Profile
{
    public function index()
    {
        SessionManager::start();

        if (!SessionManager::get('user_id')) {
            header('Location: '.BASE_URL);
            exit;
        }

        $username = SessionManager::get('user_name');
        $email = SessionManager::get('user_email');
        $birthdate = SessionManager::get('user_datanascimento');
        $phone = SessionManager::get('user_telefone');

        
        
        $csrf_token = CsrfToken::generate();
        require __DIR__ ."../../../views/perfil.php";
    }
}