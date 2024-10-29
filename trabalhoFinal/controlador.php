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
    //   header("location: produtos.html");
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;

//   case "excluirProduto":
//     $idProduto = $_GET["idProduto"] ?? "";
//     try {
//       Produto::Remove($pdo, $idProduto);
//       header("location: produtos.html");
//     } catch (Exception $e) {
//       throw new Exception($e->getMessage());
//     }
//     break;

//   case "listarProdutos":
//     try {
//       $arrayProdutos = Produto::GetFirst30($pdo);
//       header('Content-Type: application/json; charset=utf-8');
//       echo json_encode($arrayProdutos);
//     } catch (Exception $e) {
//       throw new Exception($e->getMessage());
//     }
//     break;

  default:
    exit("Ação não disponível");
}
?>
