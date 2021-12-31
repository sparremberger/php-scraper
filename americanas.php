<?php
require_once './downloader.php';
require_once './processor.php';
require_once './regex/americanas/americanasExp.php';

$exp = new AmericanasExp();

$downloader = new Downloader($exp->url, $exp->headers);
$downloader->run();
$data = $downloader->rawData();

$processor = new Processor($data, $exp);
$processor->run();
