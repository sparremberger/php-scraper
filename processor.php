<?php

class Processor
{

    private $rawData; // Dados crús que o objeto irá receber para iniciar o processamento
    private $exp; // Expressões a serem utilizadas

    function __construct($rawData, $exp) // Recebe os dados crús e a classe associada ao site ao qual será feito o scraping
    {
        $this->rawData = $rawData;
        $this->exp = $exp;
    }

    function run() // Executa o script de scraping recebido - nesse caso, o do site do magalú
    {
        $this->exp->run($this->rawData);
    }
}
