<?php
$Conteudo_Titulo = "Sistema";
$Conteudo_Subtitulo = "Debug";
$Conteudo_Icone = "fa-stack-overflow";
$Conteudo_ArvoreLocal = "<a href=\"javascript::;\"><i class=\"fa $Conteudo_Icone\"></i> $Conteudo_Titulo</a>";



$this->SISTEMA_['SAIDA']['EXIBIR'] = 
"
    <div class=\"col-md-12\">
      <div class=\"box box-$SistemaLayoutCor\">
        <div class=\"box-header with-border\">
          <h3 class=\"box-title\">Debug do Sistema</h3>
          
        </div>
        <div class=\"box-body\" id=\"DIV_SISTEMA_DEBUG\">
          ".nl2br($VAR_SISTEMA_DEBUG)."
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
";

$this->SISTEMA_['SAIDA']['EXIBIR'] .= "<script language=\"text/javascript\">
  LBL_TITULO.innerText='$Conteudo_Titulo';
  LBL_SUBTITULO.innerText='$Conteudo_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$Conteudo_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='$Conteudo_ArvoreLocal';
</script>";

?>