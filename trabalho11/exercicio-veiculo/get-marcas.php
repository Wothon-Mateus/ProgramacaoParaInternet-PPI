<?php

header('Content-Type: application/json');
require "conexaoMysql.php";
$pdo = mysqlConnect();

try {
    $query = "SELECT DISTINCT marca FROM veiculo ORDER BY marca ASC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $marcas = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode($marcas);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro ao buscar marcas: ' . $e->getMessage()]);
}
?>