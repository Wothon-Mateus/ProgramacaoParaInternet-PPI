const headings = document.querySelectorAll('h2');

headings.forEach(heading => {
    heading.addEventListener('click', function () {
        const content = this.nextElementSibling;

        // Verifica se o conteúdo está oculto e alterna o display
        if (content.style.display === 'none') {
            content.style.display = 'block';
        } else {
            content.style.display = 'none';
        }
    });

    heading.addEventListener('dblclick', function () {
        const content = this.nextElementSibling;

        // No duplo clique, o conteúdo volta a ser exibido
        content.style.display = 'block';
    });
});