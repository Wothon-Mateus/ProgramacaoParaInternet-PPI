<?php
require "conexaoMysql.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca = $_POST["marca"] ?? "";
    $modelo = $_POST["modelo"] ?? "";
    $ano = $_POST["ano"] ?? 0;
    $cor = $_POST["cor"] ?? "";
    $quilometragem = $_POST["quilometragem"] ?? 0;
    $descricao = $_POST["descricao"] ?? "";
    $valor = $_POST["valor"] ?? 0.0;
    $estado = $_POST["estado"] ?? "";
    $cidade = $_POST["cidade"] ?? "";
    $id_anunciante = 1;

    if (!isset($_FILES['fotos'])) {
        echo json_encode(["status" => "error", "message" => "Nenhuma foto enviada."]);
        exit;
    }

    $pdo = mysqlConnect();
    $pdo->beginTransaction();

    try {
        $stmt = $pdo->prepare("INSERT INTO anuncio (id_anunciante, marca, modelo, ano, cor, quilometragem, descricao, valor, estado, cidade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id_anunciante, $marca, $modelo, $ano, $cor, $quilometragem, $descricao, $valor, $estado, $cidade]);

        $id_anuncio = $pdo->lastInsertId();
        $diretorio = "uploads/";
        if (!is_dir($diretorio)) mkdir($diretorio, 0777, true);

        $fotos = $_FILES['fotos'];
        $nomesFotos = [];

        for ($i = 0; $i < count($fotos['name']); $i++) {
            $nomeArquivo = uniqid() . '-' . basename($fotos['name'][$i]);
            $caminhoArquivo = $diretorio . $nomeArquivo;

            if (move_uploaded_file($fotos['tmp_name'][$i], $caminhoArquivo)) {
                $stmt = $pdo->prepare("INSERT INTO foto (id_anuncio, nome_arquivo) VALUES (?, ?)");
                $stmt->execute([$id_anuncio, $nomeArquivo]);
                $nomesFotos[] = $nomeArquivo;
            } else {
                throw new Exception("Erro ao fazer upload do arquivo: " . $fotos['name'][$i]);
            }
        }

        $pdo->commit();

        echo json_encode([
            "status" => "success",
            "message" => "Anúncio criado com sucesso!",
            "anuncio" => [
                "marca" => $marca,
                "modelo" => $modelo,
                "ano" => $ano,
                "cor" => $cor,
                "quilometragem" => $quilometragem,
                "descricao" => $descricao,
                "valor" => $valor,
                "estado" => $estado,
                "cidade" => $cidade,
                "fotos" => $nomesFotos
            ]
        ]);
    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(["status" => "error", "message" => "Erro ao criar anúncio: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Método de requisição não suportado."]);
}
?>
