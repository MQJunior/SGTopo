<?php

$Conteudo_Titulo = "Sistema";
$Conteudo_Subtitulo = "Usuários";
$Conteudo_Icone = "fa-user";
$Conteudo_ArvoreLocal = "<a href=\"javascript::;\"><i class=\"fa $Conteudo_Icone\"></i> $Conteudo_Titulo</a>";

$this->SISTEMA_['SAIDA']['EXIBIR'] = 
"   <div class=\"col-md-12\">
      <div class=\"box box-$SistemaLayoutCor\">
        <div class=\"box-header\">
          <h3 class=\"box-title\">Pesquisa de Usuários</h3>
        </div><!-- /.box-header -->
        <div class=\"box-body\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_USUARIO_PESQUISAR\" name=\"FORM_USUARIO_PESQUISAR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID ."','','TABELA_USUARIO_PESQUISAR_DADOS','FORM_USUARIO_PESQUISAR')\">
            <input type=\"hidden\" name=\"SysEntidade\" value=\"USUARIO\">
            <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"PESQUISAR\">
            <div class=\"form-group\">
              <div class=\"col-sm-4\">
                <a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor btn-flat pull-left\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID ."&SysEntidade=USUARIO&SysEntidadeAcao=INCLUIR','','DIV_CONTEUDO',null)\">Novo Usuário</a>
              </div>
              <div class=\"col-sm-8\">
                <div class=\"input-group input-group-sm\">
                  <input type=\"text\" class=\"form-control\" name=\"TXT_USUARIO_PESQUISAR\" ID=\"TXT_USUARIO_PESQUISAR\">
                  <span class=\"input-group-btn\">
                    <button class=\"btn btn-$SistemaLayoutCor btn-flat\" type=\"submit\">Buscar</button>
                  </span>
                </div>
              </div>
            </div>
          </form>
          
          <div class=\"form-group\">
            <table id=\"TABELA_USUARIO_PESQUISAR\" class=\"table table-hover\" >
              <thead>
                <tr>
                  <th>Usuário</th>
                  <th>E-mail</th>
                  <th>Data Cadastro</th>
                  <th>Usuário Criou</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id=\"TABELA_USUARIO_PESQUISAR_DADOS\">
              ";
              if(!empty($VAR_USUARIO_LISTAR)){
                foreach($VAR_USUARIO_LISTAR as $VAR_LISTAR_DADOS){
                $tmpStatusREG_ATIVO = "Bloqueado";
                $tmpStatusREG_ATIVO_stilo="";
                if($VAR_LISTAR_DADOS['REG_ATIVO']==1){
                  $tmpStatusREG_ATIVO = "Ativo";
                }else{
                  $tmpStatusREG_ATIVO_stilo="class=\"text-yellow\"";
                  $tmpStatusREG_ATIVO = "Bloqueado";
                }
                $tmpCODIGO = $VAR_LISTAR_DADOS['CODIGO'];
                $this->SISTEMA_['SAIDA']['EXIBIR'] .= " <tr $tmpStatusREG_ATIVO_stilo onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID ."&SysEntidade=USUARIO&SysEntidadeAcao=CONSULTAR&txtChaveRegistro=".$tmpCODIGO."','','DIV_CONTEUDO',null)\">
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
                
$this->SISTEMA_['SAIDA']['EXIBIR'] .="</tbody>
                
            </table>
          </div> <!-- fim da tabela -->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
";

$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$Conteudo_Titulo';
  LBL_SUBTITULO.innerText='$Conteudo_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$Conteudo_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='$Conteudo_ArvoreLocal';
</script>";
?>