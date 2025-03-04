<?php

if (isset($this->SISTEMA_['CONFIG']['WEB'])){
  $url_Layout = $this->SISTEMA_['CONFIG']['WEB']['LAYOUT'];
  $url_Layout_Font = $this->SISTEMA_['CONFIG']['WEB']['FONTS'];
  $url_Layout_Ajax = $this->SISTEMA_['CONFIG']['WEB']['AJAX'];
  $url_Layout_Padrao = $this->SISTEMA_['CONFIG']['WEB']['LAYOUT_PADRAO'];
  
  //$dir_Layout ="/sistema/www/Layout/";
  $dir_Layout_Padrao = $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'];
  //echo "aqui";
}

$Conteudo_Usuario_Perfil_Imagem = $url_Layout_Padrao."dist/img/user2-160x160.jpg";

if (($VAR_IMAGEM_LINK == null)||($VAR_IMAGEM_LINK == ""))
  $imagemUsuario = "<img class=\"profile-user-img img-responsive img-circle\" src=\"".$Conteudo_Usuario_Perfil_Imagem."\" alt=\"Imagem do Perfil do Usuário\">";
else
  $imagemUsuario = "<img class=\"profile-user-img img-responsive img-circle\" src=\"".$VAR_IMAGEM_LINK."\" alt=\"Imagem do Perfil do Usuário\">";
  
$this->SISTEMA_['SAIDA']['EXIBIR'] = $imagemUsuario;
?>