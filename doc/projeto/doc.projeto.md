# Entidade: PROJETO

### Descrição Geral:
A entidade **PROJETO** representa um agrupamento lógico de serviços, arquivos e informações relacionados a uma atividade de levantamento, regularização, demarcação, entre outros.  
Cada projeto pode conter múltiplos imóveis, documentos e etapas distintas.

---

## 🗃️ Estrutura de Dados

| Campo         | Tipo         | Nulo | Padrão     | Descrição                                                                 |
|---------------|--------------|------|------------|---------------------------------------------------------------------------|
| CODIGO        | int          | Não  | —          | Identificador único do projeto (chave primária, auto incremento)         |
| NOME          | varchar(100) | Não  | —          | Nome do projeto                                                           |
| DESCRICAO     | text         | Sim  | NULL       | Descrição detalhada do projeto                                           |
| DATA_INICIO   | datetime     | Sim  | NULL       | Data e hora de início planejado do projeto                               |
| DATA_FIM      | datetime     | Sim  | NULL       | Data e hora de encerramento (se aplicável)                               |
| STATUS        | enum         | Não  | ATIVO      | Situação atual do projeto (`ATIVO`, `CONCLUIDO`, `CANCELADO`, `PENDENTE`)|
| CAMINHO       | varchar(255) | Sim  | NULL       | Caminho relativo dos arquivos associados ao projeto                      |
| SESSAO        | int          | Sim  | —          | Código da sessão em que a ação foi realizada                             |
| USUARIO       | int          | Não  | —          | Código do usuário que criou ou alterou o projeto                         |
| DATACRIACAO   | datetime     | Não  | CURRENT_TIMESTAMP | Data e hora da criação do registro                                |
| REG_ATIVO     | tinyint(1)   | Não  | 1          | Flag de ativação lógica do registro (`1` = ativo, `0` = inativo)         |

---

## 🔄 Comportamento Esperado

- O campo `STATUS` define o estágio atual do projeto.
- O `CAMINHO` é utilizado para estruturar os arquivos no sistema de pastas (local ou remoto).
- O campo `REG_ATIVO` permite desativação lógica sem excluir o registro.
- A criação e alteração de projetos são registradas com `USUARIO`, `SESSAO` e `DATACRIACAO`.

---

## 🧩 Relacionamentos

- O campo `USUARIO` é uma chave estrangeira, indicando quem realizou a operação.
- Projetos podem se relacionar com imóveis, serviços, arquivos e ordens de serviço, dependendo da arquitetura do sistema.

---

## 📁 Localização da Documentação

A documentação das ações relacionadas a essa entidade pode ser encontrada em:

```
/doc/projeto/
```

Exemplo de ações disponíveis:

- `doc.projeto.incluir.md`
- `doc.projeto.alterar.md`
- `doc.projeto.consultar.md`

---

## Observações:

- Todos os acessos e alterações à entidade PROJETO devem ser feitos via API REST.
- A entidade é central no sistema SGTopo, servindo como núcleo de agrupamento para os demais registros técnicos e documentais.
