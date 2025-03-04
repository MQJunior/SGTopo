<?php
/*
$o=0;
$tmp_MODELO_MENU = array("NIVEL" =>++$ID,
                        "NOME"=>"NOME",
                        "COMANDO" => "COMANDO",
                        "ORDEM" =>$o,
                        "TIPO" => "MENU", // {MENU|TITULO}
                        "ICONE"=>"",
                        "ITENS" => null);
*/                        
///////////////////////////////////////////////////////////////////////////////////////////

/* MENU SISTEMA */
$ordem=0;
$VAR_MENU_SISTEMA_[] = array("NIVEL" =>2,"NOME"=>"Usuários","ENTIDADE" => "USUARIO", "ACAO"=>"PESQUISAR","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);
$VAR_MENU_SISTEMA_[] = array("NIVEL" =>2,"NOME"=>"Permissões","ENTIDADE" => "PERMISSAO", "ACAO"=>"PESQUISAR","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);
$VAR_MENU_SISTEMA_[] = array("NIVEL" =>2,"NOME"=>"Debug","ENTIDADE" => "SISTEMA", "ACAO"=>"DEBUG","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);
$VAR_MENU_SISTEMA = array("NIVEL" =>1,"NOME"=>"Sistema","ENTIDADE" => "","ORDEM" =>0,"TIPO" => "MENU","ICONE"=>"","ITENS" =>$VAR_MENU_SISTEMA_);


/* MENU CADASTRO */
$ordem=0;
$VAR_MENU_CADASTRO_[] = array("NIVEL" =>2,"NOME"=>"Clientes","ENTIDADE" => "CLIENTE", "ACAO"=>"PESQUISAR","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);
$VAR_MENU_CADASTRO_[] = array("NIVEL" =>2,"NOME"=>"Fornecedores","ENTIDADE" => "FORNECEDOR", "ACAO"=>"PESQUISAR","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);
$VAR_MENU_CADASTRO_[] = array("NIVEL" =>2,"NOME"=>"Colaboradores","ENTIDADE" => "COLABORADOR", "ACAO"=>"PESQUISAR","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);
$VAR_MENU_CADASTRO = array("NIVEL" =>1,"NOME"=>"Cadastros","ENTIDADE" => "","ORDEM" =>0,"TIPO" => "MENU","ICONE"=>"","ITENS" => $VAR_MENU_CADASTRO_);

/* MENU FINANCEIRO */
$ordem=0;
$VAR_MENU_FINANCEIRO_[] = array("NIVEL" =>2,"NOME"=>"Movimentos","ENTIDADE" => "FINANCEIRO", "ACAO"=>"MOVIMENTOS","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);
$VAR_MENU_FINANCEIRO_[] = array("NIVEL" =>2,"NOME"=>"Recebimentos","ENTIDADE" => "FINANCEIRO", "ACAO"=>"RECEBIMENTOS","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);
$VAR_MENU_FINANCEIRO_[] = array("NIVEL" =>2,"NOME"=>"Pagamentos","ENTIDADE" => "FINANCEIRO", "ACAO"=>"PAGAMENTOS","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);
$VAR_MENU_FINANCEIRO = array("NIVEL" =>1,"NOME"=>"Financeiro","ENTIDADE" => "","ORDEM" =>0,"TIPO" => "MENU","ICONE"=>"","ITENS" => $VAR_MENU_FINANCEIRO_ );  
  
/* MENU VENDA/ATENDIMENTO */
$ordem=0;
$VAR_MENU_ATENDIMENTO = array("NIVEL" =>1,"NOME"=>"Atendimento","ENTIDADE" => "ATENDIMENTO", "ACAO"=>"PESQUISAR" ,"ORDEM" =>0,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);  


/* MENU ESTOQUE */
$ordem=0;
$VAR_MENU_ESTOQUE_[] = array("NIVEL" =>2,"NOME"=>"Movimentos","ENTIDADE" => "ESTOQUE", "ACAO"=>"MOVIMENTOS","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);
$VAR_MENU_ESTOQUE_[] = array("NIVEL" =>2,"NOME"=>"Entradas","ENTIDADE" => "ESTOQUE", "ACAO"=>"ENTRADAS","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);
$VAR_MENU_ESTOQUE_[] = array("NIVEL" =>2,"NOME"=>"Saídas","ENTIDADE" => "ESTOQUE", "ACAO"=>"SAIDAS","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);
$VAR_MENU_ESTOQUE = array("NIVEL" =>1,"NOME"=>"Estoque","ENTIDADE" => "","ORDEM" =>0,"TIPO" => "MENU","ICONE"=>"","ITENS" => $VAR_MENU_ESTOQUE_); 

/* MENU RELATORIOS - FINANCEIRO */
$ordem=0;
$VAR_MENU_RELATORIO_FINANCEIRO_[] = array("NIVEL" =>3,"NOME"=>"Contas a receber","ENTIDADE" => "RELATORIO", "ACAO"=>"FINANCEIRO_CONTAS_RECEBER","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);
$VAR_MENU_RELATORIO_FINANCEIRO_[] = array("NIVEL" =>3,"NOME"=>"Contas a pagar","ENTIDADE" => "RELATORIO", "ACAO"=>"FINANCEIRO_CONTAS_PAGAR","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);
$VAR_MENU_RELATORIO_FINANCEIRO = array("NIVEL" =>2,"NOME"=>"Financeiro","ENTIDADE" => "","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => $VAR_MENU_RELATORIO_FINANCEIRO_);
  
/* MENU RELATORIOS - ESTOQUE */
$ordem=0;
$VAR_MENU_RELATORIO_ESTOQUE_[] = array("NIVEL" =>3,"NOME"=>"Entradas","ENTIDADE" => "RELATORIO", "ACAO"=>"ESTOQUE_ENTRADAS","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);
$VAR_MENU_RELATORIO_ESTOQUE_[] = array("NIVEL" =>3,"NOME"=>"Saídas","ENTIDADE" => "RELATORIO", "ACAO"=>"ESTOQUE_SAIDAS","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);
$VAR_MENU_RELATORIO_ESTOQUE = array("NIVEL" =>2,"NOME"=>"Estoque","ENTIDADE" => "","ORDEM" =>$ordem++,"TIPO" => "MENU","ICONE"=>"","ITENS" => $VAR_MENU_RELATORIO_ESTOQUE_); 
  
/* MENU RELATORIOS */
$ordem=0;
$VAR_MENU_RELATORIO = array("NIVEL" =>1,"NOME"=>"Relatórios","ENTIDADE" => "","ORDEM" =>0,"TIPO" => "MENU","ICONE"=>"","ITENS" => 
array($VAR_MENU_RELATORIO_FINANCEIRO
      ,$VAR_MENU_RELATORIO_ESTOQUE));   

/* MENU MENSAGENS */
$ordem=0;
$VAR_MENU_MENSAGENS = array("NIVEL" =>1,"NOME"=>"Mensagens","ENTIDADE" => "MENSAGEM", "ACAO"=>"LISTAR","ORDEM" =>0,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);  

/* MENU DOCUMENTAÇÃO */
$ordem=0;
$VAR_MENU_DOCUMENTACAO = array("NIVEL" =>1,"NOME"=>"Documentação","ENTIDADE" => "SISTEMA", "ACAO"=>"DOCUMENTACAO","ORDEM" =>0,"TIPO" => "MENU","ICONE"=>"","ITENS" => null);  

/* MENU PRINCIPAL */
$VAR_MENU_PRINCIPAL = array("NIVEL" =>0,"NOME"=>"MENU PRINCIPAL","ENTIDADE" => "","ORDEM" =>0,"TIPO" => "TITULO","ICONE"=>"","ITENS" => 
            array($VAR_MENU_SISTEMA
                ,$VAR_MENU_CADASTRO
                ,$VAR_MENU_FINANCEIRO
                ,$VAR_MENU_ATENDIMENTO
                ,$VAR_MENU_ESTOQUE
                ,$VAR_MENU_RELATORIO
                ,$VAR_MENU_MENSAGENS
                ,$VAR_MENU_DOCUMENTACAO));
                        
$VAR_MENU_GERAL[] = $VAR_MENU_PRINCIPAL;


//////////////////////////////////////////////////
$tmp_MenuNome="";
$tmp_MenuEntidade="";
$tmp_MenuEntidadeAcao="";
$tmp_MenuItens="";
$tmp_MenuIcone="";
$tmp_SessaoUID="";

$VAR_LAYOUT_MENU[0]['MENU']='<li class=\"header\">$tmp_MenuNome</li>\n';
$VAR_LAYOUT_MENU[0]['ITENS']='<li class=\"header\">$tmp_MenuNome</li>\n$tmp_MenuItens\n';


$VAR_LAYOUT_MENU[1]['MENU']='<li><a href=\"javascript::;\" onclick=\"PesquisaDados(\'?XMLHTML=true&SID=$tmp_SessaoUID&SysEntidade=$tmp_MenuEntidade&SysEntidadeAcao=$tmp_MenuEntidadeAcao\',\'\',\'DIV_CONTEUDO\',null)\"><i class=\"fa $tmp_MenuIcone\"></i> <span>$tmp_MenuNome</span></a></li>\n';

//$VAR_LAYOUT_MENU[1]['MENU']='<li><a href=\"#\" ><i class=\"fa fa-book\"></i> <span>$tmp_MenuNome</span></a></li>\n';
$VAR_LAYOUT_MENU[1]['ITENS']='<li class=\"treeview\">
              <a href=\"#\">
                <i class=\"fa $tmp_MenuIcone\"></i> <span>$tmp_MenuNome</span>
                <i class=\"fa fa-angle-left pull-right\"></i>
              </a>
              <ul class=\"treeview-menu\">
                $tmp_MenuItens
              </ul>
            </li>\n';
?>