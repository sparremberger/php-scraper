<?php
// Classe abstrata que será o template para todas as outras.
// A cada site que se desejar fazer o scraping, será necessário criar um novo script personalizado que extenda essa classe.

abstract class Expression
{
    private $exp; // um array associativo de expressões regulares a serem usadas

    abstract public function run($rawData); // função que irá realizar o serviço da classe

    abstract protected function output($output); // Define o que será feito com cada saída de dados, e.g. colocar num json, exibir na tela, etc.

    protected function applyRegex($re, $str) // aplica o regex
    {
        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);
        return $matches;
    }
}
