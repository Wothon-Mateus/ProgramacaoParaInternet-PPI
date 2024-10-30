<?php
session_start();
require_once '../config/conexaoMysql.php';

class AnuncioController {
    public function criarAnuncio() {
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: ../login.html");
            exit();
        }

        $pdo = mysqlConnect();
        $id_anunciante = $_SESSION['id_usuario'];
        $marca = $_POST['marca'] ?? '';
        $modelo = $_POST['modelo'] ?? '';
        $ano = $_POST['ano'] ?? 0;
        $cor = $_POST['cor'] ?? '';
        $quilometragem = $_POST['quilometragem'] ?? 0;
        $descricao = $_POST['descricao'] ?? '';
        $valor = $_POST['valor'] ?? 0;
        $estado = $_POST['estado'] ?? '';
        $cidade = $_POST['cidade'] ?? '';

        try {
            // Iniciar uma transação
            $pdo->beginTransaction();

            // Inserir o anúncio
            $sqlAnuncio = "INSERT INTO anuncio (id_anunciante, marca, modelo, ano, cor, quilometragem, descricao, valor, estado, cidade) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtAnuncio = $pdo->prepare($sqlAnuncio);
            $stmtAnuncio->execute([$id_anunciante, $marca, $modelo, $ano, $cor, $quilometragem, $descricao, $valor, $estado, $cidade]);

            // Obter o último ID de anúncio inserido
            $id_anuncio = $pdo->lastInsertId();

            // Processar as fotos
            foreach ($_FILES['fotos']['tmp_name'] as $key => $tmpName) {
                $nomeFoto = basename($_FILES['fotos']['name'][$key]);
                $caminhoFoto = "../img/$id_anuncio-" . uniqid() . "-" . $nomeFoto;

                if (move_uploaded_file($tmpName, $caminhoFoto)) {
                    $sqlFoto = "INSERT INTO foto (id_anuncio, caminho_foto) VALUES (?, ?)";
                    $stmtFoto = $pdo->prepare($sqlFoto);
                    $stmtFoto->execute([$id_anuncio, $caminhoFoto]);
                }
            }

            // Confirmar a transação
            $pdo->commit();
            header("Location: ../dashboard.php?status=anuncio_criado");
            exit();
        } catch (Exception $e) {
            $pdo->rollBack();
            header("Location: ../criar-anuncio.php?status=error");
            exit();
        }
    }

    public function listarAnuncios() {
        $marca = $_GET['marca'] ?? '';
        $modelo = $_GET['modelo'] ?? '';
        $cidade = $_GET['cidade'] ?? '';

        $pdo = mysqlConnect();
        $sql = "SELECT * FROM anuncio WHERE (marca = ? OR ? = '') AND (modelo = ? OR ? = '') AND (cidade = ? OR ? = '')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$marca, $marca, $modelo, $modelo, $cidade, $cidade]);

        $anuncios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($anuncios);
    }
}

// Verificação de ação para chamada do método
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AnuncioController();
    $controller->criarAnuncio();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new AnuncioController();
    $controller->listarAnuncios();
}
?>
