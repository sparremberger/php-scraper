<?php
require_once './downloader.php';
require_once './processor.php';
require_once './regex/magalu/magaluExp.php';

$exp = new MagaluExp(); // Instancia a classe MagaluExp. É onde ficam as expressões e funções específicas do site do magalú.

$downloader = new Downloader($exp->url, $exp->headers); // Instancia a classe downloader, responsável pela aquisição da página.
$downloader->run(); // Executa a função principal, que baixa a página. 
$data = $downloader->rawData(); // Lê os dados baixados e armazena em $data

$processor = new Processor($data, $exp); // Instancia o processor, que vai realizar o trabalho de processar os dados, enviando os dados e a classe responsável pelo site
$processor->run(); // Executa a função principal.
