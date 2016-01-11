<?php
require "../vendor/autoload.php";

$enderecoOrigem = new PHPCorreios\Endereco;
$enderecoOrigem->setCep("90570-020");

$enderecoDestino = new PHPCorreios\Endereco;
$enderecoDestino->setCep("90570-020");

$pacote = new PHPCorreios\Pacote();
$pacote->setCodigoFormato(1);
$pacote->setPeso(11);
$pacote->setAltura(2);
$pacote->setComprimento(16);
$pacote->setLargura(11);
$pacote->setDiametro();
$pacote->setMaoPropria('S');
$pacote->setValorDeclarado(0);
$pacote->setAvisoRecebimento('S');

$frete = new PHPCorreios\Frete;
$frete->setCodigoServico(41106);
$frete->addEnderecoOrigem($enderecoOrigem);
$frete->addEnderecoDestino($enderecoDestino);
$frete->addPacote($pacote);

$frete->calculaFrete();

echo "<pre>";
print_r($frete);
echo "</pre>";