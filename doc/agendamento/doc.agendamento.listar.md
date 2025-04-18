## AGENDAMENTO - LISTAR

### Entidade: AGENDAMENTO  
### Ação: LISTAR  
### Método: `POST`  
### Endpoint: `/api`

#### Descrição:
Executa a listagem de registros da tabela de agendamentos com base em filtros opcionais.  
Pode retornar registros ativos ou inativos, com ou sem limite de quantidade.

#### Parâmetros (JSON no corpo da requisição):

```json
{
  "SysEntidade": "AGENDAMENTO",
  "SysEntidadeAcao": "LISTAR",
  "Filtros": {
    "STATUS": "PENDENTE",
    "DATA": "2025-04-17"
  },
  "Inativos": false,
  "QtdeReg": 10
}
```

| Parâmetro          | Tipo     | Obrigatório | Descrição                                               |
|--------------------|----------|-------------|-----------------------------------------------------------|
| SysEntidade         | string   | ✅ Sim      | Nome da entidade (`AGENDAMENTO`)                         |
| SysEntidadeAcao     | string   | ✅ Sim      | Nome da ação (`LISTAR`)                                  |
| Filtros             | objeto   | ❌ Não      | Campos e valores para filtro, aplicados com `AND` no SQL |
| Inativos            | boolean  | ❌ Não      | Define se inclui registros inativos (`REG_ATIVO = 0`)    |
| QtdeReg             | inteiro  | ❌ Não      | Limite máximo de registros a retornar                    |

#### Comportamento:

- Se nenhum parâmetro for informado, retorna todos os registros ativos.
- Se `Inativos = true`, ignora o filtro `REG_ATIVO = 1`.
- Filtros são aplicados como cláusulas `AND` na cláusula `WHERE`.
- O resultado da consulta é armazenado em:
  ```php
  $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['DADOS']
  ```

#### Exemplo de Requisição:

```bash
POST /api HTTP/1.1
Content-Type: application/json

{
  "SysEntidade": "AGENDAMENTO",
  "SysEntidadeAcao": "LISTAR",
  "Filtros": {
    "STATUS": "PENDENTE"
  },
  "Inativos": false,
  "QtdeReg": 5
}
```

#### Exemplo de Requisição PHP:

```php
$AGENDAMENTO->Listar([
  'STATUS' => 'PENDENTE',
  'DATA' => '2025-04-17'
], false, 10);
```

#### Observações:

- Campos usados nos filtros devem corresponder exatamente aos nomes no banco de dados.
- Para segurança, os valores são sanitizados com `addslashes()`.
- O resultado é ordenado por `DATA` de forma crescente.

---

### Retorno (JSON):

```json
{
  "agendamentos": [
    {
      "CODIGO": "1",
      "DATA": "YYYY-MM-DD",
      "HORA": "HH:MM:SS",
      "DESCRICAO": "Descrição do agendamento",
      "ENDERECO": "Endereço completo do local",
      "CONTATO": null,
      "LOCAL": null,
      "OBSERVACOES": "Texto livre com observações",
      "STATUS": "PENDENTE",
      "DATACRIACAO": "YYYY-MM-DD HH:MM:SS",
      "USUARIO": "usuario@exemplo.com"
    },
    {
      "CODIGO": "2",
      "DATA": "YYYY-MM-DD",
      "HORA": null,
      "DESCRICAO": "Outro agendamento",
      "ENDERECO": "Outro endereço",
      "CONTATO": null,
      "LOCAL": null,
      "OBSERVACOES": null,
      "STATUS": "CANCELADO",
      "DATACRIACAO": "YYYY-MM-DD HH:MM:SS",
      "USUARIO": "usuario@exemplo.com"
    }
  ],
  "sid": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysMensagem": {
    "SUCESSO": "Listagem realizada com sucesso!"
  }
}
```
