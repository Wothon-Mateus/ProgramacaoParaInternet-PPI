CREATE TABLE Anunciante (
  Codigo INT AUTO_INCREMENT PRIMARY KEY,
  Nome VARCHAR(100),
  CPF VARCHAR(14),
  Email VARCHAR(100),
  SenhaHash VARCHAR(255),
  Telefone VARCHAR(20)
)ENGINE=InnoDB;


CREATE TABLE Anuncio (
  Codigo INT AUTO_INCREMENT PRIMARY KEY,
  Titulo VARCHAR(100),
  Descricao VARCHAR(200),
  Preco DECIMAL(10, 2),
  DataHora DATETIME,
  CEP VARCHAR(9),
  Bairro VARCHAR(100),
  Cidade VARCHAR(100),
  Estado VARCHAR(100),
  CodCategoria INT,
  CodAnunciante INT,
  FOREIGN KEY (CodCategoria) REFERENCES Categoria(Codigo),
  FOREIGN KEY (CodAnunciante) REFERENCES Anunciante(Codigo)
)ENGINE=InnoDB;

CREATE TABLE Interesse (
  Codigo INT AUTO_INCREMENT PRIMARY KEY,
  Mensagem VARCHAR(200),
  DataHora DATETIME,
  Contato VARCHAR(100),
  CodAnuncio INT,
  FOREIGN KEY (CodAnuncio) REFERENCES Anuncio(Codigo)
)ENGINE=InnoDB;

CREATE TABLE Foto (
  CodAnuncio INT,
  NomeArqFoto VARCHAR(255)
)ENGINE=InnoDB;

