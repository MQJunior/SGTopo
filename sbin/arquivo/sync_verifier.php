<?php
// Configurações
$uploadDir   = '/sistema/www/SGTopo/arquivosTopo/Cidades';
$jsonFile    = '/sistema/www/SGTopo/files/sync.json';
$pendingFile = '/sistema/www/SGTopo/files/pending_sync.json';
$logFile     = '/sistema/www/SGTopo/files/sync_verifier_log.txt'; // **Arquivo de log**

/**
 * Função para registrar log
 */
function registrarLog($mensagem)
{
    global $logFile;
    $dataHora = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$dataHora] $mensagem\n", FILE_APPEND);
}

/**
 * Carrega JSON com validação
 */
function carregarJsonSeguro($caminho, $tipo)
{
    if (! file_exists($caminho)) {
        registrarLog("$tipo não encontrado. Criando novo.");
        file_put_contents($caminho, json_encode(["arquivos" => []], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    $json = json_decode(file_get_contents($caminho), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        registrarLog("$tipo corrompido. Recriando.");
        file_put_contents($caminho, json_encode(["arquivos" => []], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return ["arquivos" => []];
    }

    return $json;
}

// **Carrega JSONs com validação**
$syncData    = carregarJsonSeguro($jsonFile, 'sync.json');
$pendingData = carregarJsonSeguro($pendingFile, 'pending_sync.json');

// **Cria nova lista para o pending_sync.json**
$novosPendentes = ["arquivos" => []];

// **Verifica arquivos no sync.json**
foreach ($syncData['arquivos'] as $hash => $info) {
    $caminhoRelativo = urldecode($info['caminho']);
    $caminhoRelativo = str_replace('\\', '/', $caminhoRelativo); // **Troca \ por /** para compatibilidade
    $caminhoAbsoluto = $uploadDir . $caminhoRelativo;

    // **Verifica se o arquivo existe no VPS**
    if (file_exists($caminhoAbsoluto)) {
        $hashVps = md5_file($caminhoAbsoluto);

        // **Compara hash do VPS com o sync.json**
        if ($hash === $hashVps) {
            registrarLog("Arquivo já enviado (mesmo hash): $caminhoRelativo");
            // **Remove do pending_sync.json se estiver lá**
            if (isset($pendingData['arquivos'][$hash])) {
                unset($pendingData['arquivos'][$hash]);
            }
        } else {
            // **Hash diferente, mantém no pending_sync.json**
            $novosPendentes['arquivos'][$hash] = $info;
            registrarLog("Arquivo modificado (hash diferente): $caminhoRelativo");
        }
    } else {
        // **Arquivo não existe, mantém no pending_sync.json**
        $novosPendentes['arquivos'][$hash] = $info;
        registrarLog("Arquivo ausente, marcado como pendente: $caminhoRelativo");
    }
}

// **Salva apenas o pending_sync.json atualizado**
file_put_contents($pendingFile, json_encode($novosPendentes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

registrarLog("Verificação concluída.");
echo "Verificação concluída. Consulte o log para detalhes.\n";
