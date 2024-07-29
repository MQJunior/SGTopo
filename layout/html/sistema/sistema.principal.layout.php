<?php

// monta o conteudo principal
// Menu Esquerdo  
include_once($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."sistema/sistema.menu.layout.php");
// Topo da Página 
include_once($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."sistema/sistema.topo.layout.php");
// Conteudo central da Página 
include_once($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."sistema/sistema.conteudo.layout.php");
// Conteudo Barra de Configuracoes
include_once($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."layout/layout.configuracao.layout.php");

$RtlSistemaTitulo = $this->SISTEMA_['CONFIG']['SISTEMA']['INFO']['SISTEMA_NOME'];

$this->SISTEMA_['SAIDA']['EXIBIR'] =  
"<!DOCTYPE html>
<html Content-Type: \"text/html\">
  <head>
    <meta charset=\"iso-8859-1\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\" />
    <meta http-equiv=\"cache-control\" content=\"max-age=0\" />
    <meta http-equiv=\"cache-control\" content=\"no-cache\" />
    <meta http-equiv=\"expires\" content=\"0\" />
    <meta http-equiv=\"expires\" content=\"Tue, 01 Jan 1980 1:00:00 GMT\" />
    <meta http-equiv=\"pragma\" content=\"no-cache\" />
    <title>$RtlSistemaTitulo</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
    
    <script type=\"text/javascript\" src=\"".$url_Layout_Ajax."sistema.js\" charset=\"iso-8859-1\"></script>
    <!-- Bootstrap 3.3.5 -->
    <link rel=\"stylesheet\" href=\"".$url_Layout_Padrao."bootstrap/css/bootstrap.min.css\">
    <!-- Font Awesome -->
     <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css\">
    <!-- Ionicons -->
    <link rel=\"stylesheet\" href=\"https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css \">
    <!-- Theme style -->
    <link rel=\"stylesheet\" href=\"".$url_Layout_Padrao."dist/css/AdminLTE.min.css\">
  
    <link rel=\"stylesheet\" href=\"".$url_Layout_Padrao."dist/css/skins/_all-skins.min.css\">
    <!-- iCheck -->
    <link rel=\"stylesheet\" href=\"".$url_Layout_Padrao."plugins/iCheck/flat/blue.css\">
 
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel=\"stylesheet\" href=\"".$url_Layout_Padrao."plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css\">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src=\"".$url_Layout_Padrao."html5shiv.min.js\"></script>
        <script src=\"".$url_Layout_Padrao."respond.min.js\"></script>
    <![endif]-->
    
  </head>
  <body class=\"hold-transition skin-$SistemaLayoutSkin sidebar-mini\">
    <div class=\"wrapper\">
      <!-- Content Wrapper. Contains page content -->
      <div id=\"DIV_TOPO\">
      ".$tmp_Layout_Topo."
      </div>
      <div id=\"DIV_MENU_ESQUERDO\">
        ".$tmp_Layout_MenuEsquerdo."
      </div>
      <div class=\"content-wrapper\">
        <section class=\"content-header\">
          <h1>
            <i id=\"LBL_TITULO\">".$Conteudo_Titulo."</i>
            <small id=\"LBL_SUBTITULO\">".$Conteudo_Subtitulo."</small>
            
          </h1>
          <ol class=\"breadcrumb\">
            <li id=\"LBL_ARVORE_LOCAL\">".$Conteudo_ArvoreLocal."</li>
            <li class=\"active\" id=\"LBL_SUBTITULO_LOCAL\">".$Conteudo_Subtitulo."</li>
          </ol>
        </section>
        <section class=\"content\">
          
          <div style=\"position: fixed; display:float; bottom:50px; right:20px; min-height: 5px;  width: 25%; z-index: 99999; \" id=\"DIV_CONTEUDO_MENSAGEM\" name=\"DIV_CONTEUDO_MENSAGEM\"></div>
          <div class=\"row\"  id=\"DIV_CONTEUDO\" style=\"z-index: 50;\" name=\"DIV_CONTEUDO\">
        ".$tmp_Layout_Conteudo."
          </div>
          <div style=\"position: fixed; left:0px; top:0px; right:50px; button:30px; margin:auto; background-color:#ACF; z-index: 88888;\" id=\"DIV_CONTEUDO_AUXILIAR\" name=\"DIV_CONTEUDO_AUXILIAR\"></div>
        </section>
     <div  id=\"DIV_CONTEUDO_PROCESSAR\" ></div>

      </div><!-- /.content-wrapper -->
      <footer class=\"main-footer\">
        <div class=\"pull-right hidden-xs\">
          <b>Versão</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2018-2018 <a href=\"http://z2.eti.br\">Z2 Tecnologia</a>.</strong> Todos os direitos reservado.
        <div id=\"mensagem\" name=\"mensagem\" style=\"font: bold 12px Verdana\"></div>
      </footer>
      
      <div id=\"DIV_BARRA_CONFIGURACAO\">
        ".$tmp_Layout_BarraConfiguracoes." 
      </div>
    </div><!-- ./wrapper -->

    
    <!-- jQuery 2.1.4 -->
    <script src=\"".$url_Layout_Padrao."plugins/jQuery/jQuery-2.1.4.min.js\"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src=\"".$url_Layout_Ajax."libs/fullcalendar/lib/jquery-ui.min.js\"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    
    <!-- Slimscroll -->
    <script src=\"".$url_Layout_Padrao."plugins/slimScroll/jquery.slimscroll.min.js\"></script>
    <!-- FastClick -->
    <script src=\"".$url_Layout_Padrao."plugins/fastclick/fastclick.min.js\"></script>
    
    <!-- Bootstrap 3.3.5 -->
    <script src=\"".$url_Layout_Padrao."bootstrap/js/bootstrap.min.js\"></script>
    <!-- AdminLTE App -->
    <script src=\"".$url_Layout_Padrao."dist/js/app.min.js\"></script>
    <!-- AdminLTE for demo purposes -->
    <script src=\"".$url_Layout_Padrao."dist/js/demo.js\"></script>
  </body>
</html>
";
?>
