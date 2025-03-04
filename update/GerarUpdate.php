<?php

define("DIRETORIO_METADADOS", "metadados"); // Diretório onde os metadados JSON estão armazenados
define("ARQUIVO_UPDATE", "sistema_update.json"); // Nome do JSON consolidado
define("NOME_SISTEMA", "SGPadrao"); // Nome fixo do sistema
define("PACOTE_SISTEMA", "SGPadrao"); // Nome fixo do pacote

// Mapear categorias para relevância
$categorias_relevancia = [
    "log" => 0,
    "config" => 1,
    "def" => 2,
    "bin" => 3
];

// Inicializa o JSON consolidado
$versaoGeral = "0.0.0"; // Começamos com a menor versão possível
$arquivosListados = []; // Lista dos arquivos

// Percorre os arquivos de metadados
$arquivosMetadados = glob(DIRETORIO_METADADOS . "/*.json");
foreach ($arquivosMetadados as $jsonFile) {
    $dados = json_decode(file_get_contents($jsonFile), true);
    if (!$dados)
        continue; // Ignora arquivos inválidos

    // Obter a versão mais recente do arquivo
    $ultimaVersao = $dados["versoes"][0] ?? null;
    if (!$ultimaVersao)
        continue; // Se não há versões, ignora

    // Obter pacote do JSON
    $pacote = $dados["pacote"] ?? "Desconhecido";

    // Obter o caminho completo do arquivo
    $caminhoArquivo = $dados["caminho"] ?? "desconhecido";

    // Determinar a categoria e relevância do arquivo
    $categoria = "outro";
    foreach ($categorias_relevancia as $cat => $rel) {
        if (strpos(strtolower($dados["nome"]), $cat) !== false) {
            $categoria = $cat;
            break;
        }
    }
    $relevancia = $categorias_relevancia[$categoria] ?? 0;

    // Comparar a versão para encontrar a maior
    if (version_compare($ultimaVersao["versao"], $versaoGeral, ">")) {
        $versaoGeral = $ultimaVersao["versao"];
    }

    // Adicionar à lista de arquivos
    $arquivosListados[] = [
        "nome" => $dados["nome"],
        "caminho" => $caminhoArquivo,
        "hash" => $ultimaVersao["hash"],
        "versao" => $ultimaVersao["versao"],
        "datahora" => $ultimaVersao["data_hora_modificacao"],
        "categoria" => $categoria,
        "pacote" => $pacote,
        "relevancia" => $relevancia
    ];
}

// Gerar hash geral com base no conteúdo da lista de arquivos
$hashSistema = hash("sha256", json_encode($arquivosListados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

// Criar JSON consolidado com os campos principais antes da lista de arquivos
$jsonUpdate = [
    "nome_sistema" => NOME_SISTEMA,
    "pacote_sistema" => PACOTE_SISTEMA,
    "versao_sistema" => $versaoGeral,
    "hash_sistema" => $hashSistema,
    "arquivos" => $arquivosListados
];

// Salvar JSON consolidado
file_put_contents(ARQUIVO_UPDATE, json_encode($jsonUpdate, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

echo "✅ Arquivo de atualização gerado: " . ARQUIVO_UPDATE . "\n";
echo "📌 Nome do sistema: " . NOME_SISTEMA . "\n";
echo "📦 Pacote: " . PACOTE_SISTEMA . "\n";
echo "📌 Versão geral do sistema: " . $versaoGeral . "\n";
echo "🔑 Hash geral do sistema: " . $hashSistema . "\n";

?>