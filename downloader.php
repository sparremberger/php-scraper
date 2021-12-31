<?php

// Importa o SimpleBrowser
require_once 'simpletest/browser.php';
require_once './dotenv/dotenv.php';
$absolutePathToEnvFile = __DIR__ . '/.env';
(new DotEnv($absolutePathToEnvFile))->load();

class Downloader
{
    // Dois campos privados. O browser, e os dados crús obtidos via http GET.
    private $browser;
    private $data;


    function __construct()
    {
        $this->browser = new SimpleBrowser();
        $this->setHeaders();
    }

    function setHeaders()
    {
        $headers = explode('|', getenv('HEADERS')); // separa os headers do arquivo .env e põe num array
        foreach ($headers as $header) {
            $this->browser->addHeader($header);
        }
    }

    // Executa o GET na página indicada e salva os dados em um arquivo
    function run()
    {
        $this->data = $this->browser->get(getenv('URL_TO_SCRAPE'));

        if ((int) filter_var(getenv('USE_OUTPUT_FILE'), FILTER_VALIDATE_BOOLEAN)) { // essa linha verifica se o conteúdo da string é equivalente a um boolean (true ou false)
            file_put_contents(
                getenv('OUTPUT_FILE'),
                $this->data
            );
        }
    }

    // Lê o arquivo salvo e retorna os dados, podendo retornar os dados armazenados na classe caso o usuário tenha optado por não usar um arquivo no disco
    function rawData()
    {
        $file = @file_get_contents(getenv('OUTPUT_FILE'), FILE_USE_INCLUDE_PATH);
        if (!$file) {
            return $this->data;
        }
        return $file;
    }
}
