<?php


$this->SISTEMA_['SAIDA']['EXIBIR'] = "";
if((!empty($VAR_USUARIO_LISTAR)) && (count($VAR_USUARIO_LISTAR)>0)){
  foreach($VAR_USUARIO_LISTAR as $VAR_LISTAR_DADOS){
    
    if($VAR_LISTAR_DADOS['REG_ATIVO']==1){
      $tmpStatusREG_ATIVO = "Ativo";
    }else{
      $tmpStatusREG_ATIVO_stilo="class=\"text-yellow\"";
      $tmpStatusREG_ATIVO = "Bloqueado";
    }
  
  $tmpCODIGO = $VAR_LISTAR_DADOS['CODIGO'];
  $this->SISTEMA_['SAIDA']['EXIBIR'] .= " <tr onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID ."&SysEntidade=USUARIO&SysEntidadeAcao=CONSULTAR&txtChaveRegistro=".$tmpCODIGO."','','DIV_CONTEUDO',null)\">
                    <td>".$VAR_LISTAR_DADOS['NOME_EXIBIR']."</td>
                    <td>".$VAR_LISTAR_DADOS['EMAIL']."</td>
                    <td>".$VAR_LISTAR_DADOS['DATACRIACAO']."</td>
                    <td>".$VAR_LISTAR_DADOS['USUARIO_CRIOU_NOME']."</td>
                    <td>".$tmpStatusREG_ATIVO."</td>
                  </tr>
                  ";

  }
}else{
                $this->SISTEMA_['SAIDA']['EXIBIR'] .= " <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                      </tr>";
  
}  
?>