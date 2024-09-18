const campoInteresse = document.querySelector("input");
campoInteresse.addEventListener("keyup", e => {
    if (e.key === "Enter") {
        const novoLi = document.createElement("li");
        const novoSpan = document.createElement("span");
        const novoBotao = document.createElement("button");

        novoSpan.textContent = campoInteresse.value;
        novoBotao.textContent = 'X';

        novoLi.appendChild(novoSpan);
        novoLi.appendChild(novoBotao);
        const listaInteresses = document.querySelector("ol");
        listaInteresses.appendChild(novoLi);

        novoBotao.onclick = function () {
            listaInteresses.removeChild(novoLi);
        };

        campoInteresse.value = '';
    }
});
