<?php
/**
 * 📄 arquivos.listar.pastas.php - Lista subpastas de um diretório e verifica vínculo com projetos
 * 🧭 Sistema: SGTopo
 * 📦 Utilitário: Navegação de arquivos vinculados
 * 👤 Autor: Márcio Queiroz Jr
 * 📅 2025-04-10 | 🏷️ v1.0.1
 */

header('Content-Type: application/json');

$caminhoBase = $_GET['caminho'] ?? '';
$dirRaiz     = '/sistema/www/SGTopo/arquivosTopo';
$dirFisico   = rtrim($dirRaiz . '/' . $caminhoBase, '/');
$dirVirtual  = trim($caminhoBase, '/');

// Lista de caminhos vinculados (aqui mockado, pode ser preenchido depois via banco)
$vinculados = []; // Ex: ['Cidades/Goiânia/Toscana/Toscana_QD15LT06']

$pastas = [];
if (is_dir($dirFisico)) {
    foreach (scandir($dirFisico) as $sub) {
        if ($sub === '.' || $sub === '..') {
            continue;
        }

        $subPath = trim($dirVirtual . '/' . $sub, '/');
        if (is_dir($dirFisico . '/' . $sub)) {
            $pastas[] = [
                'nome'      => $sub,
                'caminho'   => $subPath,
                'vinculado' => in_array($subPath, $vinculados),
            ];
        }
    }
}

if ($this->SISTEMA_['SAIDA']['MODE'] == 'app') {
    $this->SISTEMA_['MENSAGEM']['APP']['SUCESSO'] = 'Listagem realizada com sucesso!';
    $this->SISTEMA_['SAIDA']['APP']               = ['pastas' => $pastas];
} else {
    echo json_encode([
        'pastas'      => $pastas,
        'sid'         => md5(uniqid()),
        'SysMensagem' => ['SUCESSO' => 'Listagem realizada com sucesso!'],
    ]);
}