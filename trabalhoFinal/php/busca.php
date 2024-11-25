<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

class Anuncio
{
  
  public $titulo;
  public $descricao;
  public $preco;
  public $imagem;
  public $id;

  function __construct($titulo, $descricao, $preco, $imagem, $id)
  {
    $this->titulo = $titulo;
    $this->descricao = $descricao;
    $this->preco = $preco;
    $this->imagem = $imagem;
    $this->id = $id;
  }
}

// Recebe os dados do formulário de busca
$marca = $_POST['marca'] ?? '';
$modelo = $_POST['modelo'] ?? '';
$localizacao = $_POST['localizacao'] ?? '';
$anuncios = array();

// Constrói as condições de filtro
$where = [];
$params = [];

if ($marca) {
    $where[] = "a.Marca = ?";
    $params[] = $marca;
}

if ($modelo) {
    $where[] = "a.Modelo = ?";
    $params[] = $modelo;
}

if ($localizacao) {
    $where[] = "a.Localizacao = ?";
    $params[] = $localizacao;
}

// Monta a consulta SQL com os filtros aplicados
$sql = "SELECT a.Titulo, a.Descricao, a.Preco, f.NomeArqFoto, a.Codigo 
        FROM Anuncio AS a 
        LEFT JOIN Foto AS f ON f.CodAnuncio = a.Codigo";

if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$sql .= " ORDER BY a.DataHora DESC LIMIT 6";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);

if (!$stmt) {
    die('Erro na execução da consulta: ' . $pdo->errorInfo()[2]);
}

// Processa os resultados da consulta
while ($row = $stmt->fetch()) {
    $titulo = htmlspecialchars($row['Titulo']);
    $descricao = htmlspecialchars($row['Descricao']);
    $preco = htmlspecialchars($row['Preco']);
    $imagem = htmlspecialchars($row['NomeArqFoto']);
    $id = strval($row['Codigo']);
    $objeto = new Anuncio($titulo, $descricao, $preco, $imagem, $id);
    $anuncios[] = $objeto;
}

// Retorna o resultado como JSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode($anuncios);

?>
