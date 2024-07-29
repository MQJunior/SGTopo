<?php

$VAR_ENTIDADEACAO_ACAO_CODIGO = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['CODIGO'];
$VAR_ENTIDADEACAO_ACAO_ENTIDADE = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['ENTIDADE'];
$VAR_ENTIDADEACAO_ACAO_NOME = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['NOME'];
$VAR_ENTIDADEACAO_ACAO_NIVEL = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['NIVEL'];
$VAR_ENTIDADEACAO_ACAO_RESTRITO = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['RESTRITO'];
($VAR_ENTIDADEACAO_ACAO_RESTRITO==0)?$tmpRestrito="":$tmpRestrito=" checked";

$VAR_ENTIDADEACAO_ENTIDADE_BIN_LOCAL = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_BIN_LOCAL'];
$VAR_ENTIDADEACAO_ENTIDADE_BIN_ARQUIVO_LISTA = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_BIN_ARQUIVO_LISTA'];

$VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_LOCAL = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_LOCAL'];
$VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_ARQUIVO_LISTA = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_ARQUIVO_LISTA'];

$VAR_ENTIDADEACAO_ACAO_ENTIDADE = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_NOME'];

$this->SISTEMA_['SAIDA']['EXIBIR'] = 
" <div class=\"col-md-6\">
      <div class=\"box box-$SistemaLayoutCor\">
        <div class=\"box-header with-border\">
          <h3 class=\"box-title\">Consultar Ação</h3>
          <button type=\"button\" class=\"btn btn-$SistemaLayoutCor pull-right\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=LISTAR_ACAO&TXT_ENTIDADEACAO_ENTIDADE_NOME=".$VAR_ENTIDADEACAO_ACAO_ENTIDADE."','','DIV_ENTIDADEACAO_ACAO',null)\" >Listar</button>
        </div>
        <div class=\"box-body\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_ENTIDADEACAO_ENTIDADE_ALTERAR\" name=\"FORM_ENTIDADEACAO_ENTIDADE_ALTERAR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID ."','','DIV_ENTIDADEACAO_ACAO','FORM_ENTIDADEACAO_ENTIDADE_ALTERAR')\">
            <input type=\"hidden\" name=\"SysEntidade\" value=\"ENTIDADEACAO\">
            <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"ALTERAR_ACAO\">
            <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"".$VAR_ENTIDADEACAO_ACAO_CODIGO."\">
            <div class=\"form-group\">
            <label for=\"TXT_ENTIDADEACAO_ACAO_ENTIDADE\" class=\"col-sm-4 control-label\">Entidade</label>
              <div class=\"col-sm-7\">
                <input type=\"text\" class=\"form-control\" id=\"TXT_ENTIDADEACAO_ACAO_ENTIDADE\" placeholder=\"Name\" name=\"TXT_ENTIDADEACAO_ACAO_ENTIDADE\" value=\"".$VAR_ENTIDADEACAO_ACAO_ENTIDADE."\" required readonly>
              </div>
            </div>
            <div class=\"form-group\">
              <label for=\"TXT_ENTIDADEACAO_ACAO_NOME\" class=\"col-sm-4 control-label\">Nome da Ação</label>
              <div class=\"col-sm-7\">
                <input type=\"text\" class=\"form-control\" id=\"TXT_ENTIDADEACAO_ACAO_NOME\" placeholder=\"Name\" name=\"TXT_ENTIDADEACAO_ACAO_NOME\" value=\"".$VAR_ENTIDADEACAO_ACAO_NOME."\" required readonly>
              </div>
            </div>
            <div class=\"form-group\">
              <label for=\"TXT_ENTIDADEACAO_ACAO_NIVEL\" class=\"col-sm-4 control-label\">Nível</label>
              <div class=\"col-sm-2\">
                <input type=\"text\" class=\"form-control\" id=\"TXT_ENTIDADEACAO_ACAO_NIVEL\" placeholder=\"Name\" name=\"TXT_ENTIDADEACAO_ACAO_NIVEL\" value=\"".$VAR_ENTIDADEACAO_ACAO_NIVEL."\" maxlength=\"1\" required>
              </div>
              <label for=\"TXT_ENTIDADEACAO_ACAO_RESTRITO\" class=\"col-sm-2 control-label\">Restrito</label>
              <div class=\"col-sm-1\">
                <input type=\"checkbox\"  id=\"TXT_ENTIDADEACAO_ACAO_RESTRITO\"  name=\"TXT_ENTIDADEACAO_ACAO_RESTRITO\" ".$tmpRestrito.">
              </div>
            </div>
            
            <div class=\"form-group\">
              <div class=\"col-sm-offset-3 col-sm-9\">
              <button type=\"submit\" class=\"btn btn-$SistemaLayoutCor\" >Salvar</button>
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
                      <ul>
                      ";
                    if(!empty($VAR_ENTIDADEACAO_ENTIDADE_BIN_ARQUIVO_LISTA)){
                      foreach($VAR_ENTIDADEACAO_ENTIDADE_BIN_ARQUIVO_LISTA as $tmp_BinArquivoLista)
                        $this->SISTEMA_['SAIDA']['EXIBIR'] .="<li><a href=\"javascript::;\">".basename($tmp_BinArquivoLista)."</a> 
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=VISUALIZAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmp_BinArquivoLista."','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-eye\"></i></a>&nbsp;
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=EDITAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmp_BinArquivoLista."','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-pencil-square\"></i></a>&nbsp;
                                                              </li>";
                    }else{
                      $tmpArquivo =strtolower($VAR_ENTIDADEACAO_ACAO_ENTIDADE).".".strtolower(str_replace("_",".",$VAR_ENTIDADEACAO_ACAO_NOME)).".bin.php";
                      $tmpEnderecoArquivo = $VAR_ENTIDADEACAO_ENTIDADE_BIN_LOCAL.$tmpArquivo;
                      $this->SISTEMA_['SAIDA']['EXIBIR'] .="<li><a href=\"javascript::;\">Criar Arquivo: ".$tmpArquivo."</a> 
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=CRIAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmpEnderecoArquivo."','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-file-code-o\"></i></a>&nbsp;
                                                              </li>";
                    }    
$this->SISTEMA_['SAIDA']['EXIBIR'] .="                      </ul>
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
                      <ul>
                      ";
                      
                    if(!empty($VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_ARQUIVO_LISTA)){
                      foreach($VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_ARQUIVO_LISTA as $tmp_LayoutArquivoLista)
                        $this->SISTEMA_['SAIDA']['EXIBIR'] .="<li><a href=\"javascript::;\">".basename($tmp_LayoutArquivoLista)."</a> 
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=VISUALIZAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmp_LayoutArquivoLista."','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-eye\"></i></a>&nbsp;
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=EDITAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmp_LayoutArquivoLista."','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-pencil-square\"></i></a>&nbsp;
                                                              </li>";
                    }else{
                      $tmpArquivo =strtolower($VAR_ENTIDADEACAO_ACAO_ENTIDADE).".".strtolower(str_replace("_",".",$VAR_ENTIDADEACAO_ACAO_NOME)).".layout.php";
                      $tmpEnderecoArquivo = $VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_LOCAL.$tmpArquivo;
                      $this->SISTEMA_['SAIDA']['EXIBIR'] .="<li><a href=\"javascript::;\">Criar Arquivo: ".$tmpArquivo."</a> 
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=CRIAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmpEnderecoArquivo."','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-file-code-o\"></i></a>&nbsp;
                                                              </li>";
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

?>