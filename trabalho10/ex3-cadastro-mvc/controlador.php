<?php

require "../conexaoMysql.php";
require "cliente.php";

// resgata a ação a ser executada
$acao = $_GET['acao'];

// conecta ao servidor do MySQL
$pdo = mysqlConnect();

switch ($acao) {
    
  case "adicionarCliente":
    //--------------------------------------------------------------------------------------    
    $nome = $_POST["nome"] ?? "";
    $cpf = $_POST["cpf"] ?? "";
    $email = $_POST["email"] ?? "";
    $senha = $_POST["senha"] ?? "";
    $dataNascimento = $_POST["dataNascimento"] ?? "";
    $estadoCivil = $_POST["estadoCivil"] ?? "";
    $altura = $_POST["altura"] ?? "";

    // gera o hash da senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try {
      Cliente::Create($pdo, $nome, $cpf, $email, $senhaHash, $dataNascimento, $estadoCivil, $altura);
      header("location: clientes.html");
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;

    
  case "excluirCliente":
    //--------------------------------------------------------------------------------------
    $idCliente = $_GET["idCliente"] ?? "";
    try {
      Cliente::Remove($pdo, $idCliente);
      header("location: clientes.html");
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;

  case "listarClientes":
    //--------------------------------------------------------------------------------------
    try {
      $arrayClientes = Cliente::GetFirst30($pdo);
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($arrayClientes);
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;

    //-----------------------------------------------------------------
  default:
    exit("Ação não disponível");
}
