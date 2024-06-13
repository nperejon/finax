<?php
namespace Source\Controller;
use Source\Core\CsrfToken;
use Source\Core\SessionManager;
use Source\Model\Inflow;
use Source\Model\Outflow;

class Currency
{
    public function index()
    {
        SessionManager::start();

        if (!SessionManager::get('user_id')) {
            header('Location: '.BASE_URL);
            exit;
        }

        $csrf_token = CsrfToken::generate();
        
        $username = SessionManager::get('user_name');
        require __DIR__ ."../../../views/moedas.php";
    }
}