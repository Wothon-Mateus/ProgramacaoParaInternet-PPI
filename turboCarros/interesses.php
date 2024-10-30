<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mensagens de Interesse - TurboCarros</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Mensagens de Interesse</h1>
    </header>
    <main>
        <section id="lista-interesses">
            <?php
            session_start();
            require_once 'controllers/InteresseController.php';
            $controller = new InteresseController();
            $interesses = $controller->listarInteresses($_SESSION['id_usuario']);

            foreach ($interesses as $interesse) {
                echo "<div class='interesse-card'>";
                echo "<h3>{$interesse['marca']} {$interesse['modelo']} - {$interesse['ano']}</h3>";
                echo "<p><strong>Nome:</strong> {$interesse['nome']}</p>";
                echo "<p><strong>Telefone:</strong> {$interesse['telefone']}</p>";
                echo "<p><strong>Mensagem:</strong> {$interesse['mensagem']}</p>";
                echo "<p><strong>Data:</strong> {$interesse['data_hora']}</p>";
                echo "</div>";
            }
            ?>
        </section>
    </main>
</body>
</html>
