<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nomeCompleto'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    // Sanitizar os dados
    $nome = htmlspecialchars($nome);
    $cpf = htmlspecialchars($cpf);
    $email = htmlspecialchars($email);
    $senha = htmlspecialchars($senha);
    $cep = htmlspecialchars($cep);
    $endereco = htmlspecialchars($endereco);
    $bairro = htmlspecialchars($bairro);
    $cidade = htmlspecialchars($cidade);
    $estado = htmlspecialchars($estado);

    // Armazenar os dados no arquivo clientes.txt
    $linha = "$nome,$cpf,$email,$senha,$cep,$endereco,$bairro,$cidade,$estado\n";
    file_put_contents('clientes.txt', $linha, FILE_APPEND);
    
    // Redirecionar para a página de listagem
    header('Location: listarCliente.php');
    exit();
}
?>
