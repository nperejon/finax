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

        $csrf_token = CsrfToken::generate();

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

    public function post($data)
    {
        if (isset($data['register-entry'])) {
            $this->registerEntry($data);
            return;
        } else if (isset($data['register-exit'])) {
            $this->registerExit($data);
            return;
        }
    }

    public function registerEntry($data)
    {
        $csrf_token = filter_var($data['csrf_token'], 513);
        $nome = filter_var($data['nome'], 513);
        $valor = filter_var($data['valor'], 519);

        if (!CsrfToken::check($csrf_token)) {
            SessionManager::set('message', [
                'type' => 'error',
                'mode' => 'entry',
                'message' => 'Token CSRF inválido.'
            ]);

            header('Location: '.BASE_URL.'entradas');
            exit;
        }

        if (empty($nome) || empty($valor)) {
            SessionManager::set('message', [
                'type' => 'error',
                'mode' => 'entry',
                'message' => 'Por favor, preencha todos os campos.'
            ]);

            header('Location: '.BASE_URL.'entradas');
            exit;
        }

        $inflow = new Inflow();
        $inflow->id_usuario = SessionManager::get('user_id');
        $inflow->nome = $nome;
        $inflow->valor = $valor;
        $inflow->data_registro = date('Y-m-d H:i:s');
        $inflow->registro_apagado = 0;
        $inflow->save();

        header('Location: '.BASE_URL.'entradas');
        exit;
    }

    public function registerExit($data)
    {
        $csrf_token = filter_var($data['csrf_token'], 513);
        $nome = filter_var($data['nome'], 513);
        $valor = filter_var($data['valor'], 519);

        if (!CsrfToken::check($csrf_token)) {
            SessionManager::set('message', [
                'type' => 'error',
                'mode' => 'exit',
                'message' => 'Token CSRF inválido.'
            ]);

            header('Location: '.BASE_URL.'entradas');
            exit;
        }

        if (empty($nome) || empty($valor)) {
            SessionManager::set('message', [
                'type' => 'error',
                'mode' => 'exit',
                'message' => 'Por favor, preencha todos os campos.'
            ]);

            header('Location: '.BASE_URL.'entradas');
            exit;
        }

        $outflow = new Outflow();
        $outflow->id_usuario = SessionManager::get('user_id');
        $outflow->nome = $nome;
        $outflow->valor = $valor;
        $outflow->data_registro = date('Y-m-d H:i:s');
        $outflow->registro_apagado = 0;
        $outflow->save();

        header('Location: '.BASE_URL.'entradas');
        exit;
    }

    public function deleteinput($data)
    {
        $id = filter_var($data['id'], 519);

        $inflow = new Inflow();
        $inflow->id = $id;
        $inflow->delete();

        header('Location: '.BASE_URL.'entradas');
        exit;
    }

    public function deleteoutput($data)
    {
        $id = filter_var($data['id'], 519);

        $outflow = new Outflow();
        $outflow->id = $id;
        $outflow->delete();

        header('Location: '.BASE_URL.'entradas');
        exit;
    }
}