<?php
/**
* @file tarefas.pesquisa.layout.php
* @name tarefas.pesquisa
* @desc
*   Linhas da tabela de dados da pesquisa
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    tarefas
* @subpackage Layout
* @todo       
*   Descricao todo
*
* @date 2018-07-15  v. 0.0.0
*
*/
$EntidadeCampos = $EntidadeTarefasCampos;
(isset($this->SISTEMA_['ENTIDADE']['TAREFAS']['DADOS']))?$VAR_TAREFAS_LISTAR = $this->SISTEMA_['ENTIDADE']['TAREFAS']['DADOS']:$VAR_TAREFAS_LISTAR = null;

$VAR_DADOS_PESQUISA =$VAR_TAREFAS_LISTAR;
// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para consulta */
$tmpPermissaoConsulta=$PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'TAREFAS', 'CONSULTAR');

unset($PERMISSAO_);
// -------------------- PERMISSAO -----------------//
/* Monta as linhas do resultado da pesquisa */
$this->SISTEMA_['SAIDA']['EXIBIR'] .="<thead>
                <tr>";
                foreach($EntidadeCampos as $tmpCampos){
                  if($tmpCampos['EXIBIR']){
                    $tmpExibir= "SysRtl_Tarefas_Campos_".$tmpCampos['NOME'];
                    $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<th>".$$tmpExibir."</th>";
                  }
                }
              $this->SISTEMA_['SAIDA']['EXIBIR'] .= "                </tr>
              </thead>
              <tbody id=\"TABELA_TAREFAS_PESQUISAR_DADOS\">
              ";

if(!empty($VAR_DADOS_PESQUISA)){
  /* Formata a datacriacao na tabela do resultado da pesquisa */
  $VAR_DADOS_PESQUISA = FORMATA_DADOS($VAR_DADOS_PESQUISA,"DATACRIACAO",$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_EXIBICAO_FORMATO'],"data");
  /* Formatar o campo DATA */
            $VAR_DADOS_PESQUISA = FORMATA_DADOS($VAR_DADOS_PESQUISA,"DATA",$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_EXIBICAO_FORMATO'],"data");
/* Formatar o campo DATA_FINAL */
            $VAR_DADOS_PESQUISA = FORMATA_DADOS($VAR_DADOS_PESQUISA,"DATA_FINAL",$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_EXIBICAO_FORMATO'],"data");
 
  
  foreach($VAR_DADOS_PESQUISA as $VAR_LISTAR_DADOS){
    if($VAR_LISTAR_DADOS['REG_ATIVO']==1){
      $tmpStatusREG_ATIVO_stilo="";
    }else{
      $tmpStatusREG_ATIVO_stilo="class=\"text-$SistemaLayoutRegInativoCor\"";
    }
    $tmpCODIGO = $VAR_LISTAR_DADOS['CODIGO'];
    
    if($tmpPermissaoConsulta)
      $this->SISTEMA_['SAIDA']['EXIBIR'] .= " <tr $tmpStatusREG_ATIVO_stilo style=\"cursor:pointer\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID&SysEntidade=TAREFAS&SysEntidadeAcao=CONSULTAR&txtChaveRegistro=$tmpCODIGO','','DIV_CONTEUDO',null)\">";
    else
      $this->SISTEMA_['SAIDA']['EXIBIR'] .= " <tr $tmpStatusREG_ATIVO_stilo>";
    
    foreach($EntidadeCampos as $tmpCampos)
      if($tmpCampos['EXIBIR']){
          /* Tratamento do campo REPETIR SEMANA */
          if ($tmpCampos['NOME'] == 'REPETIR_SEMANA'){
            $tmpVAR_TAREFAS_REPETIR_SEMANA =str_split($VAR_LISTAR_DADOS[$tmpCampos['NOME']]);
            $VAR_TAREFAS_REPETIR_SEMANA = '';
            for ($i=0; $i<count($SysOpt_Tarefas_SEMANA['DIAS']); $i++)
              if ($tmpVAR_TAREFAS_REPETIR_SEMANA[$i]=='1')
                $VAR_TAREFAS_REPETIR_SEMANA .= $SysOpt_Tarefas_SEMANA['DIAS'][$i].'; ';
            
            $VAR_LISTAR_DADOS[$tmpCampos['NOME']] = $VAR_TAREFAS_REPETIR_SEMANA;
          }
          /* Tratamento do campo ENTIDADEACAO */
          if ($tmpCampos['NOME'] == 'ENTIDADEACAO'){
            $VAR_TAREFAS_ENTIDADE = ucfirst(strtolower($VAR_LISTAR_DADOS['ENTIDADE']));
            $VAR_TAREFAS_ENTIDADEACAO_NOME = ucwords(strtolower(str_replace('_',' ',$VAR_LISTAR_DADOS['ENTIDADEACAO_NOME'])));
            $VAR_LISTAR_DADOS[$tmpCampos['NOME']] = $VAR_TAREFAS_ENTIDADE.".".$VAR_TAREFAS_ENTIDADEACAO_NOME;
          }
        $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<td>".$VAR_LISTAR_DADOS[$tmpCampos['NOME']]."</td>";
      }
    $this->SISTEMA_['SAIDA']['EXIBIR'] .= "                </tr>";
  }
}
?>