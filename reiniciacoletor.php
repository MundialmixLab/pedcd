<?php

session_start();
require "verifica.php";

$usuario = $_SESSION['pedcdusuario'];

// Caminho para o executável Python e para o seu script Python
$python = 'python3'; // Substitua pelo caminho correto para o executável Python
$scriptPython = '/var/www/html/pedcd/client.py'; // Substitua pelo caminho para o seu script Python

// Comando para executar o script Python
$comando = "$python $scriptPython";

// Executa o comando e captura a saída
$saida = exec($comando, $output, $retorno);

if ($retorno === 0) {
    // Comando foi executado com sucesso
    $dataHoraAtual = date('Y-m-d H:i:s');
    $saidaTexto = $usuario . " => " . $dataHoraAtual . " => ";
    foreach ($output as $linha) {
        $saidaTexto .= " $linha\n";
    }

    $arquivoSaida = 'logColetor.txt';

    if (!file_exists($arquivoSaida)) {
        file_put_contents($arquivoSaida, $saidaTexto);
        $mensagemAlerta = "OK";
        echo $mensagemAlerta;
    } else {
        $handle = fopen($arquivoSaida, 'a');
        if ($handle === false) {
            echo "Não foi possível abrir o arquivo de log para escrita.";
        } else {
            fwrite($handle, $saidaTexto);
            fclose($handle);
            $mensagemAlerta = "OK";
            echo $mensagemAlerta;
        }
    }
} else {
    // Erro ao executar o comando
    echo "Erro ao executar o script Python. Código de retorno: $retorno";
}
