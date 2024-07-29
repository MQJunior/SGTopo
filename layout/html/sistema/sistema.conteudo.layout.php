<?php
$Conteudo_Titulo = "Sistema";
$Conteudo_Subtitulo = "Conteúdo";
$Conteudo_Icone = "fa-user";
$Conteudo_ArvoreLocal = "<a href=\"javascript::;\"><i class=\"fa ".$Conteudo_Icone."\"></i> ".$Conteudo_Titulo."</a>";


$tmp_Layout_Conteudo = 
" 
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$Conteudo_Titulo';
  LBL_SUBTITULO.innerText='$Conteudo_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$Conteudo_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='$Conteudo_ArvoreLocal';
</script>
";
?>