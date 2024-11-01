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