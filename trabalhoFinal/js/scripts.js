// Funções comuns para todas as páginas (como navegação e logoff)
document.querySelectorAll('nav ul li a').forEach(link => {
    link.addEventListener('click', function(event) {
        // Prevenir comportamento padrão e redirecionar de forma suave
        event.preventDefault();
        window.location.href = link.getAttribute('href');
    });
});

// O logout. html não consequi fazer apenas usado js, css e html 

// Função de logout simulada
function logoff() {
    if (confirm("Tem certeza que deseja sair?")) {
        window.location.href = "logout.html"; // Redireciona para logout
    }
}

// 2.2 - Cadastro de Usuário
document.getElementById('form-cadastro')?.addEventListener('submit', function(event) {
    event.preventDefault();
    const nome = document.getElementById('nome').value;
    const cpf = document.getElementById('cpf').value;
    const email = document.getElementById('email').value;
    const senha = document.getElementById('senha').value;
    const telefone = document.getElementById('telefone').value;

    if (nome && cpf && email && senha && telefone) {
        alert("Cadastro realizado com sucesso!");
        // Aqui você pode redirecionar para a página de login
        window.location.href = "login.html";
    } else {
        alert("Preencha todos os campos.");
    }
});

// 2.3 - Login
document.getElementById('form-login')?.addEventListener('submit', function(event) {
    event.preventDefault();
    const email = document.getElementById('emailLogin').value;
    const senha = document.getElementById('senhaLogin').value;

    if (email === "teste@gmail.com" && senha === "senha123") {
        alert("Login realizado com sucesso!");
        window.location.href = "painel-interno.html"; // Redireciona para área restrita
    } else {
        alert("Credenciais inválidas.");
    }
});

// Função para verificar se o usuário está logado
function verificarLogin() {
    if (!sessionStorage.getItem('logado')) {
        alert("Você precisa estar logado para acessar essa página.");
        window.location.href = "login.html"; // Redireciona para a página de login
    }
}


// 2.4 - Registro de Interesse
document.getElementById('formInteresse')?.addEventListener('submit', function(event) {
    event.preventDefault();
    const nome = document.getElementById('nomeInteresse').value;
    const telefone = document.getElementById('telefoneInteresse').value;
    const mensagem = document.getElementById('mensagemInteresse').value;

    if (nome && telefone && mensagem) {
        alert("Mensagem de interesse enviada com sucesso!");
        // Simulação de envio da mensagem ao dono do anúncio
    } else {
        alert("Por favor, preencha todos os campos.");
    }
});

/// 2.6 - Criação de Anúncio de Veículo
document.getElementById('form-anuncio')?.addEventListener('submit', function(event) {
    event.preventDefault();

    const marca = document.getElementById('marca').value;
    const modelo = document.getElementById('modelo').value;
    const ano = document.getElementById('ano').value;
    const cor = document.getElementById('cor').value;
    const quilometragem = document.getElementById('quilometragem').value;
    const descricao = document.getElementById('descricao').value;
    const valor = document.getElementById('valor').value;
    const estado = document.getElementById('estado').value;
    const cidade = document.getElementById('cidade').value;
    const fotos = document.getElementById('fotos').files;

    if (marca && modelo && ano && cor && quilometragem && descricao && valor && estado && cidade && fotos.length >= 3) {
        const anuncios = JSON.parse(localStorage.getItem('anuncios')) || [];

        const novoAnuncio = {
            marca,
            modelo,
            ano,
            cor,
            quilometragem,
            descricao,
            valor,
            estado,
            cidade,
            fotos: URL.createObjectURL(fotos[0]), // Apenas a primeira foto será mostrada
            interesses: [] // Inicializa os interesses como vazio
        };

        anuncios.push(novoAnuncio);
        localStorage.setItem('anuncios', JSON.stringify(anuncios));

        alert("Anúncio criado com sucesso!");
        window.location.href = "meus-anuncios.html"; // Redireciona para a listagem de anúncio
    } else {
        alert("Preencha todos os campos e envie pelo menos 3 fotos.");
    }
});

// - Listagem de Anúncios
function carregarAnuncios() {
    const anuncios = JSON.parse(localStorage.getItem('anuncios')) || [];
    const container = document.querySelector('.anuncios-listagem');
    container.innerHTML = ''; // Limpa o container antes de carregar

    anuncios.forEach((anuncio, index) => {
        const card = `
            <div class="anuncio-card">
                <img src="${anuncio.fotos}" alt="Foto do veículo">
                <div class="anuncio-info">
                    <h3>${anuncio.marca} ${anuncio.modelo} - ${anuncio.ano}</h3>
                    <p><strong>Cor:</strong> ${anuncio.cor}</p>
                    <p><strong>Quilometragem:</strong> ${anuncio.quilometragem}</p>
                    <p><strong>Valor:</strong> R$${anuncio.valor}</p>
                </div>
                <div class="anuncio-acoes">
                    <button class="btn-detalhes" onclick="exibirDetalhes(${index})">Detalhes</button>
                    <button class="btn-interesses" onclick="exibirInteresses(${index})">Interesses</button>
                    <button class="btn-excluir" onclick="excluirAnuncio(${index})">Excluir</button>
                </div>
            </div>
        `;
        container.innerHTML = card;
    });
}

function exibirDetalhes(index) {
    const anuncios = JSON.parse(localStorage.getItem('anuncios')) || [];
    const anuncio = anuncios[index];

    document.getElementById('detalhesMarca').innerText = anuncio.marca;
    document.getElementById('detalhesModelo').innerText = anuncio.modelo;
    document.getElementById('detalhesAno').innerText = anuncio.ano;
    document.getElementById('detalhesCor').innerText = anuncio.cor;
    document.getElementById('detalhesQuilometragem').innerText = anuncio.quilometragem;
    document.getElementById('detalhesEstado').innerText = anuncio.estado;
    document.getElementById('detalhesCidade').innerText = anuncio.cidade;
    document.getElementById('detalhesDescricao').innerText = anuncio.descricao;
    document.getElementById('detalhesValor').innerText = `R$ ${anuncio.valor}`;

    window.location.href = "detalhes-anuncio.html"; // Redireciona para a página de detalhes
}

// Carrega os anúncios ao abrir a página de listagem
if (window.location.pathname.includes('meus-anuncios.html')) {
    carregarAnuncios();
}



// 2.7 - Listagem de Anúncios
document.querySelectorAll('.btn-detalhes')?.forEach(button => {
    button.addEventListener('click', function() {
        window.location.href = "detalhes-anuncio.html"; // Redireciona para página de detalhes
    });
});

document.querySelectorAll('.btn-interesses')?.forEach(button => {
    button.addEventListener('click', function() {
        window.location.href = "interesses-anuncio.html"; // Redireciona para página de interesses
    });
});

// Esse função ainda não funciona 

document.querySelectorAll('.btn-excluir')?.forEach(button => {
    button.addEventListener('click', function() {
        if (confirm("Tem certeza que deseja excluir este anúncio?")) {
            alert("Anúncio excluído com sucesso!"); // Simula exclusão
            this.closest('.anuncio-card').remove(); // Remove o card da listagem
        }
    });
});

// 2.8 - Exibição Detalhada do Anúncio
function carregarDetalhesAnuncio() {
    // Simulação de carregamento dos dados do anúncio
    const anuncioDetalhes = {
        marca: "Toyota",
        modelo: "Corolla",
        ano: "2018",
        cor: "Preto",
        quilometragem: "50,000 km",
        estado: "MG",
        cidade: "Belo Horizonte",
        descricao: "Carro em excelente estado, revisões em dia, muito bem conservado.",
        valor: "50,000"
    };

    document.getElementById('detalhesMarca').innerText = anuncioDetalhes.marca;
    document.getElementById('detalhesModelo').innerText = anuncioDetalhes.modelo;
    document.getElementById('detalhesAno').innerText = anuncioDetalhes.ano;
    document.getElementById('detalhesCor').innerText = anuncioDetalhes.cor;
    document.getElementById('detalhesQuilometragem').innerText = anuncioDetalhes.quilometragem;
    document.getElementById('detalhesEstado').innerText = anuncioDetalhes.estado;
    document.getElementById('detalhesCidade').innerText = anuncioDetalhes.cidade;
    document.getElementById('detalhesDescricao').innerText = anuncioDetalhes.descricao;
    document.getElementById('detalhesValor').innerText = `R$ ${anuncioDetalhes.valor}`;
}

// 2.9 - Listagem de Interesses
function carregarInteresses() {
    // Simulação de carregamento das mensagens de interesse
    const interesses = [
        { nome: "João", telefone: "(34) 99999-9999", mensagem: "Gostei do veículo, quero negociar." },
        { nome: "Maria", telefone: "(31) 88888-8888", mensagem: "Estou interessada, posso pagar à vista." }
    ];

    const interessesContainer = document.getElementById('interessesContainer');
    interesses.forEach(interesse => {
        const interesseItem = document.createElement('div');
        interesseItem.classList.add('interesse-item');
        interesseItem.innerHTML = `
            <p><strong>Nome:</strong> ${interesse.nome}</p>
            <p><strong>Telefone:</strong> ${interesse.telefone}</p>
            <p><strong>Mensagem:</strong> ${interesse.mensagem}</p>
        `;
        interessesContainer.appendChild(interesseItem);
    });
}
