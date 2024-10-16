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

// carrega a string JSON da requisição
// file_get_contents('php://input') retorna todos os dados que vem depois
// das linhas de cabeçalho da requisição HTTP (request body), 
// independentemente do tipo do conteúdo.
$stringJSON = file_get_contents('php://input');

// converte a string JSON em um objeto PHP correspondente
$dados = json_decode($stringJSON);

// verifica as credenciais para acesso à funcionalidade
if ($dados->email !== 'fulano@mail.com' || $dados->apikey !== '123456')
{
  http_response_code(403);
  echo "Acesso não autorizado";
  exit();
}

if ($dados->cep == '38400-100')
  $endereco = new Endereco('Av Floriano', 'Centro', 'Uberlândia');
else if ($dados->cepp == '38400-200')
  $endereco = new Endereco('Rua Tiradentes', 'Fundinho', 'Uberlândia');
else
  $endereco = new Endereco('', '', '');
  
header('Content-type: application/json');
echo json_encode($endereco);