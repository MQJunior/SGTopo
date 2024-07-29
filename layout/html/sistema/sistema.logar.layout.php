<?php
if (isset($this->SISTEMA_['CONFIG']['WEB'])) {
  $url_Layout = $this->SISTEMA_['CONFIG']['WEB']['LAYOUT'];
  $url_Layout_Font = $this->SISTEMA_['CONFIG']['WEB']['FONTS'];
  $url_Layout_Ajax = $this->SISTEMA_['CONFIG']['WEB']['AJAX'];
  $url_Layout_Padrao = $this->SISTEMA_['CONFIG']['WEB']['LAYOUT_PADRAO'];
  //echo "aqui";
} else {
  $url_Layout = "http://mqjrserver/Layout/";
  $url_Layout_Font = $url_Layout . "fonts/";
  $url_Layout_Ajax = $url_Layout . "ajax/";
  $url_Layout_Padrao = $url_Layout . "modelos/ATL/";
}


$RtlSistemaTitulo = $this->SISTEMA_['CONFIG']['SISTEMA']['INFO']['SISTEMA_NOME'];
$RtlSistemaTitulo = htmlentities($RtlSistemaTitulo);
header('Content-Type: text/html; charset=UTF-8');

$this->SISTEMA_['SAIDA']['EXIBIR'] =
  "<!DOCTYPE html>
<html>
  <head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <title>$RtlSistemaTitulo | Entrar</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
    <!-- Bootstrap 3.3.5 -->
    <link rel=\"stylesheet\" href=\"" . $url_Layout_Padrao . "bootstrap/css/bootstrap.min.css\">
    <!-- Font Awesome -->
    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css\">
    <!-- Ionicons -->
    <link rel=\"stylesheet\" href=\"https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css \">
    <!-- Theme style -->
    <link rel=\"stylesheet\" href=\"" . $url_Layout_Padrao . "dist/css/AdminLTE.min.css\">
    <!-- iCheck -->
    <link rel=\"stylesheet\" href=\"" . $url_Layout_Padrao . "plugins/iCheck/square/blue.css\">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src=\"" . $url_Layout_Padrao . "html5shiv.min.js\"></script>
        <script src=\"" . $url_Layout_Padrao . "respond.min.js\"></script>
    <![endif]-->
  </head>
  <body class=\"hold-transition login-page\">
    <div class=\"login-box\">
      <div class=\"login-logo\">
        <a href=\".\"><b>$RtlSistemaTitulo</b></a>
      </div><!-- /.login-logo -->
      <div class=\"login-box-body\">
        <p class=\"login-box-msg\">Entre para iniciar uma nova sessao</p>
        <p class=\"text-red\">" . $SAIDA_MENSAGEM_ERROR . "</p>
        <form action=\".\" method=\"post\">
          <input type=\"hidden\" name=\"SysEntidade\" value=\"USUARIO\">
          <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"LOGIN\">
          <div class=\"form-group has-feedback\">
            <input type=\"email\" class=\"form-control\" placeholder=\"Email\" name=\"txtLoginEmail\" id=\"txtLoginEmail\">
            <span class=\"glyphicon glyphicon-envelope form-control-feedback\"></span>
          </div>
          <div class=\"form-group has-feedback\">
            <input type=\"password\" class=\"form-control\" placeholder=\"Password\" id=\"txtLoginSenha\" name=\"txtLoginSenha\">
            <span class=\"glyphicon glyphicon-lock form-control-feedback\"></span>
          </div>
          <div class=\"row\">
            <div class=\"col-xs-8\">
              <div class=\"checkbox icheck\">
                <label>
                  <input type=\"checkbox\" name=\"txtManterConectado\" id=\"txtManterConectado\" > Manter-me conectado
                </label>
              </div>
            </div><!-- /.col -->
            <div class=\"col-xs-4\">
              <button type=\"submit\" class=\"btn btn-$SistemaLayoutCor btn-block btn-flat\">Entrar</button>
            </div><!-- /.col -->
          </div>
        </form>

       
        <a href=\"#\">Esqueci minha senha</a><br>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src=\"" . $url_Layout_Padrao . "plugins/jQuery/jQuery-2.1.4.min.js\"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src=\"" . $url_Layout_Padrao . "bootstrap/js/bootstrap.min.js\"></script>
    <!-- iCheck -->
    <script src=\"" . $url_Layout_Padrao . "plugins/iCheck/icheck.min.js\"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>";

//echo $tmp_Saida_Include;
?>