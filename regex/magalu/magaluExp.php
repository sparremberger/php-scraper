<?php
require_once './regex/Exp.php';

class MagaluExp extends Expression
{
    private $exp = array(); // Array contendo as expressões

    function __construct()
    {
        $this->exp['ProductsEXP'] = '/<li class="[\w\W]{1,30}"><a href([\w\W]{1,3000}<\/div><\/a><\/li>)/m';
        $this->exp['TitleEXP'] = '/(?<=title=")([\w\W]{1,300}(?=" o))/m';
        $this->exp['PriceEXP'] = '/(?<=\d">R\$[\w\W])\d{0,10}.\d{0,10}.?\d{0,10}[\.,]?\d{0,10}/m';
        $this->exp['PriceReplaceEXP'] = '/[^A-Za-z0-9\-,\.]/';
        $this->exp['ProductUrlEXP'] = '/(?<=a href=")\/[\w\W]{1,500}\//m';
        $this->exp['ImgUrlEXP'] = '/http[\w\W]{1,300}.jpg/m';
    }

    public function run($rawData) // recebe os dados crús e inicia o processamento
    {
        $products = $this->applyRegex($this->exp['ProductsEXP'], $rawData);
        $products = $this->cleanProducts($products);

        foreach ($products as $product) {
            $title = $this->applyRegex($this->exp['TitleEXP'], $product);
            $price = preg_replace($this->exp['PriceReplaceEXP'], '', $this->applyRegex($this->exp['PriceEXP'], $product)[0]);
            $url = $this->applyRegex($this->exp['ProductUrlEXP'], $product);
            $img = $this->applyRegex($this->exp['ImgUrlEXP'], $product);

            $produto = new stdClass();
            $produto->nomeProduto = $title[0][0];
            $produto->preco = $price[0];
            $produto->linkImagem = $img[0][0];
            $produto->linkProduto = "https://www.magazineluiza.com.br" . $url[0][0];

            $produtoJSON = json_encode($produto, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            $this->output($produtoJSON);
        }
    }

    private function cleanProducts($products) // Só uma limpezinha no array de produtos, que vem duplicado do site (devido à estrutura da página deles)
    {
        $cleanProducts = array();
        foreach ($products as $product) {
            $cleanProducts[] = $product[0];
        }
        return $cleanProducts;
    }

    protected function output($output) // Nesse caso iremos apenas exibir os dados processados na tela.
    {
        echo '<pre>';
        echo $output;
        echo '</pre>';
    }
}
