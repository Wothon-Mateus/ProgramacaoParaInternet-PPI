<?php

class Clientes
{
  // Método para criar um novo produto no BD
  static function Create($pdo, $nome, $cpf, $email, $senha, $telefone)
  {
    $stmt = $pdo->prepare(
      <<<SQL
      INSERT INTO cliente (nome, cpf, email, senha, telefone)
      VALUES (?, ?, ?,?, ?)
      SQL
    );

    $stmt->execute([$nome, $cpf, $email, $senha, $telefone]);

    return $pdo->lastInsertId();
  }

// //   Método para buscar produtos no BD e retornar como objetos PHP
//   static function Get($pdo, $id)
//   {
//     $stmt = $pdo->prepare(
//       <<<SQL
//       SELECT id, nome, marca, descricao
//       FROM produto
//       WHERE id = ?
//       SQL
//     );

//     $stmt->execute([$id]);
//     if ($stmt->rowCount() == 0)
//       throw new Exception("Produto não localizado");

//     return $stmt->fetch(PDO::FETCH_OBJ);
//   }

//   // Método para listar os primeiros 30 produtos
//   static function GetFirst30($pdo)
//   {
//     $stmt = $pdo->query(
//       <<<SQL
//       SELECT id, nome, marca, descricao
//       FROM produto
//       LIMIT 30
//       SQL
//     );

//     return $stmt->fetchAll(PDO::FETCH_OBJ);
//   }

//   // Método para remover um produto
//   public static function Remove($pdo, $id)
//   {
//     $stmt = $pdo->prepare(
//       <<<SQL
//       DELETE FROM produto
//       WHERE id = ?
//       LIMIT 1
//       SQL
//     );

//     $stmt->execute([$id]);
//   }
}
?>
