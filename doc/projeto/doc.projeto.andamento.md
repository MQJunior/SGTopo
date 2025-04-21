## PROJETO - ANDAMENTO

### Entidade: PROJETO  
### Ação: ANDAMENTO  
### Método: `POST`  
### Endpoint: `/api`

#### Descrição:
Define o status de um projeto como `ANDAMENTO`.  
Essa ação é utilizada para atualizar o estágio do projeto no sistema, sem alterar os demais dados.

---

#### Parâmetros (JSON no corpo da requisição):

```json
{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "PROJETO",
  "SysEntidadeAcao": "ANDAMENTO",
  "txtChaveRegistro": "99"
}
```

| Parâmetro          | Tipo     | Obrigatório | Descrição                                         |
|--------------------|----------|-------------|---------------------------------------------------|
| SID                | string   | ✅ Sim      | Token de sessão válido do usuário logado          |
| SysEntidade        | string   | ✅ Sim      | Nome da entidade (`PROJETO`)                      |
| SysEntidadeAcao    | string   | ✅ Sim      | Nome da ação (`ANDAMENTO`)                           |
| txtChaveRegistro   | string   | ✅ Sim      | Código do projeto a ser atualizado                |

---

#### Exemplo de Requisição:

```bash
POST /api HTTP/1.1
Content-Type: application/json

{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "PROJETO",
  "SysEntidadeAcao": "ANDAMENTO",
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
    "STATUS": "ANDAMENTO",
    "CAMINHO": "Cidades/Bairro Alfa/Loteamento/Quadra01_Lote02",
    "SESSAO": "Id da Sessao",
    "USUARIO": "Id do Usuario",
    "DATACRIACAO": "YYYY-MM-DD HH:MM:SS",
    "REG_ATIVO": "1"
  },
  "sid": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysMensagem": {
    "SUCESSO": "Status definido como ANDAMENTO com sucesso!"
  }
}
```

---

#### Observações:

- Essa ação sobrescreve apenas o campo `STATUS`, sem afetar outros dados do projeto.
- O `SID` deve estar ativo e autorizado para a operação.
