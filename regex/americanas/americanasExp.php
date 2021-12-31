<?php

require_once './regex/Exp.php';

class AmericanasExp extends Expression
{
    private $exp = array();
    public $url;
    public $headers;

    function __construct()
    {

        $this->url = 'https://www.americanas.com.br/busca/smartphone?limit=24&offset=0';
        $this->headers = '';
    }

    public function run($rawData)
    {
        die();
    }

    protected function output($output)
    {
    }
}
