<?php

// inicializa a sessão
session_start();

// resgata o nome e o e-mail recebidos pelo formulário
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';

// armazena os valores em variáveis de sessão para que outros
// scripts possam acessar enquanto a sessão estiver ativa.
// Os dados ficam associados a apenas esta sessão do usuário 
// (outros usuários do site não terão acesso).
$_SESSION['nome']  = $nome;
$_SESSION['email'] = $email;

?>
<!DOCTYPE html>
<html><body>
  <h2>Variáveis de sessão definidas!</h2>
  <h3>
    <a href="teste-sessao2.php">
      Acessar outro script PHP
    </a>
  </h3>
</body></html>

