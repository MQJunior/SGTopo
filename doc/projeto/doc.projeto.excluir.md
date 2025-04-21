## AGENDAMENTO - EXCLUIR

### Entidade: PROJETO  
### Ação: EXCLUIR  
### Método: `POST`  
### Endpoint: `/api`

#### Descrição:
Exclui permanentemente um projeto do banco de dados com base na chave primária (`CODIGO`).  
Esta ação **remove definitivamente** o registro e não poderá ser desfeita.

#### Parâmetros (JSON no corpo da requisição):

```json
{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "PROJETO",
  "SysEntidadeAcao": "EXCLUIR",
  "txtChaveRegistro": "1"
}
```

| Parâmetro          | Tipo     | Obrigatório | Descrição                                          |
|--------------------|----------|-------------|------------------------------------------------------|
| SID                | string   | ✅ Sim      | Token de sessão válido do usuário logado             |
| SysEntidade        | string   | ✅ Sim      | Nome da entidade (`AGENDAMENTO`)                     |
| SysEntidadeAcao    | string   | ✅ Sim      | Nome da ação (`EXCLUIR`)                             |
| txtChaveRegistro   | string   | ✅ Sim      | Código do projeto que se deseja excluir          |

#### Comportamento:

- Remove o registro do banco de dados.
- A operação é irreversível. Confirme antes de executar.
- Retorna mensagem de confirmação da exclusão.

#### Exemplo de Requisição:

```bash
POST /api HTTP/1.1
Content-Type: application/json

{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "PROJETO",
  "SysEntidadeAcao": "EXCLUIR",
  "txtChaveRegistro": "1"
}
```

#### Observações:

- Certifique-se de que o projeto pode ser excluído (não vinculado a registros dependentes).
- O sistema pode negar a exclusão em caso de vínculos restritivos (validação depende da regra de negócio).

---

### Retorno (JSON):

```json
{
  "sid": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysMensagem": {
    "SUCESSO": "Registro excluído com sucesso!"
  }
}
```
