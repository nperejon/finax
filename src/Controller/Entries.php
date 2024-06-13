<?php
namespace Source\Controller;
use Source\Core\CsrfToken;
use Source\Core\SessionManager;
use Source\Model\Inflow;
use Source\Model\Outflow;

class Entries
{
    public function index()
    {
        SessionManager::start();

        if (!SessionManager::get('user_id')) {
            header('Location: '.BASE_URL);
            exit;
        }

        $inflow = new Inflow();
        $inflow->loadAllbyUser(SessionManager::get('user_id'));
        $inflows = $inflow->inflows;
        $total_inflow = 0;
        foreach ($inflows as $inflow) {
            $total_inflow += $inflow->valor;
        }

        $outflow = new Outflow();
        $outflow->loadAllbyUser(SessionManager::get('user_id'));
        $outflows = $outflow->outflows;
        $total_outflow = 0;
        foreach ($outflows as $outflow) {
            $total_outflow += $outflow->valor;
        }
        
        $username = SessionManager::get('user_name');
        $csrf_token = CsrfToken::generate();
        require __DIR__ ."../../../views/entradas.php";
    }
}