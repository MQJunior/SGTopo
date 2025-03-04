<?php
if (isset($this->SISTEMA_['CONFIG']['WEB'])) {
    $url_Layout = $this->SISTEMA_['CONFIG']['WEB']['LAYOUT'];
    $url_Layout_Font = $this->SISTEMA_['CONFIG']['WEB']['FONTS'];
    $url_Layout_Ajax = $this->SISTEMA_['CONFIG']['WEB']['AJAX'];
    $url_Layout_Padrao = $this->SISTEMA_['CONFIG']['WEB']['LAYOUT_PADRAO'];
    //echo "aqui";
} else {
    $url_Layout = "http://mqjrserver/Layout/";
    $url_Layout_Font = $url_Layout . "fonts/";
    $url_Layout_Ajax = $url_Layout . "ajax/";
    $url_Layout_Padrao = $url_Layout . "modelos/ATL/";
}


$RtlSistemaTitulo = $this->SISTEMA_['CONFIG']['SISTEMA']['INFO']['SISTEMA_NOME'];
$RtlSistemaTitulo = htmlentities($RtlSistemaTitulo);

//$SISTEMA['SAIDA']['MODE'] = 'api';

if ($this->SISTEMA_['SAIDA']['MODE'] == 'html') {
    include_once ($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'] . "sistema/sistema.logar.layout.php");
} else {
    require ($this->SISTEMA_['LAYOUT'] . "../basic/componentes.layout.php");

    $tmpLayoutPaginaLogin = $tmpLayoutPagina;
    $tmpLayoutPaginaLogin['ID'] = "FrmLogin";
    $tmpLayoutPaginaLogin['NAME'] = "FrmLogin";
    $tmpLayoutPaginaLogin['TYPE'] = "Page";
    $this->SISTEMA_['SAIDA']['PAGINA'] = $tmpLayoutPaginaLogin['PAGINA'];


    $cmpPadraoLogar_grpFormulario = $tmpLayoutComponentePadraoGroup;
    $cmpPadraoLogar_grpFormulario['ID'] = "grpPadraoLogar";
    $cmpPadraoLogar_grpFormulario['LABEL'] = "Grp Padrao";
    $cmpPadraoLogar_grpFormulario['STYLE'] = "NULL";

    $cmpFormularioLogin = $tmpLayoutFormulario;
    $cmpFormularioLogin['ID'] = "FrmLogin";
    $cmpFormularioLogin['NAME'] = "FrmLogin";
    $cmpFormularioLogin['TITLE'] = $RtlSistemaTitulo;
    $cmpFormularioLogin['SUBTITLE'] = $SysRtl_Sistema_Logar_Mensagem_BoaVindas;


    $cmpSistemaLogarSysEntidade = $tmpLayoutComponenteHidden;
    $cmpSistemaLogarSysEntidade['ID'] = "SysEntidade";
    $cmpSistemaLogarSysEntidade['FIELD'] = $cmpSistemaLogarSysEntidade['ID'];
    $cmpSistemaLogarSysEntidade['VALUE'] = "USUARIO";
    $cmpFormularioLogin['COMPONENTES'][] = $cmpSistemaLogarSysEntidade;

    $cmpSistemaLogarSysEntidadeAcao = $tmpLayoutComponenteHidden;
    $cmpSistemaLogarSysEntidadeAcao['ID'] = "SysEntidadeAcao";
    $cmpSistemaLogarSysEntidadeAcao['FIELD'] = $cmpSistemaLogarSysEntidadeAcao['ID'];
    $cmpSistemaLogarSysEntidadeAcao['VALUE'] = "LOGIN";
    $cmpFormularioLogin['COMPONENTES'][] = $cmpSistemaLogarSysEntidadeAcao;

    $cmpSistemaLogar_txtLoginEmail = $tmpLayoutComponenteEmail;
    $cmpSistemaLogar_txtLoginEmail['ID'] = "txtLoginEmail";
    $cmpSistemaLogar_txtLoginEmail['VALUE'] = "";
    $cmpFormularioLogin['COMPONENTES'][] = $cmpSistemaLogar_txtLoginEmail;

    $cmpSistemaLogar_txtLoginSenha = $tmpLayoutComponentePassword;
    $cmpSistemaLogar_txtLoginSenha['ID'] = "txtLoginSenha";
    $cmpSistemaLogar_txtLoginSenha['VALUE'] = "";
    $cmpFormularioLogin['COMPONENTES'][] = $cmpSistemaLogar_txtLoginSenha;

    $cmpSistemaLogar_txtManterConectado = $tmpLayoutComponenteCheckBox;
    $cmpSistemaLogar_txtManterConectado['ID'] = "txtManterConectado";
    $cmpSistemaLogar_txtManterConectado['CHECKED'] = false;
    $cmpSistemaLogar_txtManterConectado['LABEL'] = $SysRtl_Sistema_Logar_TxtManterConectado;
    $cmpFormularioLogin['COMPONENTES'][] = $cmpSistemaLogar_txtManterConectado;

    $cmpSistemaLogar_btnEnviar = $tmpLayoutComponentePadraoButton;
    $cmpSistemaLogar_btnEnviar['ID'] = "btnEnviar";
    $cmpSistemaLogar_btnEnviar['NAME'] = "btnEnviar";
    $cmpSistemaLogar_btnEnviar['SOURCE'] = $cmpFormularioLogin['NAME'];
    $cmpSistemaLogar_btnEnviar['TARGET'] = "app";
    $cmpFormularioLogin['COMPONENTES'][] = $cmpSistemaLogar_btnEnviar;

    $cmpPadraoLogar_grpFormulario['COMPONENTES'][] = $cmpFormularioLogin;


    $this->SISTEMA_['SAIDA']['PAGINA']['COMPONENTES'][] = $cmpPadraoLogar_grpFormulario;








}

