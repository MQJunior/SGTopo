<?php
$fileSQL = 'sqlStart.sql';
if (isset($extractPath)) {
    $fileSQL = $extractPath . 'install/' . $fileSQL;
}
if (file_exists($fileSQL)) {
    $scriptSQL = file_get_contents($fileSQL);
    //var_dump($scriptSQL);
} else {
    echo 'Arquivo: "' . $fileSQL . '" Não Exite! ';
    die();
}

// Defina as credenciais do banco de dados MySQL
if (isset($dbConfig)) {
    $servername = $dbConfig['host'];
    $username = $dbConfig['username'];
    $password = $dbConfig['password'];
    $database = $dbConfig['name'];
} else {
    die("Insira as informações de Acesso ao BD");
}

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$sqlContent = $scriptSQL;

$sqlContent = str_replace("`sgpadrao`", "`$database`", $sqlContent);
$sqlContent = str_replace("sgpadrao.", "$database.", $sqlContent);
//die($sqlContent);
// Divide o conteúdo em instruções SQL individuais
$sqlCommands = explode(";", $sqlContent);

// Executa cada instrução SQL
foreach ($sqlCommands as $sqlCommand) {
    // Executa apenas se a instrução SQL não estiver vazia
    if (trim($sqlCommand) != '') {
        if ($conn->query($sqlCommand) === TRUE) {
            echo "Instrução SQL executada com sucesso: " . $sqlCommand . "<br>";
        } else {
            echo "Erro ao executar instrução SQL: " . $conn->error . "<br>";
        }
    }
}

// Fecha a conexão com o banco de dados
$conn->close();


