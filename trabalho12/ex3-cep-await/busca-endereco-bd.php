<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

$cep = $_GET['cep'] ?? '';

try
{
  $stmt = $pdo->prepare(
    <<<SQL
    SELECT cep, logradouro, bairro, cidade
    FROM endereco
    WHERE cep = ?
    SQL
  );

  $stmt->execute([$cep]);  
  $endereco = $stmt->fetch(PDO::FETCH_OBJ);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($endereco);
} 
catch (Exception $e) {
  exit("Falha ao buscar endereco: " . $e->getMessage());
}

/*
CREATE TABLE endereco
(
  cep char(9) PRIMARY KEY,
  logradouro varchar(30),
  bairro varchar(30),
  cidade varchar(30)
);

INSERT INTO endereco VALUES ('38400-100', 'Av Floriano Peixoto', 'Centro', 'Uberlândia');
INSERT INTO endereco VALUES ('38400-200', 'Rua Tiradentes', 'Fundinho', 'Uberlândia');
INSERT INTO endereco VALUES ('38408-100', 'Av. João Naves de Ávila, 2121', 'Santa Mônica', 'Uberlândia');
*/
