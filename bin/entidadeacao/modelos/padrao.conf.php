<?php
/**
 * 📄 padrao.conf.php - Configuração da entidade padrao
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2018-02-22 | 🏷️ v0.0.0
 * 📦 Pacote: padrao | 📂 Subpacote: Config
 */

/** ⚙️ Configuração do Banco de Dados */
$this->SISTEMA_['ENTIDADE']['PADRAO']['CONF']['DATABASE'] = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];

/** 🗄️ Nome da Tabela da Entidade no Banco */
$this->SISTEMA_['ENTIDADE']['PADRAO']['CONF']['DATABASE']['TBL_PADRAO'] = 'TBL_PADRAO';

/** 🗄️ Tabela Usuário Relacionada */
$this->SISTEMA_['ENTIDADE']['PADRAO']['CONF']['DATABASE']['TBL_USUARIO'] = $this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['ENTIDADE_DB'];

?>
