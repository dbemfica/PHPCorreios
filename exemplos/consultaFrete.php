<?php
require_once "../GoCorreios/Frete.php";

$frete = new \GoCorreios\Frete;
$frete->setNCdEmpresa('1');
$frete->setSDsSenha('1');
$frete->setNCdServico(41106);

echo "<pre>";
var_dump($frete);
echo "</pre>";