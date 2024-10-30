<?php
session_start();
require_once '../config/conexaoMysql.php';

class UsuarioController {

    // Método para cadastrar o usuário
    public function cadastrarUsuario() {
        $pdo = mysqlConnect();
        $nome = $_POST['nome'] ?? '';
        $cpf = $_POST['cpf'] ?? '';
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $telefone = $_POST['telefone'] ?? '';
        
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO anunciante (nome, cpf, email, senha_hash, telefone) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $cpf, $email, $senhaHash, $telefone]);
            header("Location: ../login.html?status=success");
            exit();
        } catch (Exception $e) {
            header("Location: ../cadastro.html?status=error");
            exit();
        }
    }

    // Método para login do usuário
    public function loginUsuario() {
        $pdo = mysqlConnect();
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $sql = "SELECT id, senha_hash FROM anunciante WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha_hash'])) {
            $_SESSION['id_usuario'] = $usuario['id'];
            $_SESSION['email_usuario'] = $email;
            header("Location: ../dashboard.php");
            exit();
        } else {
            header("Location: ../login.html?status=error");
            exit();
        }
    }
}

// Verificação de ação para chamada dos métodos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UsuarioController();
    
    // Identifica se é um cadastro ou login com base em um campo específico
    if (isset($_POST['acao']) && $_POST['acao'] === 'cadastrar') {
        $controller->cadastrarUsuario();
    } elseif (isset($_POST['acao']) && $_POST['acao'] === 'login') {
        $controller->loginUsuario();
    }
}
?>
