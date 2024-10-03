<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listagem de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <h3>Clientes Cadastrados</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>CEP</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (file_exists('clientes.txt')) {
                    $linhas = file('clientes.txt');
                    foreach ($linhas as $linha) {
                        list($nome, $cpf, $email, $senha, $cep, $endereco, $bairro, $cidade, $estado) = explode(',', trim($linha));
                        echo <<<HTML
                            <tr>
                                <td>$nome</td>
                                <td>$cpf</td>
                                <td>$email</td>
                                <td>$cep</td>
                                <td>$endereco</td>
                                <td>$bairro</td>
                                <td>$cidade</td>
                                <td>$estado</td>
                            </tr>
                        HTML;
                    }
                }
                ?>
            </tbody>
        </table>
        <a href="index.html">Voltar à página inicial</a>
    </div>

</body>

</html>
