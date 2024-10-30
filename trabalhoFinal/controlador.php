<?php

require "conexaoMysql.php";
require "clientes.php";

$acao = $_GET['acao'];
$pdo = mysqlConnect();

switch ($acao) {
  case "adicionarCliente":
    $nome = $_POST["nome"] ?? "";
    $cpf = $_POST["cpf"] ?? "";
    $email = $_POST["email"] ?? "";
    $senha = $_POST["senha"] ?? "";
    $telefone = $_POST["telefone"] ?? "";

    try {
      Produto::Create($pdo, $nome, $cpf, $email, $senha, $telefone);
    //   header("location: cadastro.html");
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;


  default:
    exit("Ação não disponível");
}
?>
