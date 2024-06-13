CREATE DATABASE finax;

USE finax;

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

-- alterando o campo valor da tabela de saida para ser ser unsigned pois ele saira de uso para valores double
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