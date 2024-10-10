<?php

require "../conexaoMysql.php";
require "produto.php";

$acao = $_GET['acao'];
$pdo = mysqlConnect();

switch ($acao) {
  case "adicionarProduto":
    $nome = $_POST["nome"] ?? "";
    $marca = $_POST["marca"] ?? "";
    $descricao = $_POST["descricao"] ?? "";

    try {
      Produto::Create($pdo, $nome, $marca, $descricao);
      header("location: produtos.html");
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;

  case "excluirProduto":
    $idProduto = $_GET["idProduto"] ?? "";
    try {
      Produto::Remove($pdo, $idProduto);
      header("location: produtos.html");
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;

  case "listarProdutos":
    try {
      $arrayProdutos = Produto::GetFirst30($pdo);
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($arrayProdutos);
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;

  default:
    exit("Ação não disponível");
}
?>
