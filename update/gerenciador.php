<?php

define("DIRETORIO_BASE", "/sistema/sistemas/SGPadrao"); // Diretório alvo
define("DIRETORIO_METADADOS", "metadados"); // Onde os JSONs serão armazenados
define("EXTENSOES_PERMITIDAS", ["php", "py", "sh", "sql"]); // Extensões permitidas
define("PACOTE_NOME", "SGPadrao"); // Nome fixo do pacote
define("USUARIO_FIXO", "admin"); // Usuário fixo que fez a alteração

// Verificar se o diretório base existe antes de continuar
if (!is_dir(DIRETORIO_BASE)) {
    die("❌ Erro: O diretório '" . DIRETORIO_BASE . "' não existe.\n");
}

// Criar diretório de metadados se não existir
if (!is_dir(DIRETORIO_METADADOS)) {
    mkdir(DIRETORIO_METADADOS, 0777, true);
}

// Função para escanear recursivamente os arquivos dentro de DIRETORIO_BASE
function listarArquivos($dir)
{
    $arquivos = [];
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($it as $arquivo) {
        if ($arquivo->isFile()) {
            $extensao = pathinfo($arquivo->getFilename(), PATHINFO_EXTENSION);
            if (in_array($extensao, EXTENSOES_PERMITIDAS)) {
                $arquivos[] = $arquivo->getPathname();
            }
        }
    }
    return $arquivos;
}

// Função para gerar o nome do arquivo JSON correspondente
function gerarNomeJSON($caminhoArquivo)
{
    $caminhoRelativo = str_replace(DIRETORIO_BASE . "/", "", $caminhoArquivo);
    return DIRETORIO_METADADOS . "/sistema." . str_replace("/", ".", $caminhoRelativo) . ".json";
}

// Função para calcular o hash do arquivo
function calcularHash($arquivo)
{
    return hash_file('sha256', $arquivo);
}

// Função para obter metadados do arquivo
function obterMetadadosArquivo($arquivo)
{
    return [
        "hash" => calcularHash($arquivo),
        "tamanho" => filesize($arquivo) . " bytes",
        "data_hora_modificacao" => date("Y-m-d\TH:i:s", filemtime($arquivo))
    ];
}

// Processamento dos arquivos
$arquivos = listarArquivos(DIRETORIO_BASE);
if (empty($arquivos)) {
    die("🔹 Nenhum arquivo válido encontrado em '" . DIRETORIO_BASE . "'.\n");
}

foreach ($arquivos as $arquivo) {
    $jsonFile = gerarNomeJSON($arquivo);
    $nomeArquivo = basename($arquivo);
    $caminhoRelativo = str_replace(DIRETORIO_BASE . "/", "", $arquivo);
    $versaoAtual = obterMetadadosArquivo($arquivo);
    $hashAtual = $versaoAtual["hash"];

    // Se o JSON já existir, carregar e atualizar
    if (file_exists($jsonFile)) {
        $dados = json_decode(file_get_contents($jsonFile), true);
    } else {
        $dados = [
            "nome" => $nomeArquivo,
            "caminho" => $caminhoRelativo,
            "pacote" => PACOTE_NOME, // Agora sempre será "SGPadrao"
            "hash_atual" => $hashAtual,
            "versoes" => []
        ];
    }

    // Checar se há mudança comparando com a última versão registrada
    if (empty($dados["versoes"]) || $dados["versoes"][0]["hash"] !== $hashAtual) {
        // Incrementar a versão automaticamente (ex: 1.0.1 → 1.0.2)
        $novaVersao = "1.0.0";
        if (!empty($dados["versoes"])) {
            $ultimaVersao = explode(".", $dados["versoes"][0]["versao"]);
            $ultimaVersao[2] = intval($ultimaVersao[2]) + 1; // Incrementa o último dígito da versão
            $novaVersao = implode(".", $ultimaVersao);
        }

        // Atualizar o hash atual
        $dados["hash_atual"] = $hashAtual;

        // Criar nova versão com o `usuario` e `relatorio` no final
        $novaVersaoDados = array_merge(
            ["versao" => $novaVersao],
            $versaoAtual,
            ["usuario" => USUARIO_FIXO],
            ["relatorio" => "Última alteração detectada em " . $versaoAtual["data_hora_modificacao"]]
        );

        // Adicionar nova versão ao início do array
        array_unshift($dados["versoes"], $novaVersaoDados);

        // Salvar no arquivo JSON com caracteres acentuados preservados
        file_put_contents($jsonFile, json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        echo "✅ Atualizado: $jsonFile (Nova versão: $novaVersao, Usuário: " . USUARIO_FIXO . ")\n";
    } else {
        echo "🔹 Sem mudanças: $jsonFile\n";
    }
}

echo "🎯 Processamento concluído.\n";

?>