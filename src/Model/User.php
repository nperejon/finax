<?php

namespace Source\Model;

use Source\Database\Database;
class User
{
    public $id;
    public $email;
    public $telefone;
    public $senha;
    public $datanascimento;
    public $nome;

    public function __construct()
    {
        $this->id = null;
        $this->email = null;
        $this->telefone = null;
        $this->senha = null;
        $this->datanascimento = null;
        $this->nome = null;
    }

    public function load($id)
    {
        $sql = "SELECT * FROM usuario WHERE id = :id";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute([':id' => $id]);

        if ($stmt->rowCount() > 0) {
            $data = (array) $stmt->fetch();

            $this->id = $data['id'];
            $this->email = $data['email'];
            $this->telefone = $data['telefone'];
            $this->senha = $data['senha'];
            $this->datanascimento = $data['data_de_nascimento'];
            $this->nome = $data['nome'];
        }
    }

    public function find($email)
    {
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute([':email' => $email]);

        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch();

            $this->id = $data['id'];
            $this->email = $data['email'];
            $this->telefone = $data['telefone'];
            $this->senha = $data['senha'];
            $this->datanascimento = $data['data_de_nascimento'];
            $this->nome = $data['nome'];
        }
    }

    public function findByName($name)
    {
        $sql = "SELECT * FROM usuario WHERE name = :name";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute([':nome' => $name]);

        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch();

            $this->id = $data['id'];
            $this->email = $data['email'];
            $this->telefone = $data['telefone'];
            $this->senha = $data['senha'];
            $this->datanascimento = $data['data_de_nascimento'];
            $this->nome = $data['nome'];
        }
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute([':email' => $email]);

        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch();

            $data = (array) $data;

            $this->id = $data['id'];
            $this->email = $data['email'];
            $this->telefone = $data['telefone'];
            $this->senha = $data['senha'];
            $this->datanascimento = $data['data_de_nascimento'];
            $this->nome = $data['nome'];

            return true;
        }

        return false;
    }

    public function edit()
    {
        $sql = "UPDATE usuario SET nome = :nome, email = :email, telefone = :telefone, senha = :senha, data_de_nascimento = :datanascimento WHERE id = :id";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute([
            ':nome' => $this->nome,
            ':email' => $this->email,
            ':telefone' => $this->telefone,
            ':senha' => $this->senha,
            ':datanascimento' => $this->datanascimento
        ]);
    }

    public function save()
    {
        $sql = "INSERT INTO usuario (nome, email, telefone, senha, data_de_nascimento) VALUES (:nome, :email, :telefone, :senha, :datanascimento)";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute([
            ':nome' => $this->nome,
            ':email' => $this->email,
            ':telefone' => $this->telefone,
            ':senha' => $this->senha,
            ':datanascimento' => $this->datanascimento
        ]);
    }

    public function update()
    {
        $sql = "UPDATE usuario SET nome = :nome, email = :email, telefone = :telefone, senha = :senha, data_de_nascimento = :datanascimento WHERE id = :id";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute([
            ':nome' => $this->nome,
            ':email' => $this->email,
            ':telefone' => $this->telefone,
            ':senha' => $this->senha,
            ':datanascimento' => $this->datanascimento,
            ':id' => $this->id
        ]);
    }

    public function delete()
    {
        $sql = "DELETE FROM usuario WHERE id = :id";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute([':id' => $this->id]);
    }
    
    public static function all()
    {
        $sql = "SELECT * FROM usuario";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }

        return [];
    }

    public function login($password)
    {
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute([':email' => $this->email]);

        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch();

            if (password_verify($password, $data->senha)) {
                return true;
            }
        }

        return false;
    }
}