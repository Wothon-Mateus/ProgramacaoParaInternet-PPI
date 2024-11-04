<?php

class RequestResponse
{
  public $success;
  public $detail;

  function __construct($success, $detail)
  {
    $this->success = $success;
    $this->detail = $detail;
  }
}
function checkLogin($pdo, $email, $password, &$userid)
{
    $sql = <<<SQL
        SELECT SenhaHash, Codigo
        FROM Anunciante
        WHERE Email = ?
        SQL;

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $senhaHash = $resultado['SenhaHash'];
        $userid = $resultado['Codigo'];
        if (!$userid) 
        return false; 
        if (!$senhaHash) 
        return false; 
      if (!password_verify($password, $senhaHash))
        return false; // senha incorreta
        
      // email e senha corretos
      return true;
    }
    catch (Exception $e) {
        exit('Falha inesperada: ' . $e->getMessage());
    }
}

require "conexaoMysql.php";
$pdo = mysqlConnect();

$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";
$userid = 0;

if (checkLogin($pdo, $email, $password, $userid)){
  session_start();
  $_SESSION['loggedIn'] = true;
  $_SESSION['user'] = $email;
  $_SESSION['id'] = $userid;
  $response = new RequestResponse(true, '../php/home.php');
}
else{
    $response = new RequestResponse(false, ''); 
}
echo json_encode($response);