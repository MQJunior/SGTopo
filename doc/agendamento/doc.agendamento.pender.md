## AGENDAMENTO - PENDER

### Entidade: AGENDAMENTO  
### Ação: PENDER  
### Método: `POST`  
### Endpoint: `/api`

#### Descrição:
Define o status de um agendamento como `PENDENTE`.  
Essa ação é usada para marcar um agendamento que estava com outro status (ex: cancelado ou concluído) como pendente novamente.

#### Parâmetros (JSON no corpo da requisição):

```json
{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "AGENDAMENTO",
  "SysEntidadeAcao": "PENDER",
  "txtChaveRegistro": "1"
}
```

| Parâmetro          | Tipo     | Obrigatório | Descrição                                          |
|--------------------|----------|-------------|------------------------------------------------------|
| SID                | string   | ✅ Sim      | Token de sessão válido do usuário logado             |
| SysEntidade        | string   | ✅ Sim      | Nome da entidade (`AGENDAMENTO`)                     |
| SysEntidadeAcao    | string   | ✅ Sim      | Nome da ação (`PENDER`)                              |
| txtChaveRegistro   | string   | ✅ Sim      | Código do agendamento que se deseja alterar          |

#### Comportamento:

- Altera o campo `STATUS` do agendamento para `PENDENTE`.
- Retorna o objeto atualizado com confirmação da operação.

#### Exemplo de Requisição:

```bash
POST /api HTTP/1.1
Content-Type: application/json

{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "AGENDAMENTO",
  "SysEntidadeAcao": "PENDER",
  "txtChaveRegistro": "1"
}
```

#### Observações:

- Essa ação sobrescreve o valor do campo `STATUS`, independentemente do valor anterior.
- O campo `SID` deve estar válido e ativo.

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
    "SUCESSO": "Status definido como PENDENTE com sucesso!"
  }
}
```
