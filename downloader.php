<?php

// Importa o SimpleBrowser
require_once 'simpletest/browser.php';

class Downloader
{
    // Dois campos privados. O browser, e os dados crús obtidos via http GET.
    private $browser;
    private $data;

    // Construtor da classe, inicializa o SimpleBrowser e seta os headers
    function __construct()
    {
        $this->browser = new SimpleBrowser();
        $this->setHeaders();
    }

    // Método para setar os headers
    function setHeaders()
    {
        $this->browser->addHeader("Accept: application/json, text/javascript, */*; q=0.01");
        $this->browser->addHeader("Referer: https://www.magazineluiza.com.br/");
        $this->browser->addHeader("User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:95.0) Gecko/20100101 Firefox/95.0");
    }

    // Executa o GET na página indicada e salva os dados em um arquivo
    function run()
    {
        $this->data = $this->browser->get("https://www.magazineluiza.com.br/busca/computadores/");
        file_put_contents(
            'resposta.txt',
            $this->data
        );
    }

    // Lê o arquivo salvo e retorna os dados
    function rawData()
    {
        return file_get_contents('./resposta.txt', FILE_USE_INCLUDE_PATH);
    }
}
