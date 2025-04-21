## PROJETO - CONSULTAR

### Entidade: PROJETO  
### Ação: CONSULTAR  
### Método: `POST`  
### Endpoint: `/api`

#### Descrição:
Consulta os dados completos de um projeto com base no código (`txtChaveRegistro`).  
Usado para recuperar as informações detalhadas de um projeto já existente.

---

#### Parâmetros (JSON no corpo da requisição):

```json
{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "PROJETO",
  "SysEntidadeAcao": "CONSULTAR",
  "txtChaveRegistro": "99"
}
```

| Parâmetro          | Tipo     | Obrigatório | Descrição                                          |
|--------------------|----------|-------------|------------------------------------------------------|
| SID                | string   | ✅ Sim      | Token de sessão válido do usuário logado             |
| SysEntidade        | string   | ✅ Sim      | Nome da entidade (`PROJETO`)                         |
| SysEntidadeAcao    | string   | ✅ Sim      | Nome da ação (`CONSULTAR`)                           |
| txtChaveRegistro   | string   | ✅ Sim      | Código do projeto a ser consultado                   |

---

#### Comportamento:

- Localiza e retorna o projeto correspondente ao código informado.
- Retorna todos os campos relevantes e dados de criação.

---

#### Exemplo de Requisição:

```bash
POST /api HTTP/1.1
Content-Type: application/json

{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "PROJETO",
  "SysEntidadeAcao": "CONSULTAR",
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
    "REG_ATIVO": "1"
  },
  "sid": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysMensagem": {
    "SUCESSO": "Consulta realizada com sucesso!"
  }
}
```

---

#### Observações:

- A chave de consulta deve ser válida e corresponder a um projeto existente.
- O `SID` deve estar ativo e autorizado a acessar os dados consultados.
