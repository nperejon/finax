USE finax;

DROP TABLE senha;

ALTER TABLE usuario ADD COLUMN senha varchar(100) not null;
ALTER TABLE usuario ADD COLUMN data_de_nascimento date not null;
ALTER TABLE usuario ADD COLUMN data_de_cadastro datetime;
ALTER TABLE usuario ADD COLUMN nome VARCHAR(300);

ALTER TABLE entrada ADD COLUMN registro_apagado tinyint default null;
ALTER TABLE saida ADD COLUMN registro_apagado tinyint default null;
 