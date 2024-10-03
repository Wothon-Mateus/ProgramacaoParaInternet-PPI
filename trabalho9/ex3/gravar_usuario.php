<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Hash da senha
    $hashSenha = password_hash($senha, PASSWORD_DEFAULT);

    // Sanitizar o e-mail
    $email = htmlspecialchars($email);

    // Armazenar e-mail e hash da senha no arquivo usuarios.txt
    $linha = "$email,$hashSenha\n";
    file_put_contents('usuarios.txt', $linha, FILE_APPEND);

    // Redirecionar para a página principal
    header('Location: index.html');
    exit();
}
?>
