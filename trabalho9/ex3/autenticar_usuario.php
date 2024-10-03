<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Sanitizar o e-mail
    $email = htmlspecialchars($email);

    // Verificar os dados no arquivo usuarios.txt
    if (file_exists('usuarios.txt')) {
        $linhas = file('usuarios.txt');
        foreach ($linhas as $linha) {
            list($emailArmazenado, $hashSenhaArmazenada) = explode(',', trim($linha));

            // Verifica se o e-mail corresponde e se a senha é válida
            if ($email === $emailArmazenado && password_verify($senha, $hashSenhaArmazenada)) {
                // Sucesso no login, redireciona para página de sucesso
                header('Location: login_sucesso.html');
                exit();
            }
        }
    }

    // Falha no login, redireciona para a página de login
    header('Location: login.html');
    exit();
}
?>
