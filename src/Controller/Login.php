<?php
namespace Source\Controller;
use Source\Core\CsrfToken;
use Source\Core\SessionManager;
use Source\Model\User;

class Login
{
    public function index()
    {
        SessionManager::start();
        
        $csrf_token = CsrfToken::generate();
        require __DIR__ ."../../../views/index.php";
    }

    public function post($data)
    {
        if (isset($data['register'])) {
            $this->register($data);
            return;
        } else {
            $this->login($data);
            return;
        }
    }

    public function login($data) {
        $csrf_token = filter_var($data['csrf_token'], 513);
        $email = filter_var($data['email'], 513);
        $senha = filter_var($data['senha'], 513);

        if (!CsrfToken::check($csrf_token)) {
            SessionManager::set('message', [
                'type' => 'error',
                'message' => 'Token CSRF inválido.'
            ]);

            header('Location: '.BASE_URL.'/');
            exit;
        }

        if (empty($email) || empty($senha)) {
            SessionManager::set('message', [
                'type' => 'error',
                'message' => 'Por favor, preencha todos os campos.'
            ]);

            header('Location: '.BASE_URL.'/');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            SessionManager::set('message', [
                'type' => 'error',
                'message' => 'Por favor, digite um e-mail válido.'
            ]);

            header('Location: '.BASE_URL.'/');
            exit;
        }

        try {
            $user = new User();
            $user->email = $email;
            if (!$user->login($senha)) {
                throw new \PDOException('Senha incorreta.');
            }
    
            SessionManager::set('message', [
                'type' => 'success',
                'message' => 'Usuário logado com sucesso.'
            ]);

            $user->findByEmail($email);

            SessionManager::set('user_id', $user->id);
            SessionManager::set('user_name', $user->nome);
            SessionManager::set('user_email', $user->email);
            SessionManager::set('user_telefone', $user->telefone);
            SessionManager::set('user_datanascimento', $user->datanascimento);

            header('Location: '.BASE_URL.'/painel');
            exit;
        } catch (\PDOException $e) {
            SessionManager::set('message', [
                'type' => 'error',
                'message' => 'Erro ao logar usuário.'
            ]);

            header('Location: '.BASE_URL.'/login');
            exit;
        }
    }

    public function register($data)
    {
        $csrf_token = filter_var($data['csrf_token'], 513);
        $email = filter_var($data['email'], 513);
        $senha = filter_var($data['senha'], 513);
        $telefone = filter_var($data['telefone'], 513);
        $datanascimento = filter_var($data['datanascimento'], 513);
        $nome = filter_var($data['nome'], 513);

        if (!CsrfToken::check($csrf_token)) {
            SessionManager::set('message', [
                'type' => 'error',
                'message' => 'Token CSRF inválido.'
            ]);

            header('Location: '.BASE_URL.'/');
            exit;
        }

        if (empty($email) || empty($senha) || empty($telefone) || empty($datanascimento) || empty($nome)) {
            SessionManager::set('message', [
                'type' => 'error',
                'message' => 'Por favor, preencha todos os campos.'
            ]);

            header('Location: '.BASE_URL.'/');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            SessionManager::set('message', [
                'type' => 'error',
                'message' => 'Por favor, digite um e-mail válido.'
            ]);

            header('Location: '.BASE_URL.'/');
            exit;
        }

        try {
            $user = new User();
            $user->email = $email;
            $user->senha = password_hash($senha, PASSWORD_DEFAULT);
            $user->telefone = $telefone;
            $user->datanascimento = $datanascimento;
            $user->nome = $nome;
            $user->save();

            SessionManager::set('message', [
                'type' => 'success',
                'message' => 'Usuário cadastrado com sucesso.'
            ]);

            header('Location: '.BASE_URL.'/');
            exit;
        } catch (\PDOException $e) {
            SessionManager::set('message', [
                'type' => 'error',
                'message' => 'Erro ao cadastrar usuário.'
            ]);

            header('Location: '.BASE_URL.'/');
            exit;
        }
    }
}