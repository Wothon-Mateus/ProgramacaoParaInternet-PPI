function calcularPesoIdeal() {
    
    let altura = parseInt(document.getElementById('altura').value);
    let sexo = document.getElementById('sexo').value;

    let pesoIdeal;

    // Calculando peço
    if (sexo === 'masculino') {
        pesoIdeal = 52 + (0.75 * (altura - 152.4));
    } else if (sexo === 'feminino') {
        pesoIdeal = 52 + (0.67 * (altura - 152.4));
    }

    // Exibe o resultado do calculo
    document.getElementById('resultado').innerText = `Seu peso ideal é: ${pesoIdeal.toFixed(2)} kg`;
}