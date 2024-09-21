window.onload = function () {
    buttons = document.querySelectorAll("nav button");
    for (let button of buttons) {
        button.addEventListener("click", changeTab);
    }
    openTab(0);
}

function changeTab(e) {
    const botaoAcionado = e.target;
    const liDoBotao = botaoAcionado.parentNode;
    const nodes = Array.from(liDoBotao.parentNode.children);
    const index = nodes.indexOf(liDoBotao);
    openTab(index);
}

function openTab(i) {
    const tabActive = document.querySelector(".tabActive");
    if (tabActive !== null)
        tabActive.className = "";

    const buttonActive = document.querySelector(".buttonActive");
    if (buttonActive !== null)
        buttonActive.className = "";

    document.querySelectorAll(".tabs section")[i].className = "tabActive";
    document.querySelectorAll("nav button")[i].className = "buttonActive";
}
