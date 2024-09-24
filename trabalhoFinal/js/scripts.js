// Funções comuns para todas as páginas (como navegação e logoff)
document.querySelectorAll('nav ul li a').forEach(link => {
    link.addEventListener('click', function(event) {
        // Prevenir comportamento padrão e redirecionar de forma suave
        event.preventDefault();
        window.location.href = link.getAttribute('href');
    });
});

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

// @@@@@@@@@@@@@@@@@@@@@@@@@

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

// 2.6 - Criação de Anúncio de Veículo
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
        alert("Anúncio criado com sucesso!");
        // Simulação de criação de anúncio
    } else {
        alert("Preencha todos os campos e envie ao menos 3 fotos.");
    }
});

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
