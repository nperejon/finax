<?php
namespace Source\Controller;
use Source\Core\CsrfToken;
use Source\Core\SessionManager;

class Home
{
    public function index()
    {
        SessionManager::start();

        if (!SessionManager::get('user_id')) {
            header('Location: '.BASE_URL);
            exit;
        }
        
        $username = SessionManager::get('user_name');
        $csrf_token = CsrfToken::generate();
        require __DIR__ ."../../../views/home.php";
    }
}