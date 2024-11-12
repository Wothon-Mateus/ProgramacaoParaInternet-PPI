var offset = 0;
var filter = 'title';
var form = document.querySelector("#pesquisaForm").value;
var max = 100000;
var min = 0;
var categorie = 'tudo';

window.onload = function () {
  iniciaPesquisa('', offset); // Inicia a pesquisa ao carregar a página
  const prodsSection = document.getElementById("anuncios"); // Seção onde os produtos serão exibidos
  const btnPesquisa = document.querySelector("#pesquisaBtn"); // Botão de pesquisa
  const campo = document.querySelector("#pesquisaForm"); // Campo de entrada do formulário de pesquisa

  btnPesquisa.addEventListener('click', function () {
    if (campo.value.length < 3) {
      return;
    }
    prodsSection.innerHTML = '';
    max = parseFloat(document.querySelector("#max-value").value) || 100000;
    min = parseFloat(document.querySelector("#min-value").value) || 0;
    categorie = document.querySelector("#categories").value || 'tudo';
    form = campo.value;
    offset = 0;
    filter = document.querySelector('input[name="filter"]:checked').value || 'title';
    iniciaPesquisa(form, offset);
  });

  campo.addEventListener("keyup", e => {
    if (e.key === "Enter") {
      if (campo.value.length < 3) {
        return;
      }
      prodsSection.innerHTML = '';
      max = parseFloat(document.querySelector("#max-value").value) || 100000;
      min = parseFloat(document.querySelector("#min-value").value) || 0;
      categorie = document.querySelector("#categories").value || 'tudo';
      form = campo.value;
      offset = 0;
      filter = document.querySelector('input[name="filter"]:checked').value || 'title';
      iniciaPesquisa(form, offset);
    }
  });
}

window.onscroll = function () {
  if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
    iniciaPesquisa(form, offset); // Carrega mais produtos ao rolar a página
  }
};

function renderProducts(newProducts) {
  const prodsSection = document.getElementById("anuncios");
  const template = document.getElementById("template"); // Template de exibição do produto

  for (let product of newProducts) {
    let html = template.innerHTML
        .replace("{{prod-id}}", product.id)
        .replace("{{prod-image}}", product.imagem)
        .replace("{{prod-name}}", product.titulo)
        .replace("{{prod-description}}", product.descricao)
        .replace("{{prod-price}}", product.preco);

    prodsSection.insertAdjacentHTML("beforeend", html);
  }
}

function iniciaPesquisa(formlocal, offsetlocal) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./php/busca.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (xhr.status != 200) {
      console.error("Falha inesperada: " + xhr.responseText);
      return;
    }

    try {
      var anuncios = JSON.parse(xhr.responseText);
    } catch (e) {
      console.error("String JSON inválida: " + xhr.responseText);
      return;
    }
    renderProducts(anuncios);
  }

  xhr.onerror = function () {
    console.error("Erro de rede - requisição não finalizada");
  };

  var data = "form=" + encodeURIComponent(formlocal) +
    "&filter=" + encodeURIComponent(filter) +
    "&offset=" + encodeURIComponent(offsetlocal) +
    "&max=" + encodeURIComponent(max) +
    "&min=" + encodeURIComponent(min) +
    "&categorie=" + encodeURIComponent(categorie);

  xhr.send(data);
  offset += 6; // Incrementa o offset para carregamento paginado
}
