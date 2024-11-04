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

    // Gera o hash da senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try {
      Cliente::Create(
        $pdo,
        $nome,
        $cpf,
        $email,
        $senhaHash,
        $dataNascimento,
      );
      header("location: clientes.html");
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;


  default:
    exit("Ação não disponível");
}
?>
