<?php
require_once "../GoCorreios/Frete.php";

$frete = new \GoCorreios\Frete;
$frete->setNCdEmpresa('1');
$frete->setSDsSenha('1');
$frete->setNCdServico(41106);
$frete->setSCepOrigem("95500-000");
$frete->setSCepDestino("95500-000");
$frete->setNVlPeso(1);
$frete->setNCdFormato(1);
$frete->setNVlComprimento(16);
$frete->setNVlAltura(12);
$frete->setNVlLargura(11);

echo "<pre>";
var_dump($frete);
echo "</pre>";