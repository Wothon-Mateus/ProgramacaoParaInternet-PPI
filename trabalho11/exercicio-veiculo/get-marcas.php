<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obter as marcas distintas de veículos
    $query = $pdo->query("SELECT DISTINCT marca FROM veiculo ORDER BY marca ASC");

    // Fetch os resultados e transforma em um array
    $marcas = $query->fetchAll(PDO::FETCH_COLUMN);

    // Define o cabeçalho da resposta como JSON
    header('Content-Type: application/json');
    echo json_encode($marcas);
} catch (PDOException $e) {
    echo 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
}
