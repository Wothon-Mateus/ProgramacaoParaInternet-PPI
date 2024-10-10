<?php

function mysqlConnect()
{
  $db_host = "sql104.infinityfree.com";
  $db_username = "if0_37069074_wothonppi";
  $db_password = "mUvj2CXQjaMYz";
  $db_name = "if0_37069074";

  $options = [
    PDO::ATTR_EMULATE_PREPARES => false, // desativa a execução emulada de prepared statements
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ];

  try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_username, $db_password, $options);
    return $pdo;
  } 
  catch (Exception $e) {
    exit('Ocorreu uma falha na conexão com o MySQL: ' . $e->getMessage());
  }
}
?>
