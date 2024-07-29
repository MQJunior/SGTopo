<?php

$gitHubLink = 'https://github.com/MQJunior/SGPadrao/archive/refs/heads/main.zip';
function downloadAndExtractZip($url, $extractPath)
{
    echo "\n Baixando Arquivos...";
    $zipFile = file_get_contents($url);
    $tmpFileZip = $extractPath . "SGPadrao.zip";
    file_put_contents($tmpFileZip, $zipFile);
    if ($zipFile !== false && !empty($zipFile)) {
        $zip = new ZipArchive;
        if ($zip->open($tmpFileZip, ZipArchive::CREATE) === true) {
            echo "\n Extraindo Arquivos...";
            $zip->extractTo($extractPath);
            $zip->close();
            echo "Excluindo Arquivos...";
            unlink($tmpFileZip);
            moveFilesAndFolders($extractPath . 'SGPadrao-main/', $extractPath);
            deleteDirectory($extractPath . 'SGPadrao-main/');
            echo "Arquivo baixado e extraído com sucesso.\n";

        } else {
            echo "Erro ao abrir o arquivo ZIP.\n";
        }
    } else {
        echo "Erro ao baixar o arquivo do GitHub ou o arquivo ZIP está vazio.\n";
    }
}

function getDatabaseCredentials()
{
    echo "Por favor, forneça as informações de configuração:\n";
    $nomeSistema = readline("Nome do Sistema: ");
    $tmp_LocalDir = dirname(__DIR__);
    $localDir = readline("Local: \"" . $tmp_LocalDir . "\\\" <enter> ");
    if ($localDir == "")
        $localDir = $tmp_LocalDir . "\\";
    $dirWWW = readline("Diretorio WWW: ");
    $host = readline("Host do banco de dados: ");
    $username = readline("Usuário do banco de dados: ");
    $password = readline("Senha do banco de dados: ");
    $name = readline("Nome do banco de dados: ");

    return compact('nomeSistema', 'localDir', 'dirWWW', 'host', 'username', 'password', 'name');
}

function alterarLinhaArquivo($caminhoArquivo, $conteudoLinha, $novoValor)
{
    // Lê o conteúdo do arquivo para um array

    if (!file_exists($caminhoArquivo))
        die(" >> " . $caminhoArquivo);
    $linhas = file($caminhoArquivo);

    // Itera sobre as linhas do arquivo
    foreach ($linhas as &$linha) {
        // Verifica se a linha contém o conteúdo desejado
        if (strpos($linha, $conteudoLinha) !== false) {
            // Substitui o valor antigo pelo novo
            $linha = "$conteudoLinha = '$novoValor'; // $conteudoLinha\n";
            break; // Para a iteração após encontrar a linha desejada
        }
    }

    // Converte o array de linhas de volta para uma string
    $novoConteudo = implode('', $linhas);

    // Escreve o novo conteúdo de volta no arquivo
    file_put_contents($caminhoArquivo, $novoConteudo);
}

function installSystem()
{
    global $gitHubLink;

    // Solicite informações de conexão com o banco de dados
    $dbConfig = getDatabaseCredentials();
    $extractPath = $dbConfig['localDir'];
    $extractPath_ = str_replace('\\', '/', $extractPath);
    // Baixe e extraia os arquivos do GitHub
    downloadAndExtractZip($gitHubLink, $extractPath);


    // Alterar Nome do Sistema
    alterarLinhaArquivo($extractPath . 'conf/sistema.conf.php', '$SISTEMA[\'CONFIG\'][\'SISTEMA\'][\'INFO\'][\'SISTEMA_NOME\']', $dbConfig['nomeSistema']);
    alterarLinhaArquivo($extractPath . 'conf/sistema.conf.php', '$SISTEMA[\'CONFIG\'][\'SISTEMA\'][\'GERAL\'][\'NOME\']', $dbConfig['nomeSistema']);
    // Alterar Caminho do Sistema
    alterarLinhaArquivo($extractPath . 'conf/sistema.def.conf.php', '$SISTEMA[\'CONFIG\'][\'SISTEMA\'][\'GERAL\'][\'LOCAL\']', $extractPath_);
    alterarLinhaArquivo($extractPath . 'sistema.php', '$SISTEMA[\'INCLUDES\'][\'DIR\'][\'CONFIG\']', $extractPath_ . 'conf/');

    // Alterar Caminho do dir WWW
    alterarLinhaArquivo($extractPath . 'conf/arquivo.conf.php', '$SISTEMA[\'CONFIG\'][\'ARQUIVO\'][\'LOCAL\'][\'EXIBIR\']', $extractPath_ . 'files/');

    //Alterar Configuracoes do BD
    alterarLinhaArquivo($extractPath . 'conf/db.conf.php', '$SISTEMA[\'CONFIG\'][\'SISTEMA\'][\'DATABASE\'][\'NOME\']', $dbConfig['nomeSistema']);
    alterarLinhaArquivo($extractPath . 'conf/db.conf.php', '$SISTEMA[\'CONFIG\'][\'SISTEMA\'][\'DATABASE\'][\'HOSTNAME\']', $dbConfig['host']);
    alterarLinhaArquivo($extractPath . 'conf/db.conf.php', '$SISTEMA[\'CONFIG\'][\'SISTEMA\'][\'DATABASE\'][\'USERNAME\']', $dbConfig['username']);
    alterarLinhaArquivo($extractPath . 'conf/db.conf.php', '$SISTEMA[\'CONFIG\'][\'SISTEMA\'][\'DATABASE\'][\'PASSWORD\']', $dbConfig['password']);
    alterarLinhaArquivo($extractPath . 'conf/db.conf.php', '$SISTEMA[\'CONFIG\'][\'SISTEMA\'][\'DATABASE\'][\'DATABASENAME\']', $dbConfig['name']);

    $fileInstallDB = $extractPath . 'install/installDB.php';
    if (file_exists($fileInstallDB)) {
        require ($fileInstallDB);
    } else {
        die(__FILE__ . ' > ARQUIVO: "' . $fileInstallDB . '" Não encontrado! < ' . __LINE__);
    }

    print_r($dbConfig);
    die(__FILE__ . ' > Implementar aqui < ' . __LINE__);



    echo "Sistema instalado com sucesso!\n";
}

function moveFilesAndFolders($sourceDir, $destinationDir)
{
    // Garante que os diretórios de origem e destino existem
    if (!is_dir($sourceDir) || !is_dir($destinationDir)) {
        die("Diretórios inválidos. >> " . $sourceDir . " >>> " . $destinationDir . "");
    }

    // Obtém todos os arquivos e pastas no diretório de origem
    $items = glob($sourceDir . '/*');

    // Move cada item para o diretório de destino
    foreach ($items as $item) {
        // Obtém o nome do arquivo ou diretório, incluindo subdiretórios
        $itemName = basename($item);

        // Cria o caminho de destino considerando a estrutura do GitHub
        $newLocation = $destinationDir . '/' . $itemName;

        // Move o item para o novo local
        rename($item, $newLocation);
    }

    echo "Arquivos e pastas movidos com sucesso.\n";
}

function deleteDirectory($dir)
{
    if (!is_dir($dir)) {
        return false;  // Retorna falso se o diretório não existir
    }

    // Abre o diretório
    $directory = opendir($dir);

    // Percorre todos os arquivos e subdiretórios
    while (($file = readdir($directory)) !== false) {
        if ($file != '.' && $file != '..') {
            $filePath = $dir . '/' . $file;

            // Se for um diretório, chama a função recursivamente
            if (is_dir($filePath)) {
                deleteDirectory($filePath);
            } else {
                // Se for um arquivo, exclui o arquivo
                unlink($filePath);
            }
        }
    }

    // Fecha o diretório
    closedir($directory);

    // Exclui o diretório agora vazio
    rmdir($dir);

    return true;
}

// Inicie o processo de instalação
installSystem();
