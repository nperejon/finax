<?php

namespace Source\Database;

class Database
{
    private static $instance;

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            try {
                self::$instance = new \PDO(
                    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                    DB_USER,
                    DB_PASS,
                    [
                        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                        \PDO::ATTR_CASE => \PDO::CASE_NATURAL
                    ]
                );
            } catch (\PDOException $exception) {
                die("<h1>Erro ao conectar</h1>");
            }
        }

        return self::$instance;
    }

    public static function createDatabase()
    {
        $db = self::getInstance();

        $result = $db->query("SHOW TABLES LIKE 'usuario'");

        if ($result->rowCount() > 0) {
            return $db;
        }

        $db->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
        $db->exec("USE " . DB_NAME);

        $db->exec('
            CREATE TABLE usuario(
                id int unsigned not null auto_increment,
                email varchar(500) not null,
                telefone varchar(13),
                PRIMARY KEY (id)
            );

            CREATE TABLE senha(
                id int unsigned not null auto_increment,
                id_usuario int unsigned not null,
                senha varchar(500) not null,
                PRIMARY KEY (id),
                CONSTRAINT fk_senha_usuario FOREIGN KEY (id_usuario) REFERENCES usuario (id)
            );

            CREATE TABLE saida(
                id int unsigned not null auto_increment,
                id_usuario int unsigned not null,
                nome varchar(100) not null,
                valor double unsigned not null,
                data_registro datetime,
                PRIMARY KEY (id),
                CONSTRAINT fk_saida_usuario FOREIGN KEY (id_usuario) REFERENCES usuario (id)
            );
        ');

        $db->exec('
            ALTER TABLE saida MODIFY valor double not null;

            CREATE TABLE entrada (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                id_usuario INT UNSIGNED NOT NULL,
                nome VARCHAR(100) NOT NULL,
                valor DOUBLE NOT NULL,
                data_registro DATETIME,
                PRIMARY KEY (id),
                CONSTRAINT fk_entrada_usuario FOREIGN KEY (id_usuario)
                    REFERENCES usuario (id)
            );

            DROP TABLE senha;

            ALTER TABLE usuario ADD COLUMN senha varchar(100) not null;
            ALTER TABLE usuario ADD COLUMN data_de_nascimento date not null;
            ALTER TABLE usuario ADD COLUMN data_de_cadastro datetime;
            ALTER TABLE usuario ADD COLUMN nome VARCHAR(300);

            ALTER TABLE entrada ADD COLUMN registro_apagado tinyint default null;
            ALTER TABLE saida ADD COLUMN registro_apagado tinyint default null;
        ');

        $db->exec('
            CREATE PROCEDURE insere_registro (IN nome_da_tabela VARCHAR(45), IN valores JSON, OUT resposta JSON)
            BEGIN
                -- variaveis que existem em todos os contextos
                DECLARE v_nome VARCHAR(100);
                
                -- valores para quando nome_da_tabela = usuario
                DECLARE v_email VARCHAR(500);
                DECLARE v_telefone VARCHAR(13);
                DECLARE v_senha VARCHAR(100);
                DECLARE v_data_de_nascimento DATE;
                DECLARE v_data_de_cadastro DATETIME;
                
                -- valores para quando nome_da_tabela = entrada ou saida
                DECLARE v_id_usuario INT;
                DECLARE v_valor DOUBLE;
                DECLARE v_data_registro DATETIME;
                
                IF nome_da_tabela = "usuario" THEN 
                    SET v_email = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.email"));
                    SET v_telefone = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.telefone"));
                    SET v_nome = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.nome"));
                    SET v_senha = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.senha"));
                    SET v_data_de_nascimento = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.data_de_nascimento"));
                    SET v_data_de_cadastro = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.data_de_cadastro"));
                    IF NOT EXISTS (SELECT u.email FROM usuario u WHERE u.email = v_email) THEN 
                        INSERT INTO usuario (email, telefone, nome, senha, data_de_nascimento, data_de_cadastro) 
                            VALUES (v_email, v_telefone, v_nome, v_senha, v_data_de_nascimento, v_data_de_cadastro);
                        SET resposta = JSON_OBJECT("status", 1, "mensagem", "Dado inserido com sucesso");
                    ELSE 
                        SET resposta = JSON_OBJECT("status", 2, "mensagem", "Email já cadastrado");
                    END IF;
                
                ELSEIF nome_da_tabela = "entrada" THEN
                    SET v_id_usuario = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.id_usuario"));
                    SET v_nome = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.nome"));
                    SET v_valor = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.valor"));
                    SET v_data_registro = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.data_registro"));
                    INSERT INTO entrada (id_usuario, nome, valor, data_registro) VALUES (v_id_usuario, v_nome, v_valor, v_data_registro);
                    SET resposta = JSON_OBJECT("status", 1, "mensagem", "Dado inserido com sucesso");
                
                ELSEIF nome_da_tabela = "saida" THEN
                    SET v_id_usuario = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.id_usuario"));
                    SET v_nome = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.nome"));
                    SET v_valor = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.valor"));
                    SET v_data_registro = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.data_registro"));
                    INSERT INTO saida (id_usuario, nome, valor, data_registro) VALUES (v_id_usuario, v_nome, v_valor, v_data_registro);
                    SET resposta = JSON_OBJECT("status", 1, "mensagem", "Dado inserido com sucesso");
                
                END IF;
            END;
        ');

        $db->exec('
            CREATE PROCEDURE deleta_registro (IN nome_da_tabela VARCHAR(45), IN id_registro INT, OUT resposta JSON)
            BEGIN
                IF nome_da_tabela = "entrada" THEN
                    IF NOT EXISTS (SELECT id FROM entrada WHERE id = id_registro) THEN
                        SET resposta = JSON_OBJECT("status", 3, "mensagem", "ID não encontrado - registro não foi apagado");
                    ELSE 
                        UPDATE entrada SET registro_apagado = 1 WHERE id = id_registro;
                        SET resposta = JSON_OBJECT("status", 1, "mensagem", "Registro apagado");
                    END IF;
                    
                ELSEIF nome_da_tabela = "saida" THEN
                    IF NOT EXISTS (SELECT id FROM saida WHERE id = id_registro) THEN
                        SET resposta = JSON_OBJECT("status", 3, "mensagem", "ID não encontrado - registro não foi apagado");
                    ELSE 
                        UPDATE saida SET registro_apagado = 1 WHERE id = id_registro;
                        SET resposta = JSON_OBJECT("status", 1, "mensagem", "Registro apagado");
                    END IF;
                END IF;
            END;
        ');

        $db->exec('
            CREATE PROCEDURE atualiza_registro (IN nome_da_tabela VARCHAR(45), IN valores JSON, OUT resposta JSON)
            BEGIN
                DECLARE v_nome_do_campo VARCHAR(45);
                DECLARE v_id INT;
                DECLARE v_valor_double DOUBLE;
                DECLARE v_valor_text VARCHAR(100);
                
                SET v_nome_do_campo = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.nome_do_campo"));
                SET v_id = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.id"));
                
                IF nome_da_tabela = "usuario" THEN
                    IF v_nome_do_campo = "nome" THEN
                        SET v_valor_text = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.valor"));
                        UPDATE usuario SET nome = v_valor_text WHERE id = v_id;
                        SET resposta = JSON_OBJECT("status", 1, "mensagem", "Registro atualizado");
                    ELSE 
                        SET resposta = JSON_OBJECT("status", 3, "mensagem", "Nome do campo inválido ou campo não pode ter valor atualizado");
                    END IF;
                ELSEIF nome_da_tabela = "entrada" THEN
                    IF v_nome_do_campo = "nome" THEN
                        SET v_valor_text = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.valor"));
                        UPDATE entrada SET nome = v_valor_text WHERE id = v_id;
                        SET resposta = JSON_OBJECT("status", 1, "mensagem", "Registro atualizado");
                    ELSEIF v_nome_do_campo = "valor" THEN 
                        SET v_valor_double = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.valor"));
                        UPDATE entrada SET valor = v_valor_double WHERE id = v_id;
                        SET resposta = JSON_OBJECT("status", 1, "mensagem", "Registro atualizado");
                    ELSE 
                        SET resposta = JSON_OBJECT("status", 3, "mensagem", "Nome do campo inválido ou campo não pode ter valor atualizado");
                    END IF;
                ELSEIF nome_da_tabela = "saida" THEN
                    IF v_nome_do_campo = "nome" THEN
                        SET v_valor_text = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.valor"));
                        UPDATE saida SET nome = v_valor_text WHERE id = v_id;
                        SET resposta = JSON_OBJECT("status", 1, "mensagem", "Registro atualizado");
                    ELSEIF v_nome_do_campo = "valor" THEN 
                        SET v_valor_double = JSON_UNQUOTE(JSON_EXTRACT(valores, "$.valor"));
                        UPDATE saida SET valor = v_valor_double WHERE id = v_id;
                        SET resposta = JSON_OBJECT("status", 1, "mensagem", "Registro atualizado");
                    ELSE 
                        SET resposta = JSON_OBJECT("status", 3, "mensagem", "Nome do campo inválido ou campo não pode ter valor atualizado");
                    END IF;
                ELSE 
                    SET resposta = JSON_OBJECT("status", 3, "mensagem", "Nome da tabela inválida");
                END IF;
            END;
        ');

        $db->exec('CALL insere_registro("usuario", \'{
            "email": "claudionor.teste3@gmail.com", 
            "telefone": "5511974830829", 
            "senha": "1234556", 
            "nome": "Claudionor",
            "data_de_nascimento": "1995-01-22",
            "data_de_registro": "2024-05-21"
        }\', @resposta)');

        $db->exec('CALL insere_registro("entrada", \'{
            "id_usuario": "1", 
            "nome": "Entrada 1", 
            "valor": "50.00", 
            "data_registro": "2024-05-19"
        }\', @resposta)');

        $db->exec('CALL insere_registro("saida", \'{
            "id_usuario": "1", 
            "nome": "Saida 1", 
            "valor": "25.00", 
            "data_registro": "2024-05-19"
        }\', @resposta)');

        $db->exec('CALL deleta_registro("entrada", 3, @resposta1)');

        $db->exec('CALL atualiza_registro("entrada", \'{
            "id": 1,
            "nome_do_campo": "nome",
            "valor": "Entrada com Nome Atualizado"
        }\', @resposta2)');

        $db->exec('CALL atualiza_registro("usuario", \'{
            "id": 3,
            "nome_do_campo": "telefone",
            "valor": "Nicolas"
        }\', @resposta2)');

        return $db;
    }
}