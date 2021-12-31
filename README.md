Esse é um webscraper escrito em PHP. O propósito inicial é realizar a coleta de dados de lojas online (Magazine Luiza, Americanas, etc), no entanto, é possível criar scripts customizados que irão trabalhar com qualquer tipo de website.

Essa é a primeira versão, e foi escrita usando PHP 8.0.13.

Como usar:
Edite o arquivo .env para inserir sua página desejada em URL_TO_SCRAPE
Em HEADERS, acrescente todos os headers que desejar, separando-os com |
Se desejar gravar o resultado em um arquivo de saída, insira TRUE em USE_OUTPUT_FILE e insira um nome de arquivo em OUTPUT_FILE
Por fim, acesse o index.php em seu servidor apache.
