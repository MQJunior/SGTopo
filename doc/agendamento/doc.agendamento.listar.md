## AGENDAMENTO - LISTAR

### Entidade: AGENDAMENTO  
### Ação: LISTAR

#### Descrição:
Executa a listagem de registros da tabela de agendamentos com base em filtros opcionais.  
Pode retornar registros ativos ou inativos, com ou sem limite de quantidade.

#### Parâmetros:

- Filtros (array) — **não obrigatório**  
  Array associativo contendo os campos e valores para filtro.  
  Exemplo: ['STATUS' => 'PENDENTE', 'DATA' => '2025-04-17']

- Inativos (boolean) — **não obrigatório**  
  Define se devem ser incluídos registros inativos (REG_ATIVO = 0).  
  Valor padrão: false (retorna apenas registros ativos)

- QtdeReg (int) — **não obrigatório**  
  Quantidade máxima de registros a serem retornados.  
  Valor padrão: null (sem limite)

#### Comportamento:

- Se nenhum parâmetro for informado, retorna todos os registros ativos.
- Se `Inativos = true`, ignora o filtro `REG_ATIVO = 1`.
- Filtros são aplicados como cláusulas AND no WHERE.
- O resultado da consulta é armazenado em:
  `$this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['DADOS']`

#### Exemplos de uso:

1. Listar todos os agendamentos ativos:
   ```php
   $AGENDAMENTO->Listar();
   ```

2. Listar registros filtrando por status:
   ```php
   $AGENDAMENTO->Listar(['STATUS' => 'PENDENTE']);
   ```

3. Listar inativos com limite:
   ```php
   $AGENDAMENTO->Listar(['LOCAL' => 'Campo 1'], true, 10);
   ```

#### SQL Gerado (exemplo):
```sql
SELECT Agendamento.*
FROM TBL_AGENDAMENTO AS Agendamento
WHERE Agendamento.REG_ATIVO = 1
  AND Agendamento.`STATUS` = 'PENDENTE'
  AND Agendamento.`DATA` = '2025-04-17'
ORDER BY Agendamento.DATA
LIMIT 20
```

#### Observações:

- Campos usados nos filtros devem corresponder exatamente aos nomes no banco de dados.
- Para segurança, os valores são sanitizados com `addslashes()`.
- O resultado é ordenado por `DATA` de forma crescente.
