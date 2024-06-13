<?php

namespace Source\Model;

use Source\Database\Database;
class Outflow
{
    public $id;
    public $id_usuario;
    public $nome;
    public $valor;
    public $data_registro;
    public $registro_apagado;
    public $outflows;

    public function __construct()
    {
        $this->id = null;
        $this->id_usuario = null;
        $this->nome = null;
        $this->valor = null;
        $this->data_registro = null;
        $this->registro_apagado = null;
        $this->outflows = [];
    }

    public function loadAllbyUser($id)
    {
        $sql = "SELECT * FROM saida WHERE id_usuario = :id";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute([':id' => $id]);

        if ($stmt->rowCount() > 0) {
            foreach ($stmt->fetchAll() as $outflow) {
                $this->outflows[] = $outflow;
            }
        }
    }

    public function update()
    {
        $sql = "UPDATE saida SET nome = :nome, valor = :valor, data_registro = :data_registro, registro_apagado = :registro_apagado WHERE id = :id";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute([
            ':nome' => $this->nome,
            ':valor' => $this->valor,
            ':data_registro' => $this->data_registro,
            ':registro_apagado' => $this->registro_apagado,
            ':id' => $this->id
        ]);
    }

    public function save()
    {
        $sql = "INSERT INTO saida (id_usuario, nome, valor, data_registro, registro_apagado) VALUES (:id_usuario, :nome, :valor, :data_registro, :registro_apagado)";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute([
            ':id_usuario' => $this->id_usuario,
            ':nome' => $this->nome,
            ':valor' => $this->valor,
            ':data_registro' => $this->data_registro,
            ':registro_apagado' => $this->registro_apagado
        ]);
    }

    public function delete()
    {
        $sql = "DELETE FROM saida WHERE id = :id";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute([':id' => $this->id]);
    }
    
    public static function all()
    {
        $sql = "SELECT * FROM saida";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }
    }
}