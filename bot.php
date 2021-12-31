<?php

require_once 'simpletest/browser.php';

function regex($re, $str)
{
    preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);
    return $matches;
}


$browser = new SimpleBrowser();
$browser->addHeader("Accept: application/json, text/javascript, */*; q=0.01");
$browser->addHeader("Referer: https://www.magazineluiza.com.br/");
$browser->addHeader("User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:95.0) Gecko/20100101 Firefox/95.0");


//$resposta = $browser->get("https://www.magazineluiza.com.br/busca/computadores/");


// Salva a resposta em um arquivo txt
/*file_put_contents(
    'resposta.txt',
    $resposta,
);*/


// Lê a resposta e armazena numa variável
$resposta = file_get_contents('./resposta.txt', FILE_USE_INCLUDE_PATH);
// usando o preg_match_all não precisa setar a flag g
$products = regex('/<li class="[\w\W]{1,30}"><a href([\w\W]{1,3000}<\/div><\/a><\/li>)/m', $resposta);


$productsClean = array();
foreach ($products as $product) {
    $productsClean[] = $product[0];
}



foreach ($productsClean as $product) {
    $title = regex('/(?<=title=")([\w\W]{1,300}(?=" o))/m', $product);
    $price = preg_replace('/[^A-Za-z0-9\-,\.]/', '', regex('/(?<=\d">R\$[\w\W])\d{0,10}.\d{0,10}.?\d{0,10}[\.,]?\d{0,10}/m', $product)[0]);
    $url = regex('/(?<=a href=")\/[\w\W]{1,500}\//m', $product);
    $img = regex('/http[\w\W]{1,300}.jpg/m', $product);
    echo '<pre>';
    echo 'Produto: ' . $title[0][0] . '<br />' . 'Preço: ' . $price[0] . '<br />' . 'Url: ' . $url[0][0] . '<br />' . 'Imagem: ' . $img[0][0];
    echo '</pre>';
}


// título
// /(?<=title=")([\w\W]{1,300}(?=" o))/m

// preço
// /(?<=\d">R\$[\w\W])\d{0,10}.\d{0,10}.?\d{0,10}[\.,]?\d{0,10}/m
// ou R\$ [\w\W]{1,15}(?=<\/)
// ou (?<=\d">R\$[\w\W])\d{0,10},\d{0,10}

// url produto
// /(?<=a href=")\/[\w\W]{1,500}\//m

// url imagem
// /http[\w\W]{1,300}.jpg/m
