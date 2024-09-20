
window.onload = function () {
    const modal = document.querySelector(".modal");
    const buttonClose = modal.querySelector(".buttonclose");

    buttonClose.addEventListener("click", function () {
        modal.style.display = 'nome';
    });

    const buttoOpenModal = document.getElementById("buttoOpenModal");
    buttoOpenModal.addEventListener("click" , function (){
        modal.style.display = 'block';
    })

}