<?php

class LoginResult
{
  public $isAuthorized;
  public $newLocation;

  function __construct($isAuthorized, $newLocation)
  {
    $this->isAuthorized = $isAuthorized;
    $this->newLocation = $newLocation;
  }
}

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

// Validação simplificada para fins didáticos. Não faça isso!
if ($email == 'fulano@mail.com' && $senha == '123456')
  $loginResult = new LoginResult(true, 'home.html');
else
  $loginResult = new LoginResult(false, '');

header('Content-type: application/json');
echo json_encode($loginResult);