<?php
$VAR_SISTEMA_MENU = $this->SISTEMA_['ENTIDADE']['MENU']['VARS']['VAR_SISTEMA_MENU'];
if (!isset($VAR_SISTEMA_MENU))
  die("Faltou Paramentro: VAR_SISTEMA_MENU");
$tmp_Layout_MenuItens = $VAR_SISTEMA_MENU;
$tmp_Layout_MenuEsquerdo =
  "<!-- Left side column. contains the logo and sidebar -->
      <aside class=\"main-sidebar\">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class=\"sidebar\">
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class=\"sidebar-menu\">
            " . $tmp_Layout_MenuItens . "
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>";
