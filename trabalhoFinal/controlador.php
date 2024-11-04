<?php

require "conexaoMysql.php";


$acao = $_POST['acao'] ?? '';
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
      // Insere os dados na tabela Anunciante
      $sql = "INSERT INTO anunciante (nome, cpf, email, senha, telefone) VALUES (?, ?, ?, ?, ?)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$nome, $cpf, $email, $senhaHash, $telefone]);

      // Redireciona para a página de cadastro com sucesso
      header("location: login.html");
      exit();
    } catch (Exception $e) {
      // Em caso de erro, exibe a mensagem
      echo "Erro ao cadastrar: " . $e->getMessage();
      exit();
    }
    break;

  default:
    exit("Ação não disponível");
}
?>
