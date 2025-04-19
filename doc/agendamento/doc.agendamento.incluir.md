## AGENDAMENTO - INCLUIR

### Entidade: AGENDAMENTO  
### Ação: INCLUIR  
### Modo de uso: Requisição POST para o endpoint da API

---

### Descrição:
Realiza o cadastro de um novo agendamento na base de dados.  
Recebe os campos obrigatórios e opcionais no corpo da requisição.

---

### Requisição

#### Método:
`POST`

#### Cabeçalho:
```
Content-Type: application/json
```

#### Corpo da requisição (exemplo):
```json
{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "AGENDAMENTO",
  "SysEntidadeAcao": "INCLUIR",
  "TXT_AGENDAMENTO_DATA": "YYYY-MM-DD",
  "TXT_AGENDAMENTO_HORA": "",
  "TXT_AGENDAMENTO_DESCRICAO": "Descrição do serviço",
  "TXT_AGENDAMENTO_ENDERECO": "Endereço do local",
  "TXT_AGENDAMENTO_CONTATO": "",
  "TXT_AGENDAMENTO_LOCAL": "",
  "TXT_AGENDAMENTO_OBSERVACOES": "Observações adicionais"
}
```

---

### Campos esperados:

- `TXT_AGENDAMENTO_DATA` — *obrigatório*
- `TXT_AGENDAMENTO_HORA` — *opcional*
- `TXT_AGENDAMENTO_DESCRICAO` — *obrigatório*
- `TXT_AGENDAMENTO_ENDERECO` — *obrigatório*
- `TXT_AGENDAMENTO_CONTATO` — *opcional*
- `TXT_AGENDAMENTO_LOCAL` — *opcional*
- `TXT_AGENDAMENTO_OBSERVACOES` — *opcional*

---

### Comportamento:

- Os campos em branco são armazenados como `null`.
- O status do novo agendamento é automaticamente definido como `"PENDENTE"`.
- O registro é criado com `REG_ATIVO = 1`.

---

### Retorno (exemplo de resposta JSON):

```json
{
  "agendamento": {
    "CODIGO": "999",
    "DATA": "YYYY-MM-DD",
    "HORA": null,
    "DESCRICAO": "Descrição do serviço",
    "ENDERECO": "Endereço do local",
    "CONTATO": null,
    "LOCAL": null,
    "OBSERVACOES": "Observações adicionais",
    "STATUS": "PENDENTE",
    "SESSAO": "99",
    "USUARIO": "999",
    "DATACRIACAO": "YYYY-MM-DD HH:MM:SS",
    "REG_ATIVO": "1"
  },
  "sid": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysMensagem": {
    "SUCESSO": "Inclusão realizada com sucesso!"
  }
}
```

---

### Observações:

- O campo `SID` é obrigatório e representa a sessão do usuário autenticado.
- A ação `INCLUIR` sempre retorna o registro recém-criado completo no campo `agendamento`.
- A resposta contém também o mesmo `sid` e uma mensagem de sucesso (`SysMensagem`).