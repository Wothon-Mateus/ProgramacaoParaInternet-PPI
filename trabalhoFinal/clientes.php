<?php

class Clientes
{
  // Método para criar um novo produto no BD
  static function Create($pdo, $nome, $cpf, $email, $senha, $telefone)
  {
    $stmt = $pdo->prepare(
      <<<SQL
      INSERT INTO anunciante (nome, cpf, email, senha, telefone)
      VALUES (?, ?, ?,?, ?)
      SQL
    );

    $stmt->execute([$nome, $cpf, $email, $senha, $telefone]);

    return $pdo->lastInsertId();
  }
}
?>
