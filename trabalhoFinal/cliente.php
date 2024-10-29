<?php

class Cliente
{


  static function Create($pdo, $nome, $cpf, $email, $senhaHash, $telefone)
  {
   
    $stmt = $pdo->prepare(
      <<<SQL
      INSERT INTO usuario (nome, cpf, email, senhaHash, telefone)
      VALUES (?, ?, ?, ?, ?)
      SQL
    );

    // Executa a declaração preparada fornecendo valores aos parâmetros (pontos-de-interrogação)
    $stmt->execute([$nome, $cpf, $email, $senhaHash, $telefone]);

    // retorna o Id do novo cliente criado
    return $pdo->lastInsertId();
  }



  
}
