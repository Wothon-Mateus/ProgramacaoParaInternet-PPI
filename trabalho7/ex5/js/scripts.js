
window.onload = function () {
    const modal = document.querySelector(".modal");
    const buttonClose = modal.querySelector(".buttonClose");

    // Fechar o modal ao clicar no botão de fechar
    buttonClose.addEventListener("click", function () {
        modal.style.display = 'none';
    });

    const buttonOpenModal = document.getElementById("buttonOpenModal");
    // Abrir o modal ao clicar no botão de abrir
    buttonOpenModal.addEventListener("click", function () {
        modal.style.display = 'block';
    });
}