<?php
require_once '../config/conexaoMysql.php';

class InteresseController {
    public function registrarInteresse() {
        $pdo = mysqlConnect();
        $id_anuncio = $_POST['id_anuncio'] ?? '';
        $nome = $_POST['nome'] ?? '';
        $telefone = $_POST['telefone'] ?? '';
        $mensagem = $_POST['mensagem'] ?? '';

        try {
            $sql = "INSERT INTO interesse (id_anuncio, nome, telefone, mensagem) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id_anuncio, $nome, $telefone, $mensagem]);
            header("Location: ../interesse.php?status=success");
            exit();
        } catch (Exception $e) {
            header("Location: ../interesse.php?status=error");
            exit();
        }
    }

    public function listarInteresses($id_usuario) {
        $pdo = mysqlConnect();

        $sql = "SELECT interesse.nome, interesse.telefone, interesse.mensagem, interesse.data_hora,
                       anuncio.marca, anuncio.modelo, anuncio.ano
                FROM interesse
                INNER JOIN anuncio ON interesse.id_anuncio = anuncio.id
                WHERE anuncio.id_anunciante = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Verificação de ação para chamada do método
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new InteresseController();
    $controller->registrarInteresse();
}
?>
