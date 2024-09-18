const img = document.querySelectorAll('main img');


img.forEach(img => {
    img.addEventListener('mouseenter', function () {
        this.classList.add('destaque'); // Adiciona a classe 'shadow'
    });

    // Adiciona o evento 'mouseleave' para remover a classe de sombra
    img.addEventListener('mouseleave', function () {
        this.classList.remove('destaque'); // Remove a classe 'shadow'
    })
});