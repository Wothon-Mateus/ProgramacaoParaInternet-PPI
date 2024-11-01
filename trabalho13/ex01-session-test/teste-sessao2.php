<?php

// abre a sessão criada anteriormente pelo script teste-sessao1.php
session_start();

?>

<!DOCTYPE html>
<html><body>

<?php

// acessa as variáveis de sessão definidas pelo script anterior
$nome  = $_SESSION['nome'];
$email = $_SESSION['email'];

echo "Bem vindo, $nome <br>";
echo "Seu e-mail é $email <br>";
echo "Dados guardados em var. de sessão pela pág. ant.";

?>

</body>
</html>

