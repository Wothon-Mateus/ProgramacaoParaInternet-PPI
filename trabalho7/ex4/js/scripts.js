// Seleciona o formulário pelo ID
const form = document.getElementById('cadastroForm');

// Seleciona os campos de entrada
const nome = document.getElementById('nome');
const senha = document.getElementById('senha');
const email = document.getElementById('email');

// Seleciona os spans de erro
const erroNome = document.getElementById('erroNome');
const erroSenha = document.getElementById('erroSenha');
const erroEmail = document.getElementById('erroEmail');


form.addEventListener('submit', function (e) {
    let valid = true; // Flag para determinar se o formulário está válido

    // Valida o campo "nome"
    if (nome.value.trim() === '') {
        erroNome.textContent = 'O "usuario" deve ser preenchido.'; // Define a mensagem de erro
        erroNome.style.display = 'block'; // Mostra a mensagem de erro
        valid = false; // O formulário é inválido
    } else {
        erroNome.style.display = 'none'; // Esconde a mensagem de erro
    }

    // Valida o campo "senha"
    if (senha.value.trim() === '') {
        erroSenha.textContent = 'O "senha" deve ser preenchido.';
        erroSenha.style.display = 'block';
        valid = false;
    } else {
        erroSenha.style.display = 'none';
    }

    // Valida o campo "email"
    if (email.value.trim() === '') {
        erroEmail.textContent = 'O "e-mail" deve ser preenchido.';
        erroEmail.style.display = 'block';
        valid = false;
    } else {
        erroEmail.style.display = 'none';
    }

    // Se algum campo estiver inválido, impede o envio do formulário
    if (!valid) {
        e.preventDefault(); // Previne o envio do formulário
    }
});
