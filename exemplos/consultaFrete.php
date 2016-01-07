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

echo "O prazo de entrega é de {$frete->getPrazoEntrega()} dia(s)<br>";
echo "Valor é R$ ".number_format($frete->getValor(),2,",",".")."<br>";
echo "Valor Mão Propia é R$ ".number_format($frete->getValorMaoPropia(),2,",",".")."<br>";
echo "Valor Aviso Recebimento é R$ ".number_format($frete->getValorAvisoRecebimento(),2,",",".")."<br>";
echo "Valor Declarado é R$ ".number_format($frete->getValorDeclarado(),2,",",".")."<br>";
echo "Entrega Domiciliar '{$frete->getEntregaDomiciliar()}'<br>";
echo "Entrega aos Sábados '{$frete->getEntregaSabado()}'<br>";