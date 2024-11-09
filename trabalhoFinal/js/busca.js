var offset = 0;
var filter = 'title';
var form = document.querySelector("#pesquisaForm").value;
var max = 100000;
var min = 0;
var categorie = 'tudo';

window.onload = function () {
  iniciaPesquisa('', offset);
  const prodsSection = document.getElementById("results");
  const btnPesquisa = document.querySelector("#pesquisaBtn");
  const campo = document.querySelector("#pesquisaForm");
  max = 100000;
  min = 0;
  categorie = 'tudo';
  btnPesquisa.addEventListener('click', function () {
    if (campo.value.length < 3) {
      return;
    }
    prodsSection.innerHTML = '';
    max = parseFloat(document.querySelector("#max-value").value);
    min = parseFloat(document.querySelector("#min-value").value);
    categorie = document.querySelector("#categories").value;
    form = document.querySelector("#pesquisaForm").value;
    offset = 0;
    filter = document.querySelector('input[name="filter"]:checked').value;
    iniciaPesquisa(form, offset);
  });
  campo.addEventListener("keyup", e => {
    if (e.key === "Enter") {
      if (campo.value.length < 3) {
        return;
      }
      prodsSection.innerHTML = '';
      max = parseFloat(document.querySelector("#max-value").value);
      min = parseFloat(document.querySelector("#min-value").value);
      categorie = document.querySelector("#categories").value;
      form = document.querySelector("#pesquisaForm").value;
      offset = 0;
      filter = document.querySelector('input[name="filter"]:checked').value;
      iniciaPesquisa(form, offset);
    }
  });
}

window.onscroll = function () {
  if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
    iniciaPesquisa(form, offset);
  }
};

function renderProducts(newProducts) {

  const prodsSection = document.getElementById("results");
  const template = document.getElementById("template");

  for (let product of newProducts) {
    let html = template.innerHTML
        .replace("{{prod-id}}", product.id)
        .replace("{{prod-image}}", product.imagem)
        .replace("{{prod-name}}", product.titulo)
        .replace("{{prod-description}}", product.descricao)
        .replace("{{prod-price}}", product.preco);

    prodsSection.insertAdjacentHTML("beforeend", html);
};
}

function iniciaPesquisa(formlocal, offsetlocal) {

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./php/busca.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {

    // verifica o código de status retornado pelo servidor
    if (xhr.status != 200) {
      console.error("Falha inesperada: " + xhr.responseText);
      return;
    }

    try {
      // converte a string JSON para objeto JavaScript
      var anuncios = JSON.parse(xhr.responseText);
    }
    catch (e) {
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

  offset += 6;

}

