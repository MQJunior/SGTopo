<?php

$Sistema_NomeCurto = $this->SISTEMA_['CONFIG']['SISTEMA']['INFO']['SISTEMA_NOMECURTO'];
$Sistema_Nome = $this->SISTEMA_['CONFIG']['SISTEMA']['INFO']['SISTEMA_NOME'];


$TMP_SESSAO_UID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];

$Usuario_Perfil_Nome = $this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['NOME_EXIBIR'];
$Usuario_Perfil_Funcao = $this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['FUNCAO'];
$Usuario_Perfil_DataCadastro = $this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['DATACRIACAO'];
$VAR_USUARIO_IMAGEM = $this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['IMAGEM'];
$VAR_IMAGEM_LINK = $this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['IMAGEM_LINK'];
$Usuario_Perfil_Imagem = $VAR_USUARIO_IMAGEM;

$VAR_USUARIO_CODIGO = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];

if ($VAR_USUARIO_IMAGEM == null) {
  $VAR_IMAGEM_LINK = null;
} else {
  $USUARIO_ = new usuario($this->SISTEMA_);
  $USUARIO_->consultar($VAR_USUARIO_CODIGO);
  $VAR_IMAGEM_LINK = $USUARIO_->ExibirImagem();
  unset($USUARIO_);
}

if (($VAR_IMAGEM_LINK == null) || ($VAR_IMAGEM_LINK == ""))
  $Usuario_Perfil_Imagem = $url_Layout_Padrao . "dist/img/user2-160x160.jpg";
else
  $Usuario_Perfil_Imagem = $VAR_IMAGEM_LINK;

$Sistema_Nome = htmlentities($Sistema_Nome);
$tmp_Layout_Topo =
  " <header class=\"main-header\">
        <!-- Logo -->
        <a href=\".\" class=\"logo\">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class=\"logo-mini\">" . $Sistema_NomeCurto . "</span>
          <!-- logo for regular state and mobile devices -->
          <span class=\"logo-lg\">" . $Sistema_Nome . "</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class=\"navbar navbar-static-top\" role=\"navigation\">
          <!-- Sidebar toggle button-->
          <a href=\"#\" class=\"sidebar-toggle\" data-toggle=\"offcanvas\" role=\"button\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=MENU&SysEntidadeAcao=RELOAD&SID=" . $TMP_SESSAO_UID . "','','DIV_MENU_ESQUERDO',null);\">
            <span class=\"sr-only\">Toggle navigation</span>
          </a>
                      <!--
          <div class=\"navbar-nav\">
            <ul class=\"nav navbar-nav\"> 
            <li class=\"dropdown user user-menu\">
                <a href=\"#\"><i class=\"fa fa-circle-o text-red\"></i> <span>" . $TMP_SESSAO_UID . "</span></a>
              </li>
              </ul>
          </div> -->
            
          <div class=\"navbar-custom-menu\">
            <ul class=\"nav navbar-nav\">   
            
              <!-- User Account: style can be found in dropdown.less -->
              <li class=\"dropdown user user-menu\">
                <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                  <img src=\"" . $Usuario_Perfil_Imagem . "\" class=\"user-image\" alt=\"User Image\">
                  <span class=\"hidden-xs\">" . $Usuario_Perfil_Nome . "</span>
                </a>
                <ul class=\"dropdown-menu\">
                  <!-- User image -->
                  <li class=\"user-header\">
                    <img src=\"" . $Usuario_Perfil_Imagem . "\" class=\"img-circle\" alt=\"User Image\">
                    <p>
                      " . $Usuario_Perfil_Nome . " - " . $Usuario_Perfil_Funcao . "
                      <small>" . $Usuario_Perfil_DataCadastro . "</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class=\"user-body\">
                    <div class=\"col-xs-4 text-center\">
                      <a href=\"#\">Mensagens</a>
                    </div>
                    <div class=\"col-xs-4 text-center\">
                      <a href=\"#\">Contatos</a>
                    </div>
                    <div class=\"col-xs-4 text-center\">
                      <a href=\"#\">Suporte</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class=\"user-footer\">
                    <div class=\"pull-left\">
                      <a href=\"javascript::;\" class=\"btn btn-default btn-flat\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=" . $TMP_SESSAO_UID . "&SysEntidade=USUARIO&SysEntidadeAcao=PERFIL','','DIV_CONTEUDO',null)\">Perfil</a>
                    </div>
                    <div class=\"pull-right\">
                      <a href=\"#\" class=\"btn btn-default btn-flat\">Sair</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href=\"#\" data-toggle=\"control-sidebar\"><i class=\"fa fa-gears\"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
";
?>