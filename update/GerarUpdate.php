<?php

function obterInformacoesArquivos($caminhoDoDiretorio, $listaDeIgnorados = [])
{
    $arquivos = [];

    // Percorrer o diretório
    $diretorio = new RecursiveDirectoryIterator($caminhoDoDiretorio);
    $iterator = new RecursiveIteratorIterator($diretorio);

    foreach ($iterator as $arquivo) {
        $caminhoCompleto = $arquivo->getPathname();
        $relativoAoDiretorio = str_replace($caminhoDoDiretorio, '', $caminhoCompleto);

        // Verificar se o arquivo ou diretório deve ser ignorado
        $ignorarItem = false;
        foreach ($listaDeIgnorados as $item) {
            if (strpos($relativoAoDiretorio, $item) !== false) {
                $ignorarItem = true;
                break;
            }
        }

        if (!$ignorarItem) {
            // Se não for para ignorar, verificar se é um arquivo e processar
            if ($arquivo->isFile()) {
                $hash = hash_file('sha256', $caminhoCompleto);
                $tamanho = filesize($caminhoCompleto);
                $dataModificacao = date('Y-m-d H:i:s', $arquivo->getMTime());

                $arquivos[$relativoAoDiretorio] = [
                    'hash' => $hash,
                    'tamanho' => $tamanho,
                    'dataModificacao' => $dataModificacao
                ];
            }
        }
    }

    return $arquivos;
}

$caminhoDoDiretorio = dirname(__DIR__);
$listaDeIgnorados = ['.conf.php', '.log', '.tmp', '.git', '.vscode', 'doc'];
$arquivoUpdateJson = $caminhoDoDiretorio . '/update/update.json';
$informacoesArquivos = obterInformacoesArquivos($caminhoDoDiretorio, $listaDeIgnorados);
$json = json_encode($informacoesArquivos, JSON_PRETTY_PRINT);
file_put_contents($arquivoUpdateJson, $json);

//die($caminhoDoDiretorio);
