<?php
/*
{
    "file": "sistema.conf.php",
    "local": "conf/sistema",
    "author": {
        "name": "Márcio Queiroz Jr",
        "email": "mqjunior@gmail.com"
    },
    "version": "1.0.0",
    "package":  "SGPadrao",
    "subpackage": "Sistema",
    "category": "Config",
    "description": "Seta-se as Tabelas para o processamento, Tabela do Sistema, Tabela de Configurações dos Backup's, Tabela de Usuários do sistema",
    "created": "2018-04-02",
    "dependencies": [
    ],
    "modifications": [
    ],
    "tags": [
    ]
}
*/

/* CONFIGURA��O DO BANCO DE DADOS */
$this->SISTEMA_['ENTIDADE']['SISTEMA']['CONF']['DATABASE'] = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];
/* NOME DA TABELA DA ENTIDADE NO BANCO DE DADOS */
$this->SISTEMA_['ENTIDADE']['SISTEMA']['CONF']['DATABASE']['TBL_SISTEMA'] = 'TBL_SISTEMA';

/* TABELA DO BACKUP NO BANCO DE DADOS - RELACIONADA  */
$this->SISTEMA_['ENTIDADE']['SISTEMA']['CONF']['DATABASE']['TBL_BACKUP'] = 'TBL_SYS_BACKUP';


/* TABELA USUARIO NO BANCO DE DADOS - RELACIONADA  */
$this->SISTEMA_['ENTIDADE']['SISTEMA']['CONF']['DATABASE']['TBL_USUARIO'] = $this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['ENTIDADE_DB'];
