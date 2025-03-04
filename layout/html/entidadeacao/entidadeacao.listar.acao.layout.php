<?php
if (isset($this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['DADOS'])){
  $VAR_ENTIDADEACAO_ACAO_LISTA = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['DADOS'];
  $VAR_ENTIDADEACAO_ENTIDADE_BIN_LOCAL = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_BIN_LOCAL'];
  $VAR_ENTIDADEACAO_ENTIDADE_BIN_ARQUIVO_LISTA = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_BIN_ARQUIVO_LISTA'];
  $tmpDirBinExiste="";
  if(file_exists($VAR_ENTIDADEACAO_ENTIDADE_BIN_LOCAL))
    $VAR_ENTIDADEACAO_ENTIDADE_BIN_LOCAL .="&nbsp;<i class=\"fa fa-folder\"></i>";
  else{
    $VAR_ENTIDADEACAO_ENTIDADE_BIN_LOCAL .=" <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=CRIAR_DIRETORIO&TXT_ENTIDADEACAO_DIRETORIO_NOME=".$VAR_ENTIDADEACAO_ENTIDADE_BIN_LOCAL."','',null,null);TXT_ENTIDADEACAO_ENTIDADE_NOME.onchange();\" ><i class=\"fa fa-folder-o\"></i>Criar Diretório";  
    $tmpDirBinExiste="disabled";
  }
    
  $VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_LOCAL = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_LOCAL'];
  $VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_ARQUIVO_LISTA = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_ARQUIVO_LISTA'];
  (file_exists($VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_LOCAL))?$VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_LOCAL .="&nbsp;<i class=\"fa fa-folder\"></i>":$VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_LOCAL .=" <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=CRIAR_DIRETORIO&TXT_ENTIDADEACAO_DIRETORIO_NOME=".$VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_LOCAL."','','DIV_ENTIDADEACAO_ACAO',null);TXT_ENTIDADEACAO_ENTIDADE_NOME.onchange();\" ><i class=\"fa fa-folder-o\"></i>Criar Diretório";  
  
  $VAR_ENTIDADEACAO_ACAO_ENTIDADE = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_NOME'];
}
if(isset($VAR_ENTIDADEACAO_ACAO_LISTA)){
  $this->SISTEMA_['SAIDA']['EXIBIR'] = 
" <div  id=\"DIV_ENTIDADEACAO_ACAO\">
    <div class=\"col-md-6\">
      <div class=\"box box-$SistemaLayoutCor\">
        <div class=\"box-header with-border\">
          <h3 class=\"box-title\">Ações da Entidade</h3>
          <button type=\"button\" class=\"btn btn-$SistemaLayoutCor pull-right\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=INCLUIR_ACAO&TXT_ENTIDADEACAO_ACAO_ENTIDADE=".$VAR_ENTIDADEACAO_ACAO_ENTIDADE."','','DIV_ENTIDADEACAO_ACAO',null)\" ".$tmpDirBinExiste." >Criar Ação</button>
        </div>
        <div class=\"box-body\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_ENTIDADEACAO_ACAO_PESQUISAR\" name=\"FORM_ENTIDADEACAO_ACAO_PESQUISAR\" >
            <input type=\"hidden\" name=\"SysEntidade\" value=\"ENTIDADEACAO\">
            <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"CONSULTAR_ACAO\">
            <div class=\"form-group\">
                <label for=\"txtChaveRegistro\" class=\"col-sm-3 control-label\">Ação</label>
                <div class=\"col-sm-8\">
                    <select class=\"form-control\" id=\"txtChaveRegistro\" name=\"txtChaveRegistro\" placeholder=\"Escolha\" required onChange=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."','','DIV_ENTIDADEACAO_ACAO','FORM_ENTIDADEACAO_ACAO_PESQUISAR')\">
                      <option>Todas</option>
                    ";
                        if(is_array($VAR_ENTIDADEACAO_ACAO_LISTA))
                          foreach ($VAR_ENTIDADEACAO_ACAO_LISTA as $tmp_Select){
                                $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<option value=\"".$tmp_Select['CODIGO']."\" >".$tmp_Select['NOME']."</option>";
                          }  
                        
$this->SISTEMA_['SAIDA']['EXIBIR'] .=                    "</select>
                </div>
              </div>
               <div class=\"box-header with-border\">
                  <i class=\"fa fa-file-code-o\"></i>
                  <h4 class=\"box-title\">Arquivos</h4>
              </div>
              <div id=\"DIV_ENTIDADEACAO_ACAO_ARQUIVOS_BIN\">
                <div class=\"panel box box-$SistemaLayoutCor\">
                  <div class=\"box-header with-border\">
                    <h4 class=\"box-title\">
                      <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#DIV_ENTIDADE_ACAO_ARQUIVO_BIN\" aria-expanded=\"true\" class=\"\">
                        Binários
                      </a>
                        <h6>".$VAR_ENTIDADEACAO_ENTIDADE_BIN_LOCAL."</h6>
                    </h4>
                  </div>
                  <div id=\"DIV_ENTIDADE_ACAO_ARQUIVO_BIN\" class=\"panel-collapse collapse in\" aria-expanded=\"true\" style=\"\">
                    <div class=\"box-body\">
                      
                      ";
                    if(is_array($VAR_ENTIDADEACAO_ENTIDADE_BIN_ARQUIVO_LISTA)){
                      $this->SISTEMA_['SAIDA']['EXIBIR'] .="                      <ul>";
                      foreach($VAR_ENTIDADEACAO_ENTIDADE_BIN_ARQUIVO_LISTA as $tmp_BinArquivoLista)
                        $this->SISTEMA_['SAIDA']['EXIBIR'] .="<li><a href=\"javascript::;\">".basename($tmp_BinArquivoLista)."</a> 
                                                                <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=VISUALIZAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmp_BinArquivoLista."','','DIV_CONTEUDO_AUXILIAR',null,null)\" ><i class=\"fa fa-eye\"></i></a>
                                                         
       <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=EDITAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmp_BinArquivoLista."','','DIV_CONTEUDO_AUXILIAR',null,null)\" ><i class=\"fa fa-pencil-square\"></i></a>
                                                              </li>";
                      $this->SISTEMA_['SAIDA']['EXIBIR'] .="                      </ul>";
                    }    
$this->SISTEMA_['SAIDA']['EXIBIR'] .="
                    </div>
                  </div>
                </div>
              </div>
              <div id=\"DIV_ENTIDADEACAO_ACAO_ARQUIVOS_LAYOUT\">
                <div class=\"panel box box-$SistemaLayoutCor\">
                  <div class=\"box-header with-border\">
                    <h4 class=\"box-title\">
                      <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#DIV_ENTIDADE_ACAO_ARQUIVO_LAYOUT\" aria-expanded=\"true\" class=\"\">
                        Layout
                      </a>
                        <h6>".$VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_LOCAL."</h6>
                    </h4>
                  </div>
                  <div id=\"DIV_ENTIDADE_ACAO_ARQUIVO_LAYOUT\" class=\"panel-collapse collapse in\" aria-expanded=\"true\" style=\"\">
                    <div class=\"box-body\">
                      ";
                  if(is_array($VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_ARQUIVO_LISTA)){
                    $this->SISTEMA_['SAIDA']['EXIBIR'] .="                      <ul>";
                      foreach($VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_ARQUIVO_LISTA as $tmp_LayoutArquivoLista)
                        $this->SISTEMA_['SAIDA']['EXIBIR'] .="<li><a href=\"javascript::;\">".basename($tmp_LayoutArquivoLista)."</a> 
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=VISUALIZAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmp_LayoutArquivoLista."','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-eye\"></i></a>
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=EDITAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmp_LayoutArquivoLista."','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-pencil-square\"></i></a> 
                                                              </li>";
                    $this->SISTEMA_['SAIDA']['EXIBIR'] .="                      </ul>";
                  }     
$this->SISTEMA_['SAIDA']['EXIBIR'] .="                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </form> 
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
   </div> 
";
}else{
  $this->SISTEMA_['SAIDA']['EXIBIR'] = "Ã‚Â ";
}
?>