## AGENDAMENTO - CANCELAR

### Entidade: AGENDAMENTO  
### Ação: CANCELAR  
### Método: `POST`  
### Endpoint: `/api`

#### Descrição:
Define o status de um agendamento como `CANCELADO`.  
Essa ação é usada para marcar um agendamento que foi interrompido, desmarcado ou anulado.

#### Parâmetros (JSON no corpo da requisição):

```json
{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "AGENDAMENTO",
  "SysEntidadeAcao": "CANCELAR",
  "txtChaveRegistro": "1"
}
```

| Parâmetro          | Tipo     | Obrigatório | Descrição                                          |
|--------------------|----------|-------------|------------------------------------------------------|
| SID                | string   | ✅ Sim      | Token de sessão válido do usuário logado             |
| SysEntidade        | string   | ✅ Sim      | Nome da entidade (`AGENDAMENTO`)                     |
| SysEntidadeAcao    | string   | ✅ Sim      | Nome da ação (`CANCELAR`)                            |
| txtChaveRegistro   | string   | ✅ Sim      | Código do agendamento que se deseja cancelar         |

#### Comportamento:

- Altera o campo `STATUS` do agendamento para `CANCELADO`.
- Retorna o objeto atualizado com a confirmação da operação.

#### Exemplo de Requisição:

```bash
POST /api HTTP/1.1
Content-Type: application/json

{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "AGENDAMENTO",
  "SysEntidadeAcao": "CANCELAR",
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
    "STATUS": "CANCELADO",
    "SESSAO": "Id da Sessao",
    "USUARIO": "Id do Usuario",
    "DATACRIACAO": "YYYY-MM-DD HH:MM:SS",
    "REG_ATIVO": "1"
  },
  "sid": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysMensagem": {
    "SUCESSO": "Status definido como CANCELADO com sucesso!"
  }
}
```