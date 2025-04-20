## PROJETOS - LISTAR

### Entidade: PROJETO
### Ação: LISTAR

#### Descrição:
Executa a listagem dos projetos cadastrados no sistema, com filtros opcionais.  
Pode retornar registros ativos ou inativos, e permite limitar a quantidade retornada.

#### Parâmetros (entrada via JSON):

```json
{
  "SID": "string",                       // Identificador da sessão
  "SysEntidade": "PROJETO",             // Nome da entidade
  "SysEntidadeAcao": "LISTAR",          // Ação a ser executada
  "TXT_PROJETOS_NOME": "Residencial",   // (opcional) filtro por nome
  "TXT_PROJETOS_STATUS": "ATIVO",       // (opcional) filtro por status
  "TXT_REGISTROS_INATIVOS": true,       // (opcional) incluir inativos (REG_ATIVO = 0)
  "TXT_QTDE_REGISTROS": 20              // (opcional) limitar número de registros retornados
}
```

#### Comportamento:
- Filtros com prefixo `TXT_PROJETO_` são convertidos em cláusulas `AND` no `WHERE`.
- `TXT_REGISTROS_INATIVOS` define se o sistema deve considerar registros com `REG_ATIVO = 0`.
- `TXT_QTDE_REGISTROS` limita a quantidade de registros retornados.
- O resultado é armazenado em:
  `$this->SISTEMA_['ENTIDADE']['PROJETOS']['DADOS']`

#### Exemplo de uso no PHP:
```php
$PROJETOS->Listar(['STATUS' => 'ATIVO']);
```

### Retorno (JSON):

```json
{
  "projetos": [
    {
      "CODIGO": "1",
      "NOME": "Residencial ABC",
      "DESCRICAO": "Projeto de levantamento urbano",
      "DATA_INICIO": "YYYY-MM-DD HH:MM:SS",
      "DATA_FIM": "YYYY-MM-DD HH:MM:SS",
      "STATUS": "ATIVO",
      "CAMINHO": "/caminho/para/arquivos/",
      "SESSAO": "10",
      "USUARIO": "5",
      "DATACRIACAO": "YYYY-MM-DD HH:MM:SS",
      "REG_ATIVO": "1"
    },
    {
      "CODIGO": "2",
      "NOME": "Topografia Rural",
      "DESCRICAO": "Mapa georreferenciado",
      "DATA_INICIO": null,
      "DATA_FIM": null,
      "STATUS": "CANCELADO",
      "CAMINHO": null,
      "SESSAO": "12",
      "USUARIO": "7",
      "DATACRIACAO": "YYYY-MM-DD HH:MM:SS",
      "REG_ATIVO": "1"
    }
  ],
  "sid": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysMensagem": {
    "SUCESSO": "Listagem realizada com sucesso!"
  }
}
```

#### Observações:
- Os campos `DATA_INICIO` e `DATA_FIM` podem ser `null` se não definidos.
- O campo `CAMINHO` aponta para o diretório base dos arquivos do projeto (se aplicável).
- Para filtrar por projetos inativos, utilize `"TXT_REGISTROS_INATIVOS": true`.