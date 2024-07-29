<?php

require_once($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."mapa.icones.def.php");
$VAR_MENU_CODIGO = $this->SISTEMA_['ENTIDADE']['MENU']['VARS']['CODIGO'];

$this->SISTEMA_['SAIDA']['EXIBIR'] = "<ul class=\"treeview\">
            ".$VAR_SISTEMA_MENU."
          </ul>
          <script>
            
            PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=MENU&SysEntidadeAcao=CONSULTAR&txtChaveRegistro=".$VAR_MENU_CODIGO."','','DIV_FORM_MENU_ALTERAR',null)
          </script>";
?>