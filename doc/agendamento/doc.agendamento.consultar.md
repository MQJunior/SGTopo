## AGENDAMENTO - CONSULTAR

### Entidade: AGENDAMENTO  
### Ação: CONSULTAR  
### Método: `POST`  
### Endpoint: `/api`

#### Descrição:
Consulta os dados completos de um agendamento a partir da chave primária (`CODIGO`).  
Utilizado para visualização detalhada de um registro previamente cadastrado.

#### Parâmetros (JSON no corpo da requisição):

```json
{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "AGENDAMENTO",
  "SysEntidadeAcao": "CONSULTAR",
  "txtChaveRegistro": "1"
}
```

| Parâmetro          | Tipo     | Obrigatório | Descrição                                          |
|--------------------|----------|-------------|------------------------------------------------------|
| SID                | string   | ✅ Sim      | Token de sessão válido do usuário logado             |
| SysEntidade        | string   | ✅ Sim      | Nome da entidade (`AGENDAMENTO`)                     |
| SysEntidadeAcao    | string   | ✅ Sim      | Nome da ação (`CONSULTAR`)                           |
| txtChaveRegistro   | string   | ✅ Sim      | Código do agendamento que se deseja consultar        |

#### Comportamento:

- Busca o registro com base no código informado.
- Se encontrado, retorna os dados completos do agendamento.
- Caso o código não exista ou o `SID` seja inválido, retorna erro.

#### Exemplo de Requisição:

```bash
POST /api HTTP/1.1
Content-Type: application/json

{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "AGENDAMENTO",
  "SysEntidadeAcao": "CONSULTAR",
  "txtChaveRegistro": "1"
}
```

#### Observações:

- O campo `SID` deve ser válido e estar ativo na sessão atual.
- O campo `txtChaveRegistro` deve conter o valor exato da chave primária (`CODIGO`) do registro no banco.

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
    "DATACRIACAO": "YYYY-MM-DD HH:MM:SS"
  },
  "sid": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysMensagem": {
    "SUCESSO": "Consulta realizada com sucesso!"
  }
}
```
