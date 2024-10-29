<?php
require "conexaoMysql.php"; // Inclua a conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $nome = $_POST["nome"] ?? "";
    $cpf = $_POST["cpf"] ?? "";
    $email = $_POST["email"] ?? "";
    $senha = $_POST["senha"] ?? "";
    $telefone = $_POST["telefone"] ?? "";

    // Gera o hash da senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Conecta ao banco de dados
    $pdo = mysqlConnect();

    try {
        // Prepara a consulta SQL para inserir o novo usuário
        $stmt = $pdo->prepare("INSERT INTO usuario (nome, cpf, email, senhaHash, telefone) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $cpf, $email, $senhaHash, $telefone]);

        // Redireciona ou exibe uma mensagem de sucesso
        echo "<p>Usuário cadastrado com sucesso!</p>";
        echo "<a href='login.html'>Fazer login</a>";
    } catch (PDOException $e) {
        // Trata erros de inserção
        echo "<p>Erro ao cadastrar usuário: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>Método de requisição não suportado.</p>";
}
?>
