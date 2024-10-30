<?php
session_start(); // Inicia a sessão
require "conexaoMysql.php"; // Inclui o arquivo de conexão

// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $email = $_POST["email"] ?? "";
    $senha = $_POST["senha"] ?? "";

    // Conecta ao banco de dados
    $pdo = mysqlConnect();

    try {
        // Prepara a consulta SQL para buscar o usuário pelo email
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário existe e se a senha está correta
        if ($usuario && password_verify($senha, $usuario['senhaHash'])) {
            // Armazena os dados do usuário na sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];

            // Redireciona para a página restrita
            header("Location: bem_vindo.php");
            exit();
        } else {
            // Mensagem de erro caso as credenciais estejam incorretas
            echo "<p>Email ou senha incorretos!</p>";
            echo "<a href='login.html'>Tente novamente</a>";
        }
    } catch (Exception $e) {
        // Em caso de erro, mostra a mensagem de erro
        echo "<p>Erro ao realizar login: " . $e->getMessage() . "</p>";
        echo "<a href='login.html'>Tente novamente</a>";
    }
} else {
    echo "<p>Método de requisição não suportado.</p>";
}
?>
