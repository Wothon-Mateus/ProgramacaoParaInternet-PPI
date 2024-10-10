CREATE TABLE aluno
(
   nome varchar(50),
   telefone varchar(50)
) ENGINE=InnoDB;

CREATE TABLE cliente
(
   id int PRIMARY KEY auto_increment,
   nome varchar(50),
   cpf char(14) UNIQUE,
   email varchar(50) UNIQUE,
   senhaHash varchar(255),
   dataNascimento date,
   estadoCivil varchar(30),
   altura int
) ENGINE=InnoDB;

CREATE TABLE enderecoCliente
(
   id int PRIMARY KEY auto_increment,
   cep char(10),
   logradouro varchar(100),
   bairro varchar(50),
   cidade varchar(50),
   idCliente int not null,
   FOREIGN KEY (idCliente) REFERENCES cliente(id) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO aluno VALUES ("Fulano", "123");
INSERT INTO aluno VALUES ("Ciclano", "456");
