<?php
// SÓ REFERÊNCIA
// ESSE ARQUIVO NÃO FAZ PARTE DO PROGRAMA
require_once "simpletest/browser.php";

$browser = new SimpleBrowser();
$browser->setMaximumRedirects(0);
$postData = array();

$browser->addHeader("Accept: application/json, text/javascript, */*; q=0.01");
$browser->addHeader("User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:95.0) Gecko/20100101 Firefox/95.0");
$browser->addHeader("Referer: https://veiculos.fipe.org.br/");

$postData["codigoTabelaReferencia"] = 280;
$postData["codigoTipoVeiculo"] = 1;
$resposta = $browser->post("https://veiculos.fipe.org.br/api/veiculos//ConsultarMarcas", http_build_query($postData), 'application/x-www-form-urlencoded');

$retornoMarcas = json_decode($resposta);


$postData["codigoModelo"] = "";
$postData["codigoMarca"] = "1";
$postData["ano"] = "";
$postData["codigoTipoCombustivel"] = "";
$postData["anoModelo"] = "";
$postData["modeloCodigoExterno"] = "";

$resposta = $browser->post("https://veiculos.fipe.org.br/api/veiculos//ConsultarModelos", http_build_query($postData), 'application/x-www-form-urlencoded');
$respostaModelos = json_decode($resposta);
echo '<pre>';
//var_dump($retornoMarcas[0]->Value);
var_dump($respostaModelos);
//var_dump(htmlentities($respostaModelos));
echo '</pre>';
//die($resposta);
