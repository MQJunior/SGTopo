## AGENDAMENTO - DESATIVAR

### Entidade: AGENDAMENTO  
### Ação: DESATIVAR  
### Método: `POST`  
### Endpoint: `/api`

#### Descrição:
Desativa um agendamento existente, marcando-o como inativo (`REG_ATIVO = 0`).  
Após essa ação, o registro não será listado nas consultas padrão, mas poderá ser reativado posteriormente.

#### Parâmetros (JSON no corpo da requisição):

```json
{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "AGENDAMENTO",
  "SysEntidadeAcao": "DESATIVAR",
  "txtChaveRegistro": "1"
}
```

| Parâmetro          | Tipo     | Obrigatório | Descrição                                          |
|--------------------|----------|-------------|------------------------------------------------------|
| SID                | string   | ✅ Sim      | Token de sessão válido do usuário logado             |
| SysEntidade        | string   | ✅ Sim      | Nome da entidade (`AGENDAMENTO`)                     |
| SysEntidadeAcao    | string   | ✅ Sim      | Nome da ação (`DESATIVAR`)                           |
| txtChaveRegistro   | string   | ✅ Sim      | Código do agendamento que se deseja desativar        |

#### Comportamento:

- Altera o campo `REG_ATIVO` do agendamento para `0`.
- Retorna o objeto atualizado com confirmação da operação.

#### Exemplo de Requisição:

```bash
POST /api HTTP/1.1
Content-Type: application/json

{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "AGENDAMENTO",
  "SysEntidadeAcao": "DESATIVAR",
  "txtChaveRegistro": "1"
}
```

#### Observações:

- O campo `SID` deve estar válido e ativo.
- Caso o agendamento já esteja inativo, o sistema pode apenas confirmar o estado atual.

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
    "REG_ATIVO": "0"
  },
  "sid": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysMensagem": {
    "SUCESSO": "Registro Desativado com sucesso!"
  }
}
```
