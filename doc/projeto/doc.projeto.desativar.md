## PROJETO - DESATIVAR

### Entidade: PROJETO  
### Ação: DESATIVAR  
### Método: `POST`  
### Endpoint: `/api`

#### Descrição:
Define o status de ativação lógica do projeto.  
Essa ação define o campo `REG_ATIVO` como `1` (`DESATIVAR`) ou `0` (caso de desativação), mantendo os dados no banco.

---

#### Parâmetros (JSON no corpo da requisição):

```json
{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "PROJETO",
  "SysEntidadeAcao": "DESATIVAR",
  "txtChaveRegistro": "99"
}
```

| Parâmetro          | Tipo     | Obrigatório | Descrição                                         |
|--------------------|----------|-------------|---------------------------------------------------|
| SID                | string   | ✅ Sim      | Token de sessão válido do usuário logado          |
| SysEntidade        | string   | ✅ Sim      | Nome da entidade (`PROJETO`)                      |
| SysEntidadeAcao    | string   | ✅ Sim      | Nome da ação (`DESATIVAR`)                           |
| txtChaveRegistro   | string   | ✅ Sim      | Código do projeto a ser atualizado                |

---

#### Exemplo de Requisição:

```bash
POST /api HTTP/1.1
Content-Type: application/json

{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "PROJETO",
  "SysEntidadeAcao": "DESATIVAR",
  "txtChaveRegistro": "99"
}
```

---

### Retorno (JSON):

```json
{
  "projeto": {
    "CODIGO": "99",
    "NOME": "Projeto Exemplo Bairro Alfa",
    "DESCRICAO": "Levantamento Topográfico de Lote",
    "DATA_INICIO": "YYYY-MM-DD HH:MM:SS",
    "DATA_FIM": null,
    "STATUS": "ATIVO",
    "CAMINHO": "Cidades/Bairro Alfa/Loteamento/Quadra01_Lote02",
    "SESSAO": "Id da Sessao",
    "USUARIO": "Id do Usuario",
    "DATACRIACAO": "YYYY-MM-DD HH:MM:SS",
    "REG_ATIVO": "0"
  },
  "sid": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysMensagem": {
    "SUCESSO": "Registro desativar com sucesso!"
  }
}
```

---

#### Observações:

- A ação **DESATIVAR** não altera o conteúdo do projeto, apenas seu status de ativação lógica.
- O `SID` deve estar ativo e autorizado para a operação.
