<?php
header('Content-Type: text/html; charset=UTF-8');

$this->SISTEMA_['SAIDA']['EXIBIR'] =
  "<!DOCTYPE html>
<html>
  <head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>$RtlSistemaTitulo | Entrar</title>
    <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css\" integrity=\"sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=\" crossorigin=\"anonymous\"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css\" integrity=\"sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=\" crossorigin=\"anonymous\"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css\" integrity=\"sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=\" crossorigin=\"anonymous\"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel=\"stylesheet\" href=\"https://adminlte-v4.netlify.app/dist/css/adminlte.css\">
  </head>
  <body class=\"login-page bg-body-secondary\">
    <div class=\"login-box\">
    <div class=\"card card-outline card-primary\">
        <div class=\"login-logo\">
          <a href=\".\"><b>$RtlSistemaTitulo</b></a>
        </div><!-- /.login-logo -->

        <div class=\"card\">
          <div class=\"card-body login-card-body\">
            <p class=\"login-box-msg\">$SysRtl_Sistema_Logar_Mensagem_BoaVindas</p>
          
            <div class=\"login-box-body\">
              <p class=\"text-red\">" . $SAIDA_MENSAGEM_ERROR . "</p>
              <form action=\".\" method=\"post\">
                <div class=\"input-group mb-3\">
                  <input type=\"hidden\" name=\"SysEntidade\" value=\"USUARIO\">
                  <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"LOGIN\">

                  <div class=\"input-group mb-3\">
                    <input type=\"email\" class=\"form-control\" placeholder=\"Email\" name=\"txtLoginEmail\" id=\"txtLoginEmail\">
                    <div class=\"input-group-append\">
                      <div class=\"input-group-text\">
                        <span class=\"bi bi-envelope\"></span>
                      </div>
                    </div>
                  </div>

                  <div class=\"input-group mb-3\">
                    <input type=\"password\" class=\"form-control\" placeholder=\"Password\" id=\"txtLoginSenha\" name=\"txtLoginSenha\">
                    <div class=\"input-group-append\">
                      <div class=\"input-group-text\">
                        <span class=\"bi bi-lock-fill\"></span>
                      </div>
                    </div>
                  </div>

                  
                  <div class=\"row\">
                    <div class=\"col-8\">
                      <div class=\"icheck-primary\">
                        <input type=\"checkbox\" name=\"txtManterConectado\" id=\"txtManterConectado\" > 
                        <label for=\"txtManterConectado\"> $SysRtl_Sistema_Logar_TxtManterConectado  </label>
                      </div>
                    </div><!-- /.col -->
                  </div>
                  
                  <div class=\"col-4\">
                      <button type=\"submit\" class=\"btn btn-$SistemaLayoutCor btn-block btn-flat\">Entrar</button>
                  </div><!-- /.col -->
                </div>  
              </form>
              <a href=\"#\">Esqueci minha senha</a><br>
            </div>
          </div> <!-- card -->
        <div>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
<!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src=\"https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js\" integrity=\"sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=\" crossorigin=\"anonymous\"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src=\"https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js\" integrity=\"sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=\" crossorigin=\"anonymous\"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js\" integrity=\"sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=\" crossorigin=\"anonymous\"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src=\"https://adminlte-v4.netlify.app/dist/js/adminlte.js\"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = \".sidebar-wrapper\";
        const Default = {
            scrollbarTheme: \"os-theme-light\",
            scrollbarAutoHide: \"leave\",
            scrollbarClickScroll: true,
        };
        document.addEventListener(\"DOMContentLoaded\", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== \"undefined\"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script> <!--end::OverlayScrollbars Configure--> <!--end::Script-->
  </body>
</html>";

//echo $tmp_Saida_Include;
?>