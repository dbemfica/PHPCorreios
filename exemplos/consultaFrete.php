<?php
require "../vendor/autoload.php";

$enderecoOrigem = new PHPCorreios\Endereco;
$enderecoOrigem->setCep("90570-020");

$enderecoDestino = new PHPCorreios\Endereco;
$enderecoDestino->setCep("90570-020");

$pacote = new PHPCorreios\Pacote();
$pacote->setPeso(11);

$frete = new PHPCorreios\Frete;
$frete->addEnderecoOrigem($enderecoOrigem);
$frete->addEnderecoDestino($enderecoDestino);
$frete->addPacote($pacote);

$frete->getURL();

echo "<pre>";
print_r($frete);
echo "</pre>";