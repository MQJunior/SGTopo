## PROJETO - INCLUIR

### Entidade: PROJETO  
### Ação: INCLUIR  
### Método: `POST`  
### Endpoint: `/api`

#### Descrição:
Cria um novo registro de projeto no sistema, armazenando informações como nome, descrição, datas e caminho de armazenamento.  
Essa ação é utilizada para iniciar oficialmente um projeto dentro do fluxo de trabalho.

---

#### Parâmetros (JSON no corpo da requisição):

```json
{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "PROJETO",
  "SysEntidadeAcao": "INCLUIR",
  "TXT_PROJETOS_NOME": "Projeto Exemplo Bairro Alfa",
  "TXT_PROJETOS_DESCRICAO": "Levantamento Topográfico de Lote",
  "TXT_PROJETOS_DATA_INICIO": "YYYY-MM-DDTHH:MM",
  "TXT_PROJETOS_DATA_FIM": "",
  "TXT_PROJETOS_CAMINHO": "Cidades/Bairro Alfa/Loteamento/Quadra01_Lote02"
}
```

| Parâmetro                  | Tipo     | Obrigatório | Descrição                                              |
|----------------------------|----------|-------------|----------------------------------------------------------|
| SID                        | string   | ✅ Sim      | Token de sessão válido                                  |
| SysEntidade                | string   | ✅ Sim      | Nome da entidade (`PROJETO`)                            |
| SysEntidadeAcao            | string   | ✅ Sim      | Nome da ação (`INCLUIR`)                                |
| TXT_PROJETOS_NOME          | string   | ✅ Sim      | Nome identificador do projeto                           |
| TXT_PROJETOS_DESCRICAO     | string   | ✅ Sim      | Descrição do projeto                                    |
| TXT_PROJETOS_DATA_INICIO   | string   | ❌ Não      | Data e hora de início do projeto (formato ISO 8601)     |
| TXT_PROJETOS_DATA_FIM      | string   | ❌ Não      | Data e hora de finalização (pode ser vazio)             |
| TXT_PROJETOS_CAMINHO       | string   | ❌ Não      | Caminho de diretório relativo onde os arquivos serão salvos |

---

#### Comportamento:

- Cria um novo registro no banco de dados com status inicial `ATIVO`.
- Campos em branco como `DATA_FIM` serão considerados nulos.
- Retorna o objeto completo do projeto criado.

---

#### Exemplo de Requisição:

```bash
POST /api HTTP/1.1
Content-Type: application/json

{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "PROJETO",
  "SysEntidadeAcao": "INCLUIR",
  "TXT_PROJETOS_NOME": "Projeto Exemplo Bairro Alfa",
  "TXT_PROJETOS_DESCRICAO": "Levantamento Topográfico de Lote",
  "TXT_PROJETOS_DATA_INICIO": "2025-04-15T20:47",
  "TXT_PROJETOS_DATA_FIM": "",
  "TXT_PROJETOS_CAMINHO": "Cidades/Bairro Alfa/Loteamento/Quadra01_Lote02"
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
    "SUCESSO": "Registro incluído com sucesso!"
  }
}
```

---

#### Observações:

- O campo `CAMINHO` será utilizado para organizar arquivos relacionados ao projeto no sistema de arquivos.
- Caso o `SID` esteja ausente ou inválido, a operação será rejeitada.
