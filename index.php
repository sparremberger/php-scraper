<?php
require_once './downloader.php';
require_once './processor.php';
require_once './regex/magalu/magaluExp.php';

$exp = new MagaluExp(); // Instancia a classe MagaluExp. É onde ficam as expressões e funções específicas do site do magalú.

$downloader = new Downloader(); // Instancia a classe downloader, responsável pela aquisição da página.
$downloader->run(); // Executa a função principal, que baixa a página pro disco. A partir daí iremos trabalhar localmente.
$data = $downloader->rawData(); // Lê os dados baixados do disco e armazena na variável $data;

$processor = new Processor($data, $exp); // Instancia o processor, que vai realizar o trabalho de processar os dados
$processor->run(); // Executa a função principal.
