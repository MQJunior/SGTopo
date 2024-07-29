<?php
/**
 * sgpadrao.conf.php
 *
 * SGPadrao - Configuração Diversas
 *
 * Definições diversas do sistema
 *
 * @date 2018-01-10
 *
 * @author Márcio Queiroz Jr <mqjunior@gmail.com>
 * @version 1.0
 * @copyright Copyright © 2006, Márcio Queiroz Jr.
 * @package SGPadrao
 * @subpackage Config
 * @category Sistema
 */

require_once ($SISTEMA['INCLUDES']['DIR']['CONFIG'] . 'db.conf.php');

$SISTEMA['CONFIG']['SISTEMA']['INFO']['SISTEMA_NOME'] = 'SysPadrão'; // Define o nome do Sistema
$SISTEMA['CONFIG']['SISTEMA']['INFO']['SISTEMA_NOMECURTO'] = 'SyP'; // Define o nome do Sistema
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['NOME'] = 'SGPADRAO'; // Define o nome do Sistema
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['SISTEMAID'] = 1; // Código de identificação do sistema
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['IDIOMA'] = 'BRASIL'; // Idioma do Sistema
$SISTEMA['INCLUDES']['CLASSES']['SISTEMA'] = $SISTEMA['INCLUDES']['DIR']['LIB'] . 'class.sistema.lib.php'; // Define a LIB que gerencia o Sistema

$SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCATE'] = "pt_BR";
setlocale(LC_ALL, $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCATE']); // Define informações de acordo com a localidade
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['DATA_EXIBICAO_FORMATO'] = "d/m/Y"; // Define o formato de exibição da Data no sistema
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'] = "d/m/Y H:i:s"; // Define o formato de exibição da Data e hora no sistema
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_ARMAZENAMENTO_FORMATO'] = "Y-m-d H:i:s"; // Define o formato da Data e hora para armazenamento no Banco de Dados
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['MOEDA_SIMBOLO'] = "R$ "; // Define o símbolo da moeda no sistema
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['MOEDA_FORMATO'] = "%.2n"; // Define o formato da moeda no sistema (2 casas decimais)

$SISTEMA['CONFIG']['SISTEMA']['GERAL']['BIN'] = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] . "bin/"; // Define o diretório dos arquivos bin
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['DEF'] = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] . "def/"; // Define o diretório dos arquivos def
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['CONF'] = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] . "conf/"; // Define o diretório dos arquivos conf
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['LIB'] = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] . "lib/"; // Define o diretório dos arquivos lib - class
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['TMP'] = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] . "tmp/files/"; // Define o diretório dos arquivos temporários - tmp

$SISTEMA['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'] = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] . "SGPadrao/Layout/"; // Define o diretório do LAYOUT_PADRÃO
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['LAYOUT_MODELO'][0] = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] . "layout/html/"; // Define o diretório do LAYOUT MODELO PARA WEB (HTML)
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['LAYOUT_MODELO'][1] = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] . "layout/texto/"; // Define o diretório do LAYOUT MODELO PARA TEXTO
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['LAYOUT_MODELO'][2] = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] . "layout/pascal/"; // Define o diretório do LAYOUT MODELO PARA PASCAL (DELPHI)
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['LAYOUT_MODELO'][3] = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] . "layout/texto/"; // Define o diretório do LAYOUT MODELO PARA TEXTO

$SISTEMA['CONFIG']['SISTEMA']['ENTIDADEPADRAO'] = "SISTEMA"; // Define a entidade padrão para o sistema
$SISTEMA['CONFIG']['SISTEMA']['ACAOPADRAO'] = "LOGAR"; // Define a ação padrão para o sistema

$SISTEMA['CONFIG']['SISTEMA']['ENTIDADELOGIN'] = "USUARIO"; // Define a entidade padrão para o sistema
$SISTEMA['CONFIG']['SISTEMA']['ACAOLOGIN'] = "LOGIN"; // Define a ação padrão para o sistema
