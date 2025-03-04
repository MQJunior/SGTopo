<?php

// monta o conteudo principal
// Menu Esquerdo  
include_once ($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'] . "sistema/sistema.menu.layout.php");
// Topo da P�gina 
include_once ($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'] . "sistema/sistema.topo.layout.php");
// Conteudo central da P�gina 
include_once ($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'] . "sistema/sistema.conteudo.layout.php");
// Conteudo Barra de Configuracoes
include_once ($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'] . "layout/layout.configuracao.layout.php");

$RtlSistemaTitulo = $this->SISTEMA_['CONFIG']['SISTEMA']['INFO']['SISTEMA_NOME'];

if ($this->SISTEMA_['SAIDA']['MODE'] == 'html') {
    include_once ($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'] . "sistema/sistema.principal.layout.php");
} else {
    require ($this->SISTEMA_['LAYOUT'] . "../basic/componentes.layout.php");
    //die(json_encode($this->SISTEMA_['ENTIDADE']['MENU']['VAR_MENU_GERAL'][0], true));

    $this->SISTEMA_['SAIDA']['PAGINA'] = $tmpLayoutDashBoard;

    if (isset($this->SISTEMA_['ENTIDADE']['MENU']['VAR_MENU_GERAL'])) {
        $this->SISTEMA_['SAIDA']['PAGINA']['MENU']['DATA'] = $this->SISTEMA_['ENTIDADE']['MENU']['VAR_MENU_GERAL'][0];
        $this->SISTEMA_['SAIDA']['PAGINA']['MENU']['TARGET'] = 'DIV_MENU_ESQUERDO';
    }
}
//die(print_r($this->SISTEMA_['SAIDA']['PAGINA']));