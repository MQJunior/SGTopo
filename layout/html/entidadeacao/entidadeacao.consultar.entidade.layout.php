<?php
$this->SISTEMA_['SAIDA']['EXIBIR'] ="";

$VAR_ENTIDADEACAO_ENTIDADE_CLASSE_LOCAL = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_CLASSE_LOCAL'];
$VAR_ENTIDADEACAO_ENTIDADE_CLASSE_ARQUIVO = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_CLASSE_ARQUIVO'];
if (!file_exists($VAR_ENTIDADEACAO_ENTIDADE_CLASSE_LOCAL.$VAR_ENTIDADEACAO_ENTIDADE_CLASSE_ARQUIVO))
  $VAR_ENTIDADEACAO_ENTIDADE_CLASSE_ARQUIVO=null;

(file_exists($VAR_ENTIDADEACAO_ENTIDADE_CLASSE_LOCAL))?$VAR_ENTIDADEACAO_ENTIDADE_CLASSE_LOCAL_EXISTE =$VAR_ENTIDADEACAO_ENTIDADE_CLASSE_LOCAL." <i class=\"fa fa-folder\"></i>":$VAR_ENTIDADEACAO_ENTIDADE_CLASSE_LOCAL .=" <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=CRIAR_DIRETORIO&TXT_ENTIDADEACAO_DIRETORIO_NOME=".$VAR_ENTIDADEACAO_ENTIDADE_CLASSE_LOCAL."','','DIV_CONTEUDO',null);sleep(500);TXT_ENTIDADEACAO_ENTIDADE_NOME.onchange();\" ><i class=\"fa fa-folder-o\"></i>Criar Diretório";

$VAR_ENTIDADEACAO_ENTIDADE_CONF_LOCAL = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_CONF_LOCAL'];
$VAR_ENTIDADEACAO_ENTIDADE_CONF_ARQUIVO = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_CONF_ARQUIVO'];
if (!file_exists($VAR_ENTIDADEACAO_ENTIDADE_CONF_LOCAL.$VAR_ENTIDADEACAO_ENTIDADE_CONF_ARQUIVO))
  $VAR_ENTIDADEACAO_ENTIDADE_CONF_ARQUIVO=null;

(file_exists($VAR_ENTIDADEACAO_ENTIDADE_CONF_LOCAL))?$VAR_ENTIDADEACAO_ENTIDADE_CONF_LOCAL_EXISTE =$VAR_ENTIDADEACAO_ENTIDADE_CONF_LOCAL." <i class=\"fa fa-folder\"></i>":$VAR_ENTIDADEACAO_ENTIDADE_CONF_LOCAL_EXISTE = $VAR_ENTIDADEACAO_ENTIDADE_CONF_LOCAL." <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=CRIAR_DIRETORIO&TXT_ENTIDADEACAO_DIRETORIO_NOME=".$VAR_ENTIDADEACAO_ENTIDADE_CONF_LOCAL."','','DIV_CONTEUDO',null);sleep(500);TXT_ENTIDADEACAO_ENTIDADE_NOME.onchange();\" ><i class=\"fa fa-folder-o\"></i>Criar Diretório";  
  
$VAR_ENTIDADEACAO_ENTIDADE_DEF_LOCAL = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_DEF_LOCAL'];
$VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO'];
$VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO_LISTA = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO_LISTA'];
if (!file_exists($VAR_ENTIDADEACAO_ENTIDADE_DEF_LOCAL.$VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO))
  $VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO=null;

$VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO_IDIOMA = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO_IDIOMA'];
  
(file_exists($VAR_ENTIDADEACAO_ENTIDADE_DEF_LOCAL))?$VAR_ENTIDADEACAO_ENTIDADE_DEF_LOCAL_EXISTE =$VAR_ENTIDADEACAO_ENTIDADE_DEF_LOCAL." <i class=\"fa fa-folder\"></i>":$VAR_ENTIDADEACAO_ENTIDADE_DEF_LOCAL_EXISTE =$VAR_ENTIDADEACAO_ENTIDADE_DEF_LOCAL." <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=CRIAR_DIRETORIO&TXT_ENTIDADEACAO_DIRETORIO_NOME=".$VAR_ENTIDADEACAO_ENTIDADE_DEF_LOCAL."','','DIV_CONTEUDO',null);sleep(500);TXT_ENTIDADEACAO_ENTIDADE_NOME.onchange();\" ><i class=\"fa fa-folder-o\"></i>Criar Diretório";  




$VAR_ENTIDADEACAO_ENTIDADE_NOME="";
if(isset($this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['NOME']))
  $VAR_ENTIDADEACAO_ENTIDADE_NOME =$this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['NOME'];
if($VAR_ENTIDADEACAO_ENTIDADE_NOME!=""){
  $VAR_ENTIDADEACAO_ENTIDADE_TABELA = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['TABELA'];
  $this->SISTEMA_['SAIDA']['EXIBIR'] = 
" <div class=\"form-group\">
                <label for=\"TXT_ENTIDADEACAO_ENTIDADE_TABELA\" class=\"col-sm-3 control-label\">Tabela BD</label>
                <div class=\"col-sm-8\">
                  <input type=\"text\" class=\"form-control\" id=\"TXT_ENTIDADEACAO_ENTIDADE_TABELA\" placeholder=\"Name\" name=\"TXT_ENTIDADEACAO_ENTIDADE_TABELA\" value=\"".$VAR_ENTIDADEACAO_ENTIDADE_TABELA."\" readonly>
                </div>
              </div>
              <div class=\"box-header with-border\">
                  <i class=\"fa fa-file-code-o\"></i>
                  <h4 class=\"box-title\">Arquivos</h4>
              </div>
              
              <div class=\"panel box box-$SistemaLayoutCor\">
                <div class=\"box-header with-border\">
                  <h4 class=\"box-title\">
                    <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#DIV_ENTIDADE_ACAO_ARQUIVO_CLASS\" aria-expanded=\"true\" class=\"\">
                      Classe
                    </a>
                      <h6>".$VAR_ENTIDADEACAO_ENTIDADE_CLASSE_LOCAL_EXISTE."</h6>
                  </h4>
                </div>
                <div id=\"DIV_ENTIDADE_ACAO_ARQUIVO_CLASS\" class=\"panel-collapse collapse in\" aria-expanded=\"true\" style=\"\">
                  <div class=\"box-body\">";
                      if($VAR_ENTIDADEACAO_ENTIDADE_CLASSE_ARQUIVO!=null){
                        $tmp_ArquivoClass=$VAR_ENTIDADEACAO_ENTIDADE_CLASSE_LOCAL.$VAR_ENTIDADEACAO_ENTIDADE_CLASSE_ARQUIVO;
                        $this->SISTEMA_['SAIDA']['EXIBIR'] .="<ul>
                                                                <li><a href=\"javascript::;\">".$VAR_ENTIDADEACAO_ENTIDADE_CLASSE_ARQUIVO."</a> 
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=VISUALIZAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmp_ArquivoClass."','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-eye\"></i></a>&nbsp;
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=EDITAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmp_ArquivoClass."','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-pencil-square\"></i></a>&nbsp;
                                                                </li>
                                                              </ul>";
                      }else{
                        $tmpArquivo = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_CLASSE_ARQUIVO'];
                        $tmpArquivoLocal = $VAR_ENTIDADEACAO_ENTIDADE_CLASSE_LOCAL.$this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_CLASSE_ARQUIVO'];
                        $this->SISTEMA_['SAIDA']['EXIBIR'] .="<ul>
                                                                <li><a href=\"javascript::;\">Criar Arquivo: ".$tmpArquivo."</a> 
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=CRIAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmpArquivoLocal."','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-file-code-o\"></i></a>&nbsp;
                                                                </li>
                                                              </ul>";
                      }
                    $this->SISTEMA_['SAIDA']['EXIBIR'] .= "
                  </div>
                </div>
              </div>
              <div class=\"panel box box-$SistemaLayoutCor\">
                <div class=\"box-header with-border\">
                  <h4 class=\"box-title\">
                    <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#DIV_ENTIDADE_ACAO_ARQUIVO_CONF\" aria-expanded=\"true\" class=\"\">
                      Configuração
                    </a>
                      <h6>".$VAR_ENTIDADEACAO_ENTIDADE_CONF_LOCAL_EXISTE."</h6>
                  </h4>
                </div>
                <div id=\"DIV_ENTIDADE_ACAO_ARQUIVO_CONF\" class=\"panel-collapse collapse in\" aria-expanded=\"true\" style=\"\">
                  <div class=\"box-body\">";
                      if($VAR_ENTIDADEACAO_ENTIDADE_CONF_ARQUIVO!=null){
                        $tmp_ArquivoConf=$VAR_ENTIDADEACAO_ENTIDADE_CONF_LOCAL.$VAR_ENTIDADEACAO_ENTIDADE_CONF_ARQUIVO;
                        $this->SISTEMA_['SAIDA']['EXIBIR'] .="<ul>
                                                                <li><a href=\"javascript::;\">".$VAR_ENTIDADEACAO_ENTIDADE_CONF_ARQUIVO."</a> 
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=VISUALIZAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmp_ArquivoConf."','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-eye\"></i></a>&nbsp;
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=EDITAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmp_ArquivoConf."','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-pencil-square\"></i></a>&nbsp;
                                                                </li>
                                                              </ul>";
                      }else{
                        $tmpArquivo = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_CONF_ARQUIVO'];
                        $tmpArquivoLocal = $VAR_ENTIDADEACAO_ENTIDADE_CONF_LOCAL.$this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_CONF_ARQUIVO'];
                        $this->SISTEMA_['SAIDA']['EXIBIR'] .="<ul>
                                                                <li><a href=\"javascript::;\">Criar Arquivo: ".$tmpArquivo."</a> 
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=CRIAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmpArquivoLocal."','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-file-code-o\"></i></a>&nbsp;
                                                                </li>
                                                              </ul>";
                      }
                    $this->SISTEMA_['SAIDA']['EXIBIR'] .= "
                  </div>
                </div>
              </div>
              <div class=\"panel box box-$SistemaLayoutCor\">
                <div class=\"box-header with-border\">
                  <h4 class=\"box-title\">
                    <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#DIV_ENTIDADE_ACAO_ARQUIVO_DEF\" aria-expanded=\"true\" class=\"\">
                      Definições
                    </a>
                      <h6>".$VAR_ENTIDADEACAO_ENTIDADE_DEF_LOCAL_EXISTE."</h6>
                  </h4>
                </div>
                <div id=\"DIV_ENTIDADE_ACAO_ARQUIVO_DEF\" class=\"panel-collapse collapse in\" aria-expanded=\"true\" style=\"\">
                  <div class=\"box-body\">";
                      if($VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO!=null){
                        $tmp_ArquivoDef=$VAR_ENTIDADEACAO_ENTIDADE_DEF_LOCAL.$VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO;
                        $this->SISTEMA_['SAIDA']['EXIBIR'] .="<ul>
                                                                <li><a href=\"javascript::;\">".$VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO."</a> 
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=VISUALIZAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmp_ArquivoDef."','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-eye\"></i></a>&nbsp;
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=EDITAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmp_ArquivoDef."','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-pencil-square\"></i></a>&nbsp;
                                                                </li>
                                                              </ul>";
                      }else{
                        $tmpArquivo = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO'];
                        $tmpArquivoLocal = $VAR_ENTIDADEACAO_ENTIDADE_DEF_LOCAL.$this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO'];
                        $this->SISTEMA_['SAIDA']['EXIBIR'] .="<ul>
                                                                <li><a href=\"javascript::;\">Criar Arquivo: ".$tmpArquivo."</a> 
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=CRIAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmpArquivoLocal."','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-file-code-o\"></i></a>&nbsp;
                                                                </li>
                                                              </ul>";
                      }
                    if(is_array($VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO_IDIOMA)){ 
                      $this->SISTEMA_['SAIDA']['EXIBIR'] .="                      <ul>";
                      foreach($VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO_IDIOMA as $tmp_DefArquivoIdiomas){
                        $tmpArquivoIdioma = $VAR_ENTIDADEACAO_ENTIDADE_DEF_LOCAL.$tmp_DefArquivoIdiomas;
                        if(file_exists($tmpArquivoIdioma)){
                          $this->SISTEMA_['SAIDA']['EXIBIR'] .="<li><a href=\"javascript::;\">".basename($tmpArquivoIdioma)."</a> 
                          <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=VISUALIZAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmpArquivoIdioma."','','DIV_CONTEUDO_AUXILIAR',null,null)\" ><i class=\"fa fa-eye\"></i></a>
                          
                          <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=EDITAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=".$tmpArquivoIdioma."','','DIV_CONTEUDO_AUXILIAR',null,null)\" ><i class=\"fa fa-pencil-square\"></i></a>
                                                                </li>";
                        }else{
                          $this->SISTEMA_['SAIDA']['EXIBIR'] .="
                                                                <li><a href=\"javascript::;\">Criar Arquivo: ".basename($tmpArquivoIdioma)."</a> 
                                                                  <a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=CRIAR_ARQUIVO&TXT_ENTIDADEACAO_ARQUIVO_NOME=$tmpArquivoIdioma','','DIV_CONTEUDO_AUXILIAR',null,false)\" ><i class=\"fa fa-file-code-o\"></i></a>&nbsp;
                                                                </li>";
                        }
                      }
                      $this->SISTEMA_['SAIDA']['EXIBIR'] .="                      </ul>";
                    }
                    $this->SISTEMA_['SAIDA']['EXIBIR'] .= "
                  </div>
                </div>
              </div>
";
}
$this->SISTEMA_['SAIDA']['EXIBIR'] .= 
"              <script>
                PesquisaDados('.?XMLHTML=true&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=LISTAR_ACAO&TXT_ENTIDADEACAO_ENTIDADE_NOME=".$VAR_ENTIDADEACAO_ENTIDADE_NOME."&SID=".$TMP_SESSAO_UID ."','','DIV_ENTIDADEACAO_ACOES_LISTAR','')
              </script>
";
?>