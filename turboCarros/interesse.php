<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registrar Interesse - TurboCarros</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Demonstrar Interesse no Veículo</h1>
    </header>
    <main>
        <form id="form-interesse" action="controllers/InteresseController.php" method="post">
            <input type="hidden" name="id_anuncio" value="<?php echo $_GET['id_anuncio']; ?>">

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" required>

            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem" name="mensagem" required></textarea>

            <button type="submit">Enviar Interesse</button>
        </form>
    </main>
</body>
</html>
