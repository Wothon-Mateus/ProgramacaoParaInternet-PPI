<?php

function exitWhenNotLoggedIn()
{ 
  if (!isset($_SESSION['loggedIn'])) {
    header("Location: index.html");
    exit();  
  }
}
// Essa função foi criado para verificar se a usuario de fato de logando 
// caso não esteja o usuario e direciomando a pagima index.html