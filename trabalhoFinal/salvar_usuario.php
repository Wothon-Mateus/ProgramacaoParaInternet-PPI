<?php
require "conexaoMysql.php"; // Inclui o arquivo de conexão
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
        // Prepara a consulta SQL para inserir os dados
        $stmt = $pdo->prepare(
            "INSERT INTO usuario (nome, cpf, email, senhaHash, telefone) 
            VALUES (?, ?, ?, ?, ?)"
        );

        // Executa a consulta
        $stmt->execute([$nome, $cpf, $email, $senhaHash, $telefone]);

        // Mensagem de sucesso
        echo "<p>Usuário cadastrado com sucesso!</p>";
        echo "<a href='cadastro.html'>Cadastrar outro usuário</a>";
    } catch (Exception $e) {
        // Em caso de erro, mostra a mensagem de erro
        echo "<p>Erro ao cadastrar: " . $e->getMessage() . "</p>";
        echo "<a href='cadastro.html'>Tente novamente</a>";
    }
} else {
    echo "<p>Método de requisição não suportado.</p>";
}
?>
