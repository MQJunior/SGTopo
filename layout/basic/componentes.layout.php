<?php

$tmpLayoutPaginaJSON = '{
    "PAGINA": {
        "ID": "paginaID",
        "TYPE" : "Page",
        "COMPONENTES": []
    }
}';

$tmpLayoutFormularioJSON = '{
    "ID": "FrmPadrao",
    "TYPE" : "Form",
    "NAME" : "FrmPadrao",
    "TITLE" : "Titulo do Formulario",
    "SUBTITLE" : "Sub Titulo do Formulario",
    "COMPONENTES": []
    
}';


$tmpLayoutDashBoardJSON = '{
        "ID": "dashboardID",
        "TYPE": "Page",
        "COMPONENTES": [
            {
                "ID": "grpTopo",
                "TYPE": "Group",
                "SUBTYPE": "Group",
                "LABEL": "Topo",
                "STYLE": "NULL",
                "COMPONENTES": [
                    {
                        "ID": "labelTopo",
                        "TYPE": "Label",
                        "CONTENT": "Conteúdo do Topo",
                        "STYLE": "topo-style"
                    }
                ]
            },
            {
                "ID": "grpMenuEsquerdo",
                "TYPE": "Group",
                "SUBTYPE": "Group",
                "LABEL": "Menu Esquerdo",
                "STYLE": "NULL",
                "COMPONENTES": [
                    {
                        "ID": "labelMenuEsquerdo",
                        "TYPE": "Label",
                        "CONTENT": "Conteúdo do Menu Esquerdo",
                        "STYLE": "menu-esquerdo-style"
                    }
                ]
            },
            {
                "ID": "grpConteudo",
                "TYPE": "Group",
                "SUBTYPE": "Group",
                "LABEL": "Conteúdo",
                "STYLE": "NULL",
                "COMPONENTES": [
                    {
                        "ID": "labelBreadcrumb",
                        "TYPE": "Label",
                        "CONTENT": "Breadcrumb",
                        "STYLE": "breadcrumb-style"
                    },
                    {
                        "ID": "labelConteudoMensagem",
                        "TYPE": "Label",
                        "CONTENT": "Mensagens do Conteúdo",
                        "STYLE": "conteudo-mensagem-style"
                    },
                    {
                        "ID": "labelConteudoPrincipal",
                        "TYPE": "Label",
                        "CONTENT": "Conteúdo Principal",
                        "STYLE": "conteudo-principal-style"
                    },
                    {
                        "ID": "labelConteudoAuxiliar",
                        "TYPE": "Label",
                        "CONTENT": "Conteúdo Auxiliar",
                        "STYLE": "conteudo-auxiliar-style"
                    },
                    {
                        "ID": "labelConteudoProcessar",
                        "TYPE": "Label",
                        "CONTENT": "Conteúdo Processar",
                        "STYLE": "conteudo-processar-style"
                    }
                ]
            },
            {
                "ID": "grpRodape",
                "TYPE": "Group",
                "SUBTYPE": "Group",
                "LABEL": "Rodapé",
                "STYLE": "NULL",
                "COMPONENTES": [
                    {
                        "ID": "labelRodape",
                        "TYPE": "Label",
                        "CONTENT": "Conteúdo do Rodapé",
                        "STYLE": "rodape-style"
                    }
                ]
            }
        ]
    
}';

$tmpLayoutComponentePadraoJSON = '{
    "ID" : "Padrao",
    "TYPE" : "Padrao",
    "DATATYPE" : "string",
    "DATALENGTH" : 50,
    "LABEL": "Nome",
    "PLACEHOLDER" : "...",
    "REQUIRED" : true,
    "FIELD" : "nome",
    "VALUE" : ""
}';

$tmpLayoutComponentePadraoButtonJSON = '{
    "ID" : "btnPadrao",
    "TYPE" : "Button",
    "SIZE" : 50,
    "LABEL": "Btn Padrao",
    "ENTIDADE" : "",
    "SOURCE" : "",
    "ENTIDADEACAO" : "",
    "TARGET" : "NULL",
    "EVENTS" : []
}';

$tmpLayoutComponentePadraoGroupJSON = '{
    "ID" : "grpPadrao",
    "TYPE" : "Group",
    "SUBTYPE" : "Group",
    "LABEL": "Grp Padrao",
    "STYLE" : "NULL",
    "COMPONENTES" : []
}';

$tmpLayoutPagina = json_decode($tmpLayoutPaginaJSON, true);
$tmpLayoutFormulario = json_decode($tmpLayoutFormularioJSON, true);

$tmpLayoutDashBoard = json_decode($tmpLayoutDashBoardJSON, true);
$tmpLayoutComponentePadrao = json_decode($tmpLayoutComponentePadraoJSON, true);
$tmpLayoutComponentePadraoButton = json_decode($tmpLayoutComponentePadraoButtonJSON, true);
$tmpLayoutComponentePadraoGroup = json_decode($tmpLayoutComponentePadraoGroupJSON, true);
//die($tmpLayoutComponentePadraoGroupJSON);
// Componente do Tipo Hidden
$tmpLayoutComponenteHidden = $tmpLayoutComponentePadrao;
$tmpLayoutComponenteHidden['ID'] = "PadraoHidden";
$tmpLayoutComponenteHidden['TYPE'] = "Hidden";
$tmpLayoutComponenteHidden['FIELD'] = $tmpLayoutComponenteHidden['ID'];
unset($tmpLayoutComponenteHidden['PLACEHOLDER']);
unset($tmpLayoutComponenteHidden['LABEL']);
unset($tmpLayoutComponenteHidden['DATALENGTH']);

// Componente do Tipo Nome
$tmpLayoutComponenteNome = $tmpLayoutComponentePadrao;
$tmpLayoutComponenteNome['ID'] = "PadraoNome";
$tmpLayoutComponenteNome['TYPE'] = "Nome";
$tmpLayoutComponenteNome['FIELD'] = &$tmpLayoutComponenteEmail['ID'];
$tmpLayoutComponenteNome['LABEL'] = "Nome";
$tmpLayoutComponenteNome['PLACEHOLDER'] = "nome";
$tmpLayoutComponenteNome['DATALENGTH'] = 100;

// Componente do Tipo Label
$tmpLayoutComponenteLabel = $tmpLayoutComponentePadrao;
$tmpLayoutComponenteLabel['ID'] = "PadraoLabel";
$tmpLayoutComponenteLabel['TYPE'] = "Label";
//$tmpLayoutComponenteLabel['FIELD'] = &$tmpLayoutComponenteEmail['ID'];
$tmpLayoutComponenteLabel['LABEL'] = "Label";
unset($tmpLayoutComponenteLabel['PLACEHOLDER']);
$tmpLayoutComponenteLabel['DATALENGTH'] = 200;


// Componente do Tipo Email
$tmpLayoutComponenteEmail = $tmpLayoutComponentePadrao;
$tmpLayoutComponenteEmail['ID'] = "PadraoEmail";
$tmpLayoutComponenteEmail['TYPE'] = "Email";
$tmpLayoutComponenteEmail['FIELD'] = &$tmpLayoutComponenteEmail['ID'];
$tmpLayoutComponenteEmail['LABEL'] = "E-mail";
$tmpLayoutComponenteEmail['PLACEHOLDER'] = "e-mail";

// Componente do Tipo Password
$tmpLayoutComponentePassword = $tmpLayoutComponentePadrao;
$tmpLayoutComponentePassword['ID'] = "PadraoPassword";
$tmpLayoutComponentePassword['TYPE'] = "Password";
$tmpLayoutComponentePassword['FIELD'] = &$tmpLayoutComponentePassword['ID'];
$tmpLayoutComponentePassword['LABEL'] = "Password";
unset($tmpLayoutComponentePassword['PLACEHOLDER']);

// Componente do Tipo CheckBox
$tmpLayoutComponenteCheckBox = $tmpLayoutComponentePadrao;
$tmpLayoutComponenteCheckBox['ID'] = "PadraoCheckBox";
$tmpLayoutComponenteCheckBox['TYPE'] = "Checkbox";
$tmpLayoutComponenteCheckBox['FIELD'] = &$tmpLayoutComponenteCheckBox['ID'];
$tmpLayoutComponenteCheckBox['LABEL'] = "CheckBox";
$tmpLayoutComponenteCheckBox['CHECKED'] = false;
unset($tmpLayoutComponenteCheckBox['PLACEHOLDER']);
unset($tmpLayoutComponenteCheckBox['VALUE']);
unset($tmpLayoutComponenteCheckBox['REQUIRED']);
unset($tmpLayoutComponenteCheckBox['DATALENGTH']);

// Componente do Tipo Dropdown
$tmpLayoutComponenteDropdown = $tmpLayoutComponentePadrao;
$tmpLayoutComponenteDropdown['ID'] = "PadraoDropdown";
$tmpLayoutComponenteDropdown['TYPE'] = "Dropdown";
$tmpLayoutComponenteDropdown['FIELD'] = &$tmpLayoutComponenteDropdown['ID'];
$tmpLayoutComponenteDropdown['LABEL'] = "PREENCHER";
$tmpLayoutComponenteDropdown['PLACEHOLDER'] = "PREENCHER";
unset($tmpLayoutComponenteDropdown['DATALENGTH']);
$tmpLayoutComponenteDropdown['FIELD'] = "CODIGO";
$tmpLayoutComponenteDropdown['OPTIONS'] = "PadraoDropdownOptions";

// Componente do Tipo Submit
$tmpLayoutComponenteSubmit = $tmpLayoutComponentePadraoButton;
$tmpLayoutComponenteSubmit['ID'] = "PadraoSubmit";
$tmpLayoutComponenteSubmit['TYPE'] = "Submit";
unset($tmpLayoutComponenteSubmit['EVENTS']);
//$tmpLayoutPagina['FORM']['COMPONENTES'][] = $tmpLayoutComponenteNome;

//print_r($tmpLayoutPagina);


// Componentes botões que se repetem

$tmpLayoutComponentePadraoButton_Excluir = $tmpLayoutComponentePadraoButton;
$tmpLayoutComponentePadraoButton_Excluir['ID'] = "btnExcluir";
$tmpLayoutComponentePadraoButton_Excluir['LABEL'] = $SysRtl_Btn_Excluir;
$tmpLayoutComponentePadraoButton_Excluir['ENTIDADE'] = "PADRAO";
$tmpLayoutComponentePadraoButton_Excluir['ENTIDADEACAO'] = "EXCLUIR";


$tmpLayoutComponentePadraoButton_Desativar = $tmpLayoutComponentePadraoButton;
$tmpLayoutComponentePadraoButton_Desativar['ID'] = "btnDesativar";
$tmpLayoutComponentePadraoButton_Desativar['LABEL'] = $SysRtl_Btn_Desativar;
$tmpLayoutComponentePadraoButton_Desativar['ENTIDADE'] = "PADRAO";
$tmpLayoutComponentePadraoButton_Desativar['ENTIDADEACAO'] = "DESATIVAR";

$tmpLayoutComponentePadraoButton_Ativar = $tmpLayoutComponentePadraoButton;
$tmpLayoutComponentePadraoButton_Ativar['ID'] = "btnAtivar";
$tmpLayoutComponentePadraoButton_Ativar['LABEL'] = $SysRtl_Btn_Ativar;
$tmpLayoutComponentePadraoButton_Ativar['ENTIDADE'] = "PADRAO";
$tmpLayoutComponentePadraoButton_Ativar['ENTIDADEACAO'] = "ATIVAR";


$tmpLayoutComponentePadraoButton_Alterar = $tmpLayoutComponentePadraoButton;
$tmpLayoutComponentePadraoButton_Alterar['ID'] = "btnAltear";
$tmpLayoutComponentePadraoButton_Alterar['LABEL'] = $SysRtl_Btn_Alterar;
$tmpLayoutComponentePadraoButton_Alterar['ENTIDADE'] = "PADRAO";
$tmpLayoutComponentePadraoButton_Alterar['ENTIDADEACAO'] = "ALTERAR";

$tmpLayoutComponentePadraoButton_Incluir = $tmpLayoutComponentePadraoButton;
$tmpLayoutComponentePadraoButton_Incluir['ID'] = "btnIncluir";
$tmpLayoutComponentePadraoButton_Incluir['LABEL'] = $SysRtl_Btn_Incluir;
$tmpLayoutComponentePadraoButton_Incluir['ENTIDADE'] = "PADRAO";
$tmpLayoutComponentePadraoButton_Incluir['ENTIDADEACAO'] = "INCLUIR";

$tmpLayoutComponentePadraoButton_Novo = $tmpLayoutComponentePadraoButton_Incluir;
$tmpLayoutComponentePadraoButton_Incluir['ID'] = "btnNovo";
$tmpLayoutComponentePadraoButton_Novo['LABEL'] = $SysRtl_Btn_Novo;

$tmpLayoutComponentePadraoButton_Pesquisar = $tmpLayoutComponentePadraoButton;
$tmpLayoutComponentePadraoButton_Pesquisar['ID'] = "btnPesquisar";
$tmpLayoutComponentePadraoButton_Pesquisar['LABEL'] = $SysRtl_Btn_Pesquisar;
$tmpLayoutComponentePadraoButton_Pesquisar['ENTIDADE'] = "PADRAO";
$tmpLayoutComponentePadraoButton_Pesquisar['ENTIDADEACAO'] = "PESQUISAR";