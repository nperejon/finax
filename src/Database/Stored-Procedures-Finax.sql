/*
	Legenda (Status de reposta resumidos):
    - 1 = sucesso
    - 2 = dado já existe
    - 3 = dado não encontrado
*/

USE finax;
DELIMITER $$
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
    
	IF nome_da_tabela = 'usuario' THEN 
        SET v_email = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.email'));
        SET v_telefone = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.telefone'));
        SET v_nome = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.nome'));
        SET v_senha = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.senha'));
        SET v_data_de_nascimento = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.data_de_nascimento'));
        SET v_data_de_cadastro = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.data_de_cadastro'));
        IF NOT EXISTS (SELECT u.email FROM usuario u WHERE u.email = v_email) THEN 
			INSERT INTO usuario (email, telefone, nome, senha, data_de_nascimento, data_de_cadastro) 
				VALUES (v_email, v_telefone, v_nome, v_senha, v_data_de_nascimento, v_data_de_cadastro);
			SET resposta = '{"status":"1","mensagem": "Dado inserido com sucesso"}';
		ELSE 
			SET resposta = '{"status":"2","mensagem": "Email já cadastrado"}';
        END IF;
	
    ELSEIF nome_da_tabela = 'entrada' THEN
		SET v_id_usuario = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.id_usuario'));
        SET v_nome = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.nome'));
        SET v_valor = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.valor'));
        SET v_data_registro = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.data_registro'));
        INSERT INTO entrada (id_usuario, nome, valor, data_registro) VALUES (v_id_usuario, v_nome, v_valor, v_data_registro);
        SET resposta = '{"status":"1","mensagem": "Dado inserido com sucesso"}';
    
    ELSEIF nome_da_tabela = 'saida' THEN
		SET v_id_usuario = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.id_usuario'));
        SET v_nome = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.nome'));
        SET v_valor = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.valor'));
        SET v_data_registro = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.data_registro'));
        INSERT INTO saida (id_usuario, nome, valor, data_registro) VALUES (v_id_usuario, v_nome, v_valor, v_data_registro);
        SET resposta = '{"status":"1","mensagem": "Dado inserido com sucesso", "id_do_registro":}';
    
    END IF;
END $$
DELIMITER ;

/* deleta_registro: procedure que atualiza o campo "registro_apagado" das tabelas entrada e saida para igual a 1
 					para fazer isso é necessário chamar a procedure passando o valor do id desse registro.
					O front deve criar os dados de entrada e saida já com o ID, e inserir na nossa tabela com esse ID
*/
DELIMITER $$
CREATE PROCEDURE deleta_registro (IN nome_da_tabela VARCHAR(45), IN id_registro INT, OUT resposta JSON)
BEGIN
	IF nome_da_tabela = 'entrada' THEN
		IF NOT EXISTS (SELECT id FROM entrada WHERE id = id_registro) THEN
			SET resposta = '{"status":"3","mensagem": "ID não encotrado - registro não foi apagado"}';
        ELSE 
			SET resposta = '{"status":"1","mensagem": "Registro apagado"}';
			UPDATE entrada SET registro_apagado = 1 WHERE id = id_registro;
        END IF;
        
	ELSEIF nome_da_tabela = 'saida' THEN
		IF NOT EXISTS (SELECT id FROM saida WHERE id = id_registro) THEN
			SET resposta = '{"status":"3","mensagem": "ID não encotrado - registro não foi apagado"}';
		ELSE 
			SET resposta = '{"status":"1","mensagem": "Registro apagado"}';
			UPDATE saida SET registro_apagado = 1 WHERE id = id_registro;
		END IF;
	END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE atualiza_registro (IN nome_da_tabela VARCHAR(45), IN valores JSON, OUT resposta JSON)
BEGIN
	/* valores JSON
    {
		"id": 1
		"nome_do_campo": "nome" ou "valor"
        "valor": "Nicolas" ou "12.40"
    }
    */
	DECLARE v_nome_do_campo VARCHAR(45);
    DECLARE v_id INT;
    DECLARE v_valor_double DOUBLE;
    DECLARE v_valor_text VARCHAR(100);
	
    SET v_nome_do_campo = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.nome_do_campo'));
    SET v_id = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.id'));
    
    IF nome_da_tabela = 'usuario' THEN
        IF v_nome_do_campo = 'nome' THEN
			SET v_valor_text = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.valor'));
            UPDATE usuario SET nome = v_valor_text WHERE id = v_id;
            SET resposta = '{"status":"1","mensagem": "Registro atualizado"}';
		ELSE 
			SET resposta = '{"status":"3","mensagem": "Nome do campo inválido ou campo não pode ter valor atualizado"}';
		END IF;
	ELSEIF nome_da_tabela = 'entrada' THEN
		IF v_nome_do_campo = 'nome' THEN
			SET v_valor_text = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.valor'));
			UPDATE entrada SET nome = v_valor_text WHERE id = v_id;
            SET resposta = '{"status":"1","mensagem": "Registro atualizado"}';
		ELSEIF v_nome_do_campo = 'valor' THEN 
			SET v_valor_double = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.valor'));
            UPDATE entrada SET valor = v_valor_double WHERE id = v_id;
            SET resposta = '{"status":"1","mensagem": "Registro atualizado"}';
		ELSE 
			SET resposta = '{"status":"3","mensagem": "Nome do campo inválido ou campo não pode ter valor atualizado"}';
		END IF;
	ELSEIF nome_da_tabela = 'saida' THEN
		IF v_nome_do_campo = 'nome' THEN
			SET v_valor_text = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.valor'));
			UPDATE entrada SET nome = v_valor_text WHERE id = v_id;
            SET resposta = '{"status":"1","mensagem": "Registro atualizado"}';
		ELSEIF v_nome_do_campo = 'valor' THEN 
			SET v_valor_double = JSON_UNQUOTE(JSON_EXTRACT(valores, '$.valor'));
            UPDATE entrada SET valor = v_valor_double WHERE id = v_id;
            SET resposta = '{"status":"1","mensagem": "Registro atualizado"}';
		ELSE 
			SET resposta = '{"status":"3","mensagem": "Nome do campo inválido ou campo não pode ter valor atualizado"}';
		END IF;
	ELSE 
		SET resposta = '{"status":"3","mensagem": "Nome da tabela inválida"}';
    END IF;
END$$
DELIMITER ;

DROP PROCEDURE insere_registro;


CALL insere_registro ('usuario', 
	'{
		"email": "claudionor.teste3@gmail.com", 
        "telefone": "5511974830829", 
        "senha": "1234556", 
        "nome": "Claudionor",
		"data_de_nascimento": "1995-01-22",
        "data_de_registro": "2024-05-21"
        }',
        @resposta
);
CALL insere_registro ('entrada', 
	'{
		"id_usuario": "1", 
        "nome": "Entrada 1", 
        "valor": "50.00", 
		"data_registro": "2024-05-19"
        }',
        @resposta
);
CALL insere_registro ('saida', 
	'{
		"id_usuario": "1", 
        "nome": "Saida 1", 
        "valor": "25.00", 
		"data_registro": "2024-05-19"
        }',
        @resposta
);

CALL deleta_registro ('entrada', 3, @resposta1);

CALL atualiza_registro('entrada', '{
	"id": 1,
    "nome_do_campo": "nome",
    "valor": "Entrada com Nome Atualizado"
}', @resposta2);
CALL atualiza_registro('usuario', '{
	"id": 3,
    "nome_do_campo": "telefone",
    "valor": "Nicolas"
}', @resposta2);

SELECT @resposta;
SELECT @resposta1;
SELECT @resposta2;
SELECT * FROM usuario;
SELECT * FROM entrada;    
SELECT * FROM saida;