// Cadastro 

document.getElementById('formCadastro').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita o envio do formulário
    const nome = document.getElementById('nome').value;
    const cpf = document.getElementById('cpf').value;
    const email = document.getElementById('email').value;
    const senha = document.getElementById('senha').value;
    const telefone = document.getElementById('telefone').value;

    if (nome && cpf && email && senha && telefone) {
        document.getElementById('mensagem').innerHTML = "Cadastro realizado com sucesso!";
        document.getElementById('mensagem').style.color = "green";
        // Aqui você pode adicionar a lógica de armazenamento ou integração com o back-end
    } else {
        document.getElementById('mensagem').innerHTML = "Por favor, preencha todos os campos corretamente.";
        document.getElementById('mensagem').style.color = "red";
    }
});

// Logim 

document.getElementById('formLogin').addEventListener('submit', function(event) {
    event.preventDefault();
    const email = document.getElementById('emailLogin').value;
    const senha = document.getElementById('senhaLogin').value;

    // Validação básica de login
    if (email === "user@exemplo.com" && senha === "1234") {
        document.getElementById('mensagemLogin').innerHTML = "Login realizado com sucesso!";
        document.getElementById('mensagemLogin').style.color = "green";
        window.location.href = "painel-interno.html"; // Redirecionamento para o painel interno
    } else {
        document.getElementById('mensagemLogin').innerHTML = "Email ou senha incorretos.";
        document.getElementById('mensagemLogin').style.color = "red";
    }
});


// Criar Anuncio.

document.getElementById('formAnuncio').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita o envio do formulário padrão

    // Capturando os valores dos campos
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

    // Verificando se os campos estão preenchidos corretamente
    if (marca && modelo && ano && cor && quilometragem && descricao && valor && estado && cidade) {
        if (fotos.length >= 3) {
            document.getElementById('mensagemAnuncio').innerHTML = "Anúncio criado com sucesso!";
            document.getElementById('mensagemAnuncio').style.color = "green";
            // Aqui você pode adicionar a lógica de envio dos dados para o back-end
        } else {
            document.getElementById('mensagemAnuncio').innerHTML = "Por favor, envie pelo menos 3 fotos do veículo.";
            document.getElementById('mensagemAnuncio').style.color = "red";
        }
    } else {
        document.getElementById('mensagemAnuncio').innerHTML = "Preencha todos os campos obrigatórios.";
        document.getElementById('mensagemAnuncio').style.color = "red";
    }
});





