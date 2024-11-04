<?php

require "../php/conexaoMysql.php";
$pdo = mysqlConnect();




if (
    isset($_POST["nome"]) &&
    isset($_POST["cpf"]) &&
    isset($_POST["email"]) &&
    isset($_POST["tel"]) &&
    isset($_POST["password"])
) {

    // Verifica se todos os campos estão preenchidos
    if (
        !empty($_POST["nome"]) &&
        !empty($_POST["cpf"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["tel"]) &&
        !empty($_POST["password"])
    ) {
        $name = $_POST["nome"] ?? "";
        $cpf = $_POST["cpf"] ?? "";
        $email = $_POST["email"] ?? "";
        $phone = $_POST["tel"] ?? "";
        $password = $_POST["password"] ?? "";

        $hashpassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Inicia a transação
            $pdo->beginTransaction();

            $selectsql = "SELECT Email, CPF FROM Anunciante
                WHERE Email = ? OR CPF = ?";
            $stmt = $pdo->prepare($selectsql);
            $stmt->execute([$email, $cpf]);

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                if ($row['Email'] === $email) {
                    echo "Usuário já existente";
                    http_response_code(400);
                    exit;
                }
                if ($row['CPF'] === $cpf) {
                    echo "CPF já existente";
                    http_response_code(400);
                    exit;
                }
            }

            $sql = <<<SQL
    INSERT INTO Anunciante (Nome, CPF, Email, SenhaHash, Telefone)
    VALUES (?, ?, ?, ?, ?)
    SQL;

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $cpf, $email, $hashpassword, $phone]);
            $userid = $pdo->lastInsertId();
            // Realiza as validações adicionais
            $affectedRows = $stmt->rowCount();
            if ($affectedRows != 1) {
                throw new Exception("Falha ao cadastrar os dados");
            }

            // Commit da transação
            $pdo->commit();
            session_start();
            $_SESSION['loggedIn'] = true;
            $_SESSION['user'] = $email;
            $_SESSION['id'] = $userid;
            http_response_code(200);
            exit();
        } catch (PDOException $e) {
            // Rollback da transação em caso de exceção
            $pdo->rollback();

            // Tratamento de exceção
            if ($e->getCode() === 23000) {
                http_response_code(400);
                exit('Dados duplicados: ' . $e->getMessage());
            } else {
                http_response_code(400);
                exit('Falha ao cadastrar os dados: ' . $e->getMessage());
            }
        } catch (Exception $e) {
            // Rollback da transação em caso de exceção
            $pdo->rollback();
            http_response_code(400);
            exit('Falha ao cadastrar os dados: ' . $e->getMessage());
        }
    } else {
        http_response_code(400);
        exit("Por favor, preencha todos os campos obrigatórios.");
    }
} else {
    $camposFaltando = array();

    if (!isset($_POST["nome"])) {
        $camposFaltando[] = "nome";
    }

    if (!isset($_POST["cpf"])) {
        $camposFaltando[] = "cpf";
    }

    if (!isset($_POST["email"])) {
        $camposFaltando[] = "email";
    }

    if (!isset($_POST["tel"])) {
        $camposFaltando[] = "tel";
    }

    if (!isset($_POST["password"])) {
        $camposFaltando[] = "senha";
    }

    http_response_code(400);
    exit("Alguns campos estão faltando no formulário: " . implode(", ", $camposFaltando));
}
