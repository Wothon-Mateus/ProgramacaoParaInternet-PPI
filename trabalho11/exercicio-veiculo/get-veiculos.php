<?php

header('Content-Type: application/json');
require "conexaoMysql.php";
$pdo = mysqlConnect();

$modelo = isset($_GET['modelo']) ? $_GET['modelo'] : '';

try {
    $query = "SELECT modelo, ano, cor, quilometragem FROM veiculo WHERE modelo = :modelo ORDER BY ano DESC";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':modelo', $modelo, PDO::PARAM_STR);
    $stmt->execute();

    $veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($veiculos);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro ao buscar veículos: ' . $e->getMessage()]);
}
?>
