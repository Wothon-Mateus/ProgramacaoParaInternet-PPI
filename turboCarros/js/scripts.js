async function buscarAnuncios() {
    const marca = document.getElementById("marca").value;
    const modelo = document.getElementById("modelo").value;
    const cidade = document.getElementById("cidade").value;

    const response = await fetch(`controllers/AnuncioController.php?marca=${marca}&modelo=${modelo}&cidade=${cidade}`);
    const anuncios = await response.json();

    const lista = document.getElementById("anuncios");
    lista.innerHTML = '';

    anuncios.forEach(anuncio => {
        const card = document.createElement("div");
        card.className = "card";

        card.innerHTML = `
            <h3>${anuncio.marca} ${anuncio.modelo} - ${anuncio.ano}</h3>
            <p>Cor: ${anuncio.cor}</p>
            <p>Quilometragem: ${anuncio.quilometragem} km</p>
            <p>Valor: R$ ${anuncio.valor}</p>
            <p>Localização: ${anuncio.cidade} - ${anuncio.estado}</p>
        `;

        lista.appendChild(card);
    });
}
