# Entidade: AGENDAMENTO

### Descrição Geral:
A entidade **AGENDAMENTO** representa os registros de compromissos ou atividades agendadas no sistema.  
Ela é utilizada para organizar datas, horários, locais e informações associadas a um atendimento, visita técnica, reunião ou qualquer evento relevante do fluxo de trabalho.

---

## Estrutura de Dados

Abaixo estão os campos comumente utilizados na estrutura da entidade:

| Campo         | Tipo      | Descrição                                             |
|---------------|-----------|---------------------------------------------------------|
| CODIGO        | int       | Identificador único do agendamento                     |
| DATA          | date      | Data marcada para o agendamento                        |
| HORA          | time      | Hora marcada                                           |
| DESCRICAO     | string    | Texto descritivo sobre o agendamento                   |
| ENDERECO      | string    | Endereço do local a ser visitado ou atendido           |
| CONTATO       | string    | Pessoa de contato ou telefone associado                |
| LOCAL         | string    | Identificação interna ou localização de referência     |
| OBSERVACOES   | string    | Anotações adicionais livre                             |
| STATUS        | string    | Estado atual do agendamento (ex: PENDENTE, CANCELADO)  |
| REG_ATIVO     | boolean   | Indica se o registro está ativo (`1`) ou inativo (`0`) |
| USUARIO       | string    | Código ou identificação do usuário responsável         |
| SESSAO        | string    | Código da sessão no momento da ação                    |
| DATACRIACAO   | datetime  | Data e hora da criação do agendamento                  |

---

## Observações:

- A entidade **AGENDAMENTO** pode estar relacionada a outras entidades no sistema, como `USUARIO` e `PROJETO`.
- O campo `STATUS` pode variar conforme as ações executadas, e tem papel importante no controle de fluxo.
- As operações sobre esta entidade são feitas exclusivamente via requisições `POST` para o endpoint `/api`.

---

## Localização dos Documentos

Os documentos relacionados a esta entidade estão organizados na pasta:

```
/doc/agendamento/
```

Cada arquivo `.md` dentro desta pasta representa uma ação ou operação possível sobre esta entidade.

---

## Integração com Scripts PHP

Esta entidade é manipulada via API REST, e os scripts PHP clientes devem montar os dados no formato JSON, conforme os exemplos dos arquivos de ação específicos (ex: `alterar`, `consultar`, `listar`, etc).

