const botao = document.querySelector("button");
botao.onclick = function (){
    const inputNome = document.querySelector ("input");
    const elemetP = document.querySelector ("p");
    elemetP.textContent = 'Valeu!!! ' + inputNome.value; 

};