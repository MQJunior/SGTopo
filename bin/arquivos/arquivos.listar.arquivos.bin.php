<?php
/**
 * 📄 arquivos.listar.arquivos.php - Lista arquivos e subpastas dentro de uma pasta
 * 🧭 Sistema: SGTopo
 * 📦 Utilitário: Listagem de conteúdo físico com vínculo
 * 👤 Autor: Márcio Queiroz Jr
 * 📅 2025-04-10 | 🏷️ v1.0.2
 */

header('Content-Type: application/json');

// Recebe JSON da requisição
$input           = json_decode(file_get_contents('php://input'), true);
$caminhoRelativo = $input['caminho'] ?? '';
$sid             = $input['SID'] ?? md5(uniqid());

// Define o diretório físico base
$dirRaiz   = '/sistema/www/SGTopo/arquivosTopo';
$dirFisico = rtrim($dirRaiz . '/' . $caminhoRelativo, '/');

$conteudo = [];

if (is_dir($dirFisico)) {
    foreach (scandir($dirFisico) as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }

        $caminhoCompleto = $dirFisico . '/' . $item;
        $caminhoVirtual  = trim($caminhoRelativo . '/' . $item, '/');

        if (is_dir($caminhoCompleto)) {
            $conteudo[] = [
                'nome'      => $item,
                'caminho'   => $caminhoVirtual,
                'tipo'      => 'pasta',
                'vinculado' => false, // ajuste posterior via banco
            ];
        } elseif (is_file($caminhoCompleto)) {
            $conteudo[] = [
                'nome'      => $item,
                'caminho'   => $caminhoVirtual,
                'tipo'      => 'arquivo',
                'vinculado' => false, // ajuste posterior via banco
            ];
        }
    }
}

if (isset($this) && $this->SISTEMA_['SAIDA']['MODE'] == 'app') {
    $this->SISTEMA_['MENSAGEM']['APP']['SUCESSO'] = 'Conteúdo listado com sucesso!';
    $this->SISTEMA_['SAIDA']['APP']               = ['arquivos' => $conteudo];
} else {
    echo json_encode([
        'arquivos'    => $conteudo,
        'sid'         => $sid,
        'SysMensagem' => ['SUCESSO' => 'Conteúdo listado com sucesso!'],
    ]);
}