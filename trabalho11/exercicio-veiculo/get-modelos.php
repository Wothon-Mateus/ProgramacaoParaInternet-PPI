<?php

header('Content-Type: application/json');
require "conexaoMysql.php";
$pdo = mysqlConnect();

$marca = isset($_GET['marca']) ? $_GET['marca'] : '';

try {
    $query = "SELECT DISTINCT modelo FROM veiculo WHERE marca = :marca ORDER BY modelo ASC";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
    $stmt->execute();

    $modelos = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode($modelos);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro ao buscar modelos: ' . $e->getMessage()]);
}
?>