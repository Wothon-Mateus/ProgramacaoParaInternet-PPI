<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Anúncio - TurboCarros</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Criar Anúncio de Veículo</h1>
    </header>
    <main>
        <form id="form-anuncio" action="controllers/AnuncioController.php" method="post" enctype="multipart/form-data">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required>

            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required>

            <label for="ano">Ano:</label>
            <input type="number" id="ano" name="ano" required>

            <label for="cor">Cor:</label>
            <input type="text" id="cor" name="cor" required>

            <label for="quilometragem">Quilometragem:</label>
            <input type="number" id="quilometragem" name="quilometragem" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>

            <label for="valor">Valor:</label>
            <input type="text" id="valor" name="valor" required>

            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" required>

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" required>

            <label for="fotos">Fotos do Veículo:</label>
            <input type="file" id="fotos" name="fotos[]" multiple required>

            <button type="submit">Criar Anúncio</button>
        </form>
    </main>
</body>
</html>
