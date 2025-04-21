## PROJETO - ALTERAR

### Entidade: PROJETO  
### Ação: ALTERAR  
### Método: `POST`  
### Endpoint: `/api`

#### Descrição:
Atualiza os dados de um projeto existente com base na chave primária (`txtChaveRegistro`).  
Pode alterar nome, descrição, datas e caminho de armazenamento do projeto.

---

#### Parâmetros (JSON no corpo da requisição):

```json
{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "PROJETO",
  "SysEntidadeAcao": "ALTERAR",
  "txtChaveRegistro": "99",
  "TXT_PROJETOS_NOME": "Projeto Atualizado Bairro Exemplo",
  "TXT_PROJETOS_DESCRICAO": "Nova descrição detalhada do projeto",
  "TXT_PROJETOS_DATA_INICIO": "YYYY-MM-DDTHH:MM",
  "TXT_PROJETOS_DATA_FIM": "YYYY-MM-DDTHH:MM",
  "TXT_PROJETOS_CAMINHO": "Cidades/Exemplo/Bairro/Projeto_Atualizado"
}
```

| Parâmetro                  | Tipo     | Obrigatório | Descrição                                              |
|----------------------------|----------|-------------|----------------------------------------------------------|
| SID                        | string   | ✅ Sim      | Token de sessão válido                                  |
| SysEntidade                | string   | ✅ Sim      | Nome da entidade (`PROJETO`)                            |
| SysEntidadeAcao            | string   | ✅ Sim      | Nome da ação (`ALTERAR`)                                |
| txtChaveRegistro           | string   | ✅ Sim      | Código do projeto a ser alterado                        |
| TXT_PROJETOS_NOME          | string   | ✅ Sim      | Novo nome do projeto                                    |
| TXT_PROJETOS_DESCRICAO     | string   | ✅ Sim      | Nova descrição                                           |
| TXT_PROJETOS_DATA_INICIO   | string   | ❌ Não      | Nova data/hora de início                                |
| TXT_PROJETOS_DATA_FIM      | string   | ❌ Não      | Nova data/hora de fim                                   |
| TXT_PROJETOS_CAMINHO       | string   | ✅ Sim      | Caminho atualizado do projeto no sistema de arquivos    |

---

#### Comportamento:

- Substitui os valores antigos pelos novos dados informados.
- Campos de data podem ser vazios para indicar ausência.
- Retorna os dados atualizados do projeto.

---

#### Exemplo de Requisição:

```bash
POST /api HTTP/1.1
Content-Type: application/json

{
  "SID": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysEntidade": "PROJETO",
  "SysEntidadeAcao": "ALTERAR",
  "txtChaveRegistro": "99",
  "TXT_PROJETOS_NOME": "Projeto Atualizado Bairro Exemplo",
  "TXT_PROJETOS_DESCRICAO": "Nova descrição detalhada do projeto",
  "TXT_PROJETOS_DATA_INICIO": "2025-04-14T19:25",
  "TXT_PROJETOS_DATA_FIM": "2025-04-17T19:26",
  "TXT_PROJETOS_CAMINHO": "Cidades/Exemplo/Bairro/Projeto_Atualizado"
}
```

---

### Retorno (JSON):

```json
{
  "projeto": {
    "CODIGO": "99",
    "NOME": "Projeto Atualizado Bairro Exemplo",
    "DESCRICAO": "Nova descrição detalhada do projeto",
    "DATA_INICIO": "YYYY-MM-DD HH:MM:SS",
    "DATA_FIM": "YYYY-MM-DD HH:MM:SS",
    "STATUS": "ATIVO",
    "CAMINHO": "Cidades/Exemplo/Bairro/Projeto_Atualizado",
    "SESSAO": "Id da Sessao",
    "USUARIO": "Id do Usuario",
    "DATACRIACAO": "YYYY-MM-DD HH:MM:SS",
    "REG_ATIVO": "1"
  },
  "sid": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysMensagem": {
    "SUCESSO": "Alteração realizada com sucesso!"
  }
}
```

---

#### Observações:

- Campos não informados manterão os valores anteriores.
- O `CAMINHO` pode ser usado para reestruturar o local dos arquivos do projeto.
