window.onload = function () {
    for (let form of document.forms)
        form.onsubmit = validateForm;
}

async function validateForm(e) {
    e.preventDefault(); // Impede a submissão do formulário de forma normal
    let form = e.target;
    let formIsValid = true;
    const spanNome = form.nome.nextElementSibling;
    const spanEmail = form.email.nextElementSibling;
    const spanPassword = form.password.nextElementSibling;
    const spanCpf = form.cpf.nextElementSibling;
    const spanTel = form.tel.nextElementSibling;

    spanEmail.textContent = "";
    spanPassword.textContent = "";

    if (form.nome.value === "") {
        spanNome.textContent = "Informe um nome válido.";
        spanNome.style.display = "block";
        formIsValid = false;
    }
    if (form.email.value === "") {
        spanEmail.textContent = "Informe um e-mail válido.";
        spanEmail.style.display = "block";
        formIsValid = false;
    }
    if (form.password.value === "") {
        spanPassword.textContent = "Campo obrigatório. Informe sua senha.";
        spanPassword.style.display = "block";
        formIsValid = false
    } if (form.cpf.value === "") {
        spanCpf.textContent = "Campo obrigatório. Informe seu cpf.";
        spanCpf.style.display = "block";
        formIsValid = false
    } if (form.tel.value === "") {
        spanTel.textContent = "Campo obrigatório. Informe seu telefone.";
        spanTel.style.display = "block";
        formIsValid = false
    }
    if (!formIsValid) {
        return;
    } else {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../php/createUser.php');
        xhr.onload = function () {
            if (xhr.status === 200) {
                alert('Usuário cadastrado com sucesso!');
                window.location = "../php/home.php";
            } else {
                alert(xhr.responseText);
                spanEmail.textContent = 'Usuário inválido. Verifique seus dados.';
                spanEmail.style.display = "block";
                form.email.value = '';
                form.email.focus();
            }
        };
        xhr.onerror = function () {
            console.error('Erro na requisição');
        };
        const formData = new FormData(form);
        xhr.send(formData);
    }


}
