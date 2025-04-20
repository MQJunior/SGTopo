## AGENDAMENTO - ALTERAR

### Entidade: AGENDAMENTO  
### Ação: ALTERAR  
### Método: `POST`  
### Endpoint: `/api`

#### Descrição:
Realiza a atualização dos dados de um agendamento previamente cadastrado.  
Os campos informados substituirão os valores existentes no banco de dados.

#### Parâmetros (JSON no corpo da requisição):

```json
{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "AGENDAMENTO",
  "SysEntidadeAcao": "ALTERAR",
  "txtChaveRegistro": "1",
  "TXT_AGENDAMENTO_DATA": "YYYY-MM-DD",
  "TXT_AGENDAMENTO_HORA": "HH:MM:SS",
  "TXT_AGENDAMENTO_DESCRICAO": "Descrição do agendamento",
  "TXT_AGENDAMENTO_ENDERECO": "Endereço completo do local",
  "TXT_AGENDAMENTO_CONTATO": "",
  "TXT_AGENDAMENTO_LOCAL": "",
  "TXT_AGENDAMENTO_OBSERVACOES": "Texto livre com observações"
}
```

| Parâmetro                  | Tipo     | Obrigatório | Descrição                                        |
|----------------------------|----------|-------------|--------------------------------------------------|
| SID                        | string   | ✅ Sim      | Token de sessão válido                           |
| SysEntidade                | string   | ✅ Sim      | Nome da entidade (`AGENDAMENTO`)                 |
| SysEntidadeAcao            | string   | ✅ Sim      | Nome da ação (`ALTERAR`)                         |
| txtChaveRegistro           | string   | ✅ Sim      | Código do agendamento a ser alterado             |
| TXT_AGENDAMENTO_DATA       | string   | ❌ Não      | Nova data no formato `YYYY-MM-DD`                |
| TXT_AGENDAMENTO_HORA       | string   | ❌ Não      | Nova hora no formato `HH:MM:SS`                  |
| TXT_AGENDAMENTO_DESCRICAO  | string   | ❌ Não      | Descrição atualizada                             |
| TXT_AGENDAMENTO_ENDERECO   | string   | ❌ Não      | Endereço atualizado                              |
| TXT_AGENDAMENTO_CONTATO    | string   | ❌ Não      | Nome ou telefone do contato                      |
| TXT_AGENDAMENTO_LOCAL      | string   | ❌ Não      | Local interno ou externo                         |
| TXT_AGENDAMENTO_OBSERVACOES| string   | ❌ Não      | Observações adicionais                           |

#### Comportamento:

- Altera os dados do registro com base no `txtChaveRegistro`.
- Campos em branco serão tratados conforme regras do sistema (vazio ou `null`).
- Retorna o objeto atualizado e mensagem de sucesso.

#### Exemplo de Requisição:

```bash
POST /api HTTP/1.1
Content-Type: application/json

{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "AGENDAMENTO",
  "SysEntidadeAcao": "ALTERAR",
  "txtChaveRegistro": "1",
  "TXT_AGENDAMENTO_DATA": "YYYY-MM-DD",
  "TXT_AGENDAMENTO_HORA": "HH:MM:SS",
  "TXT_AGENDAMENTO_DESCRICAO": "Descrição do agendamento",
  "TXT_AGENDAMENTO_ENDERECO": "Endereço completo do local",
  "TXT_AGENDAMENTO_CONTATO": "",
  "TXT_AGENDAMENTO_LOCAL": "",
  "TXT_AGENDAMENTO_OBSERVACOES": "Texto livre com observações"
}
```

#### Observações:

- Todos os campos iniciados com `TXT_AGENDAMENTO_` são atualizáveis.
- Campos não enviados na requisição manterão os valores existentes.

---

### Retorno (JSON):

```json
{
  "agendamento": {
    "CODIGO": "1",
    "DATA": "YYYY-MM-DD",
    "HORA": "HH:MM:SS",
    "DESCRICAO": "Descrição do agendamento",
    "ENDERECO": "Endereço completo do local",
    "CONTATO": "Nome ou telefone do contato",
    "LOCAL": "Local interno ou externo",
    "OBSERVACOES": "Texto livre com observações",
    "STATUS": "PENDENTE",
    "SESSAO": "Id da Sessao",
    "USUARIO": "Id do Usuario",
    "DATACRIACAO": "YYYY-MM-DD HH:MM:SS",
    "REG_ATIVO": "1"
  },
  "sid": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysMensagem": {
    "SUCESSO": "Alteracao realizada com sucesso!"
  }
}
```
