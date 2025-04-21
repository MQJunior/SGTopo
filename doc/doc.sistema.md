# Manual de Integração do Sistema

Este manual documenta todas as entidades, ações e estruturas envolvidas na comunicação com o sistema via API REST.  
Cada entidade do sistema possui seu próprio conjunto de ações documentadas individualmente em arquivos `.md` organizados por pastas.

---

## 📦 Organização

A documentação está organizada da seguinte forma:

- `doc/agendamento/` → Operações relacionadas à entidade **AGENDAMENTO**
- `doc/usuario/` → Operações relacionadas à entidade **USUARIO**
- `doc/rel/` → Relatórios internos de desenvolvimento (notas técnicas, progresso, anotações)

Cada subpasta contém arquivos com nomes no formato:

```
doc.<entidade>.<acao>.md
```

Exemplo:
```
doc.agendamento.listar.md
doc.usuario.login.md
```

---

## 🔌 Integração via API

Todas as operações são realizadas via requisições HTTP `POST` para o endpoint:

```
/api
```

O corpo da requisição deve conter os dados no formato `application/json`, incluindo obrigatoriamente os campos:

| Campo             | Tipo   | Obrigatório | Descrição                                 |
|------------------|--------|-------------|---------------------------------------------|
| SysEntidade       | string | ✅ Sim      | Nome da entidade alvo (ex: `AGENDAMENTO`)   |
| SysEntidadeAcao   | string | ✅ Sim      | Ação que será executada (ex: `LISTAR`)      |
| SID               | string | ❌ Condicional | Token de sessão, obrigatório para ações privadas |

---

## ⚠️ Segurança e Tratamento de Erros

Por motivos de segurança, respostas de erro podem ser padronizadas para não revelar detalhes sensíveis como:

- Nome exato da entidade ou ação informada incorretamente;
- Falta de permissão para determinada operação.

Exemplo de resposta para erro genérico:

```json
{
  "sid": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "SysError": {
    "PERMISSAO": {
      "MENSAGEM": "USUARIO SEM PERMISSÃO!: ENTIDADE -> ACAO"
    }
  }
}
```

> ⚠️ Importante: essa resposta pode ocorrer tanto por falta de permissão quanto por ação ou entidade inválida, dificultando ataques por tentativa e erro.

---

### ⏳ Sessão Expirada

Se a `SID` enviada estiver expirada, removida ou inválida por tempo de inatividade, o sistema retorna o seguinte erro:

```json
{
  "SysError": {
    "SESSAO": {
      "MENSAGEM": "SESSAO INVÁLIDA!"
    }
  }
}
```

> 🔒 A sessão tem validade limitada. Refaça o login para obter uma nova `SID` válida.

---

## 🧠 Observações

- As ações são autodocumentadas: o nome da ação define o comportamento (`INCLUIR`, `ALTERAR`, `CANCELAR`, etc).
- O manual pode ser gerado dinamicamente com base na leitura das pastas e arquivos `.md`.
- Este arquivo serve como ponto de entrada principal para a navegação da documentação.

---

## 📁 Caminhos de Referência

Use este documento para construir a estrutura do seu manual interativo ou gerador automático de documentação.
