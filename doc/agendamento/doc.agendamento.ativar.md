## AGENDAMENTO - ATIVAR

### Entidade: AGENDAMENTO  
### Ação: ATIVAR  
### Método: `POST`  
### Endpoint: `/api`

#### Descrição:
Ativa um agendamento previamente desativado (`REG_ATIVO = 0`).  
Essa ação altera o status do registro para ativo, permitindo que ele volte a ser utilizado normalmente no sistema.

#### Parâmetros (JSON no corpo da requisição):

```json
{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "AGENDAMENTO",
  "SysEntidadeAcao": "ATIVAR",
  "txtChaveRegistro": "1"
}
```

| Parâmetro          | Tipo     | Obrigatório | Descrição                                          |
|--------------------|----------|-------------|------------------------------------------------------|
| SID                | string   | ✅ Sim      | Token de sessão válido do usuário logado             |
| SysEntidade        | string   | ✅ Sim      | Nome da entidade (`AGENDAMENTO`)                     |
| SysEntidadeAcao    | string   | ✅ Sim      | Nome da ação (`ATIVAR`)                              |
| txtChaveRegistro   | string   | ✅ Sim      | Código do agendamento que se deseja ativar           |

#### Comportamento:

- Altera o campo `REG_ATIVO` do agendamento para `1`.
- Retorna o objeto atualizado com confirmação de sucesso.

#### Exemplo de Requisição:

```bash
POST /api HTTP/1.1
Content-Type: application/json

{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "AGENDAMENTO",
  "SysEntidadeAcao": "ATIVAR",
  "txtChaveRegistro": "1"
}
```

#### Observações:

- Caso o agendamento já esteja ativo, o sistema pode ignorar a operação ou apenas confirmar o estado.
- O campo `SID` deve ser válido e estar ativo na sessão atual.

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
    "SUCESSO": "Registro Ativado com sucesso!"
  }
}
```
