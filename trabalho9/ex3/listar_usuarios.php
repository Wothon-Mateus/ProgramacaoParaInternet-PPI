<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listagem de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h3>Usuários Cadastrados</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>E-mail</th>
                    <th>Hash da Senha</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (file_exists('usuarios.txt')) {
                    $linhas = file('usuarios.txt');
                    foreach ($linhas as $linha) {
                        list($email, $hashSenha) = explode(',', trim($linha));
                        echo <<<HTML
                            <tr>
                                <td>$email</td>
                                <td>$hashSenha</td>
                            </tr>
                        HTML;
                    }
                }
                ?>
            </tbody>
        </table>
        <a href="index.html">Voltar à página principal</a>
    </div>

</body>

</html>
