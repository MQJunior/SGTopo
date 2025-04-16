<?php
                                                          // Configurações
$baseDir    = '/sistema/www/SGTopo/arquivosTopo/Cidades'; // Diretório base para varredura
$jsonFile   = '/sistema/www/SGTopo/files/sync.json';      // Caminho para salvar o sync.json
$horaLimite = time() - 3600;                              // Última 1 hora

// Função para gerar hash MD5
function gerarHash($arquivo)
{
    return md5_file($arquivo);
}

// Carrega o JSON existente (se existir)
$syncData = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : ["arquivos" => []];

// Varredura de arquivos modificados ou novos
$arquivos = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($baseDir));

foreach ($arquivos as $arquivo) {
    if ($arquivo->isFile()) {
        $dataModificacao = filemtime($arquivo->getPathname());
        if ($dataModificacao >= $horaLimite) {
            $hash = gerarHash($arquivo->getPathname());

            // **Ajusta barras para compatibilidade com Linux**
            $caminhoRelativo = str_replace($baseDir, '', $arquivo->getPathname());
            $caminhoRelativo = str_replace('\\', '/', $caminhoRelativo); // **Troca \ por /**
            $caminhoRelativo = urlencode($caminhoRelativo);              // **Codifica espaços e caracteres especiais**

            // Adiciona ou atualiza o arquivo no JSON
            $syncData["arquivos"][$hash] = [
                "caminho"          => $caminhoRelativo,
                "status"           => "pendente",
                "data_modificacao" => date('Y-m-d H:i:s', $dataModificacao),
            ];
        }
    }
}

// Salva o JSON atualizado
file_put_contents($jsonFile, json_encode($syncData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "sync.json atualizado com sucesso!\n";
