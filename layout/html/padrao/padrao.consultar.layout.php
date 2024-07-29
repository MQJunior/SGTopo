<?php
/**
 * @file padrao.consultar.layout.php
 * @name padrao.consultar
 * @desc
 *   Layout para o formul�rio de consulta
 *
 * @author     M�rcio Queiroz Jr <mqjunior@gmail.com>
 * @version    0.0.0 
 * @copyright  Copyright � 2006, M�rcio Queiroz Jr.
 * @package    padrao
 * @subpackage Layout
 * @todo       
 *   Descricao todo
 *
 * @date 2018-02-22  v. 0.0.0
 *
 */

// -------------------- CAPTURA DE DADOS -----------------//
/* Verifica os campos obrigat�rios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadePadraoCampos;

/* Captura as Variaveis que ser�o exibidas */
foreach ($EntidadeCampos as $tmpValor) {
  $tmpVar = "VAR_PADRAO_" . $tmpValor['NOME'];
  $$tmpVar = $this->SISTEMA_['ENTIDADE']['PADRAO']['VARS'][$tmpValor['NOME']];
}

// -------------------- MANIPULA��O -----------------//
/* Formata o campo DATACRIACAO */
$VAR_PADRAO_DATACRIACAO = FORMATA_CAMPO($VAR_PADRAO_DATACRIACAO, $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'], 'data');

/* Formata o campo DATA */
$VAR_PADRAO_DATA = FORMATA_CAMPO($VAR_PADRAO_DATA, $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_EXIBICAO_FORMATO'], 'data');

/* Formatar o campo VALOR */
$VAR_PADRAO_VALOR = FORMATA_CAMPO($VAR_PADRAO_VALOR, $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['MOEDA_SIMBOLO'], 'moeda');

/* Verifica se o registro foi desativado */
if ($VAR_PADRAO_REG_ATIVO == '1') {
  $VAR_PADRAO_REG_ATIVO = true;
  $VAR_REGISTRO_INATIVO = "";
} else {
  $VAR_PADRAO_REG_ATIVO = false;
  $VAR_REGISTRO_INATIVO = " <div class=\"form-group\">
          <div class=\"col-sm-offset-5 col-sm-7\" id=\"DIV_LOG_INFO\">
            <b class=\"text-yellow\">$SysRtl_Registro_Inativo</b>
          </div>
          <div class=\"col-sm-5\">
          </div>";
}
// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);
$tmpListaAcoesPermissaoPadrao = $PERMISSAO_->ListaAcaoPermissaoEntidade($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO');

//print_r(array_values($tmpListaAcoesPermissaoPadrao));
//die();

/* Permiss�o exibir detalhes do log do registro */
$tmpLogAtividade = "<i class=\"fa fa-info-circle\"></i>";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'LOGATIVIDADE', 'INFORMACAO')) {
  $tmpLogAtividade = "<a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=LOGATIVIDADE&SysEntidadeAcao=INFORMACAO&txtChaveRegistro=$VAR_PADRAO_CODIGO&TXT_LOGATIVIDADE_ENTIDADE=PADRAO&SID=$SistemaSessaoUID','','DIV_LOG_INFO',null)\">
              <i class=\"fa fa-info-circle\"></i>
            </a> ";
}
/* Permiss�o exibir Data de Cria��o do registro e o Usu�rio que criou*/
$tmpLogVer = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'LOGATIVIDADE', 'VER'))
  $tmpLogVer = "<h6 class=\"text-muted\">
            $tmpLogAtividade
            <i>$SysRtl_Padrao_Campos_USUARIO_NOME:</i><b> $VAR_PADRAO_USUARIO_NOME</b> - <i>$SysRtl_Padrao_Campos_DATACRIACAO:</i><b> $VAR_PADRAO_DATACRIACAO</b></h6>";


/* Permiss�o para o bot�o excluir */
$btn_excluir = "";
if (in_array('EXCLUIR', $tmpListaAcoesPermissaoPadrao))
  $btn_excluir = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PADRAO&SysEntidadeAcao=EXCLUIR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_PADRAO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-trash-o\"></i> <b>$SysRtl_Btn_Excluir</b></a>";

/* Permiss�o para o bot�o desativar */
$btn_desativar = "";
if ($VAR_PADRAO_REG_ATIVO)
  if (in_array('DESATIVAR', $tmpListaAcoesPermissaoPadrao))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PADRAO&SysEntidadeAcao=DESATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_PADRAO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-unlink\"></i> <b>$SysRtl_Btn_Desativar</b></a>";

/* Permiss�o para o bot�o ativar */
$btn_ativar = "";
if (!$VAR_PADRAO_REG_ATIVO)
  if (in_array('ATIVAR', $tmpListaAcoesPermissaoPadrao))
    $btn_ativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PADRAO&SysEntidadeAcao=ATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_PADRAO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Ativar</b></a>";

/* Permiss�o para o bot�o editar */
$btn_editar = "";
if (in_array('ALTERAR', $tmpListaAcoesPermissaoPadrao))
  $btn_editar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PADRAO&SysEntidadeAcao=ALTERAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO','FORM_PADRAO_CONSULTAR')\"><i class=\"fa fa-edit\"></i> <b>$SysRtl_Btn_Editar</b></a>";

/* Permiss�o para o bot�o novo */
$btn_novo = "";
if (in_array('INCLUIR', $tmpListaAcoesPermissaoPadrao))
  $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PADRAO&SysEntidadeAcao=INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";

/* Permiss�o para o bot�o pesquisar */
$btn_pesquisar = "";
if (in_array('PESQUISAR', $tmpListaAcoesPermissaoPadrao))
  $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PADRAO&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";

unset($PERMISSAO_);
// -------------------- EXIBI��O DO FORMULARIO -----------------//

/* Layout do Formul�rio */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_PADRAO\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Padrao_Consultar_Conteudo_Titulo</h3>
      
      <div class=\"btn-group pull-right\">
        $btn_excluir
        $btn_desativar
        $btn_ativar
        $btn_editar
        $btn_novo
        $btn_pesquisar
      </div>
      
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_PADRAO_CONSULTAR\" name=\"FORM_PADRAO_CONSULTAR\" onSubmit=\"\">
        <input type=\"hidden\" id=\"SysEntidade\" name=\"SysEntidade\" value=\"PADRAO\">
        <input type=\"hidden\" id=\"SysEntidadeAcao\" name=\"SysEntidadeAcao\" value=\"ALTERAR\">
        <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"$VAR_PADRAO_CODIGO\">
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_NOME</label>
          <div class=\"col-sm-9\">
            <b class=\"form-control\">$VAR_PADRAO_NOME</b>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_TIPO\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_TIPO</label>
          <div class=\"col-sm-9\">
            <b class=\"form-control\">$VAR_PADRAO_TIPO</b>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_DATA\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_DATA</label>
          <div class=\"col-sm-9\">
            <b class=\"form-control\">$VAR_PADRAO_DATA</b>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_VALOR\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_VALOR</label>
          <div class=\"col-sm-9\">
            <b class=\"form-control\">$VAR_PADRAO_VALOR</b>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_ESCOLHA\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_ESCOLHA</label>
          <div class=\"col-sm-9\">
            <b class=\"form-control\">$VAR_PADRAO_ESCOLHA</b>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_DESCRICAO\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_DESCRICAO</label>
          <div class=\"col-sm-9\">
            <b class=\"form-control\">$VAR_PADRAO_DESCRICAO</b>
          </div>
        </div>
        $VAR_REGISTRO_INATIVO
        </div>
        <div class=\"box-footer\">
          <div class=\"col-sm-offset-5 col-sm-7\" id=\"DIV_LOG_INFO\">
            $tmpLogVer
          </div>
          <di class=\"col-sm-9\" >
          </di>
        </div>
      </form>        
    </div>
  </div>
</div>";

/* Layout JavaScript para manipula��o do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Padrao_Consultar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Padrao_Consultar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Padrao_Consultar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Padrao_Consultar_Cabecalho_Icone\"></i> $SysRtl_Padrao_Consultar_Cabecalho_Titulo</a>';
</script>";


/*
$this->SISTEMA_['SAIDA']['FORMULARIO']['COMPONENTES']['LBL_TITULO']['TEXT'] = $Conteudo_Titulo;
$this->SISTEMA_['SAIDA']['FORMULARIO']['COMPONENTES']['LBL_SUBTITULO']['TEXT'] = $Conteudo_Subtitulo;
$this->SISTEMA_['SAIDA']['FORMULARIO']['COMPONENTES']['LBL_SUBTITULO_LOCAL']['TEXT'] = $Conteudo_Subtitulo;
$this->SISTEMA_['SAIDA']['FORMULARIO']['COMPONENTES']['LBL_ARVORE_LOCAL']['TEXT'] = $Conteudo_ArvoreLocal;
$this->SISTEMA_['SAIDA']['FORMULARIO']['BTNGRUPO']['LBL_ARVORE_LOCAL']['TEXT'] = $Conteudo_ArvoreLocal;
$this->SISTEMA_['SAIDA']['FORMULARIO']['FORM']['LBL_ARVORE_LOCAL']['TEXT'] = $Conteudo_ArvoreLocal;

*/