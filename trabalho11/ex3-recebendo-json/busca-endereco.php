<?php

class Endereco
{
  public $rua;
  public $bairro;
  public $cidade;

  function __construct($rua, $bairro, $cidade)
  {
    $this->rua = $rua;
    $this->bairro = $bairro;
    $this->cidade = $cidade;
  }
}

$cep = $_GET['cep'] ?? '';

if ($cep == '38400-100')
  $endereco = new Endereco('Av Floriano', 'Centro', 'Uberlândia');
else if ($cep == '38400-200')
  $endereco = new Endereco('Rua Tiradentes', 'Fundinho', 'Uberlândia');
else {
  $endereco = new Endereco('', '', '');
}

header('Content-type: application/json');
echo json_encode($endereco);

// Classe Endereco: Define uma estrutura para armazenar dados de endereço, incluindo rua, bairro e cidade.
// Possui um construtor que inicializa esses valores.
// Obtendo o CEP: Recebe o CEP a partir de uma requisição HTTP usando $_GET['cep'].
// Se o valor do CEP for '38400-100', cria um objeto Endereco com informações específicas para esse CEP.
// Se o valor do CEP for '38400-200', cria um objeto Endereco com outro conjunto de informações.
// Para qualquer outro CEP, cria um objeto Endereco vazio.
