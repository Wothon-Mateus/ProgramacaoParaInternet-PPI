<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - TurboCarros</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Bem-vindo ao TurboCarros, <?php echo $_SESSION['email_usuario'] ?? 'Usuário'; ?></h1>
        <nav>
            <a href="criar-anuncio.php">Criar Anúncio</a>
            <a href="meus-anuncios.php">Meus Anúncios</a>
            <a href="interesses.php">Mensagens de Interesse</a>
            <a href="logout.php">Sair</a>
        </nav>
    </header>
    <main>
        <h2>Painel do Usuário</h2>
        <p>Aqui você pode gerenciar seus anúncios e ver mensagens de interessados.</p>
    </main>
</body>
</html>
