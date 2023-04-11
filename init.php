<?php

#1 passo: Ler o arquivo excel que tem os nomes das gravações
#2 passo: Ler os arquivos da pasta e ver qual tem o primeiro nome = ao do excel
#3 passo: Alterar nomes

$handle = fopen("teste.csv", "r");
$row = 0;
while ($line = fgetcsv($handle, 1000, ',')) {
    if ($row++ == 0) {
        continue;
    }

    $info[] = [
        "nome" => explode('.', (explode(';', $line[0])[0]))[0],
    ];
}

// print_r($info);

fclose($handle);

$pasta = dir(__DIR__);

while (($arquivos = $pasta->read()) !== false) {
    $numero = count(explode('-', $arquivos));
    // echo $numero."<br>";
    if ($numero == 1 && explode('.', $arquivos)[1] == 'mp3') {
        // echo $arquivos.' ';
        foreach ($info as $nome) {
            echo $nome['nome'] . PHP_EOL;
            if (explode('-', $nome['nome'])[0] . '.mp3' == $arquivos) {
                rename($arquivos,$nome['nome'])[0];
            }
        }
    }
}
