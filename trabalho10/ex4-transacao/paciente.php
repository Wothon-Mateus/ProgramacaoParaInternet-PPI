<?php

class Paciente
{
    static function Create($pdo, $nome, $sexo, $email, $peso, $altura, $tipoSanguineo)
    {
        try {
            $pdo->beginTransaction();

            // Inserção na tabela Pessoa
            $stmt1 = $pdo->prepare(
                <<<SQL
                INSERT INTO Pessoa (Nome, Sexo, Email)
                VALUES (?, ?, ?)
                SQL
            );
            $stmt1->execute([$nome, $sexo, $email]);
            $idNovaPessoa = $pdo->lastInsertId();

            // Inserção na tabela Paciente
            $stmt2 = $pdo->prepare(
                <<<SQL
                INSERT INTO Paciente (Peso, Altura, TipoSanguineo, IdPessoa)
                VALUES (?, ?, ?, ?)
                SQL
            );
            $stmt2->execute([$peso, $altura, $tipoSanguineo, $idNovaPessoa]);

            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }

        return $pdo->lastInsertId();
    }

    static function GetFirst30($pdo)
    {
        $stmt = $pdo->query(
            <<<SQL
            SELECT Pessoa.Id, Pessoa.Nome, Pessoa.Sexo, Pessoa.Email,
                   Paciente.Peso, Paciente.Altura, Paciente.TipoSanguineo
            FROM Pessoa INNER JOIN Paciente ON Pessoa.Id = Paciente.IdPessoa
            LIMIT 30
            SQL
        );

        $arrayPacientes = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $arrayPacientes;
    }
}
