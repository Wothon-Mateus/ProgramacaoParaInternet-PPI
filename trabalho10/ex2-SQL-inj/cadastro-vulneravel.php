<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_POST["nome"] ?? "";
$telefone = $_POST["telefone"] ?? "";

try {

  // NÃO FAÇA ISSO! Exemplo de código vulnerável a inj. de S-Q-L
  // As variáveis $nome e $telefone são inseridas diretamente na consulta SQL,
  // sem qualquer validação Isso significa que, se um usuário 
  // mal-intencionado inserir uma entrada com caracteres especiais ou código SQL, 
  // o banco de dados executará a consulta exatamente como está, incluindo no código 
  // o usuario malicioso pode por exemplo adicionar esse codigo '); DROP TABLE aluno; --


  // $sql = <<<SQL
  // INSERT INTO aluno (nome, telefone)
  // VALUES ('$nome', '$telefone');
  // SQL;

  // Experimente fazer o cadastro de um novo aluno preenchendo 
  // o campo telefone utilizando o texto disponibilizado pelo professor
  // nos slides de aula


  // Prepara a consulta SQL para evitar a vulnerabilidade explicada antes
  $sql = "INSERT INTO aluno (nome, telefone) VALUES (:nome, :telefone)";
  $stmt = $pdo->prepare($sql);

  // Associa os valores às variáveis de forma segura
  $stmt->bindParam(':nome', $nome);
  $stmt->bindParam(':telefone', $telefone);

  // Executa a consulta
  $stmt->execute();

  header("location: mostra-alunos.php");
  exit();
} catch (Exception $e) {
  exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
