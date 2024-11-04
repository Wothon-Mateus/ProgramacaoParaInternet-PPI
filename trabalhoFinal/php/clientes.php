<?php

class Cliente
{
  static function Create($pdo,
    $nome, $cpf, $email, $senha, $telefone) 
  {
    try {
      $pdo->beginTransaction();

      // Inserção na tabela cliente. Repare que o campo id foi omitido por do tipo auto_increment
      // É necessário utilizar prepared statements para prevenir
      // inj. de S Q L, pois temos parâmetros fornecidos pelo usuário.
      // Uma exceção será lançada em caso de falha no prepare ou no execute.
      $stmt1 = $pdo->prepare(
        <<<SQL
        INSERT INTO anunciante  (nome, cpf, email, senha_hash, telefone)
        VALUES (?, ?, ?, ?, ?)
        SQL
      );
      $stmt1->execute([$nome, $cpf, $email, $senha, $telefone]);

      // Efetiva as operações
      $pdo->commit();
    } 
    catch (Exception $e) {
      // Caso ocorra alguma falha nas operações da transação, a operação
      // rollback irá desfazer as operações que eventualmente tenham sido feitas,
      // voltando o BD ao estado em que se encontrava antes da chamada
      // de beginTransaction.
      $pdo->rollBack();
      throw $e;
    }

    // retorna o Id do novo cliente criado
    return $pdo->lastInsertId();
  }

}
