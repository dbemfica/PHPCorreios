<?php
require_once "../GoCorreios/Frete.php";

$frete = new \GoCorreios\Frete;
$frete->setNCdServico(41106);
$frete->setSCepOrigem("90570-020");
$frete->setSCepDestino("95500-000");
$frete->setNVlPeso(1);
$frete->setNCdFormato(1);
$frete->setNVlComprimento(16);
$frete->setNVlAltura(12);
$frete->setNVlLargura(11);
$frete->calculaDiametro();
$frete->calculaFrete();

echo "O prazo de entrega é de {$frete->getPrazoEntrega()} dia(s) e o valor é R$ ".number_format($frete->getValor(),2,",",".");