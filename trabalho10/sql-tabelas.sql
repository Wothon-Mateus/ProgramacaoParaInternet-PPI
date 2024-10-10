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

CREATE TABLE Pessoa (
  Id INT AUTO_INCREMENT PRIMARY KEY,
  Nome VARCHAR(100) NOT NULL,
  Sexo CHAR(1) NOT NULL,
  Email VARCHAR(100) NOT NULL
);

CREATE TABLE Paciente (
  Peso DECIMAL(5,2) NOT NULL,
  Altura DECIMAL(3,2) NOT NULL,
  TipoSanguineo VARCHAR(3) NOT NULL,
  IdPessoa INT PRIMARY KEY,
  FOREIGN KEY (IdPessoa) REFERENCES Pessoa(Id)
);

CREATE TABLE produto (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  marca VARCHAR(50),
  descricao TEXT
);
