<?php
require "conexaoMysql.php"; // Inclua a conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $marca = $_POST["marca"] ?? "";
    $modelo = $_POST["modelo"] ?? "";
    $ano = $_POST["ano"] ?? 0;
    $cor = $_POST["cor"] ?? "";
    $quilometragem = $_POST["quilometragem"] ?? 0;
    $descricao = $_POST["descricao"] ?? "";
    $valor = $_POST["valor"] ?? 0.0;
    $estado = $_POST["estado"] ?? "";
    $cidade = $_POST["cidade"] ?? "";
    $id_anunciante = 1; // Altere isso para pegar o ID do anunciante logado

    // Verifica se os arquivos foram enviados
    if (!isset($_FILES['fotos'])) {
        echo json_encode(["status" => "error", "message" => "Nenhuma foto enviada."]);
        exit;
    }

    // Conecta ao banco de dados
    $pdo = mysqlConnect();

    // Inicia a transação
    $pdo->beginTransaction();

    try {
        // Insere o anúncio
        $stmt = $pdo->prepare("INSERT INTO anuncio (id_anunciante, marca, modelo, ano, cor, quilometragem, descricao, valor, estado, cidade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id_anunciante, $marca, $modelo, $ano, $cor, $quilometragem, $descricao, $valor, $estado, $cidade]);

        // Obtém o ID do anúncio recém-inserido
        $id_anuncio = $pdo->lastInsertId();

        // Manipula o upload das fotos
        $diretorio = "uploads/"; // Subpasta onde as fotos serão armazenadas
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0777, true); // Cria a pasta caso não exista
        }

        $fotos = $_FILES['fotos'];
        for ($i = 0; $i < count($fotos['name']); $i++) {
            $nomeArquivo = uniqid() . '-' . basename($fotos['name'][$i]); // Renomeia o arquivo
            $caminhoArquivo = $diretorio . $nomeArquivo;

            // Move o arquivo para a pasta de uploads
            if (move_uploaded_file($fotos['tmp_name'][$i], $caminhoArquivo)) {
                // Insere o nome do arquivo na tabela foto
                $stmt = $pdo->prepare("INSERT INTO foto (id_anuncio, nome_arquivo) VALUES (?, ?)");
                $stmt->execute([$id_anuncio, $nomeArquivo]);
            } else {
                throw new Exception("Erro ao fazer upload do arquivo: " . $fotos['name'][$i]);
            }
        }

        // Commit da transação
        $pdo->commit();

        echo json_encode(["status" => "success", "message" => "Anúncio criado com sucesso!"]);
    } catch (Exception $e) {
        // Rollback da transação em caso de erro
        $pdo->rollBack();
        echo json_encode(["status" => "error", "message" => "Erro ao criar anúncio: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Método de requisição não suportado."]);
}
?>
