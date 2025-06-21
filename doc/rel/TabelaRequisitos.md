# Entidades e Ações do Sistema

| **Entidade**                  | **Ação**                             | **Descrição da Ação**                                                                 |
|------------------------------|--------------------------------------|----------------------------------------------------------------------------------------|
| **Projeto**                  | Criar                                | Inicia um novo projeto definindo nome e diretório.                                     |
|                              | Alterar                              | Permite editar dados já existentes do projeto.                                         |
|                              | Selecionar diretório                 | Define onde os arquivos do projeto serão armazenados.                                  |
|                              | Configurar geodésia                  | Escolhe tipo de georreferenciamento (topográfica ou geodésica).                        |
|                              | Definir sistema geodésico            | Define sistema UTM, fuso e hemisfério.                                                 |
|                              | Associar cliente                     | Relaciona o projeto ao cliente proprietário.                                           |
|                              | Associar profissional responsável    | Define o técnico legalmente responsável pelo projeto.                                  |
|                              | Inserir número da ART/RRT            | Adiciona o número de registro profissional obrigatório.                                |
|                              | Listar                               | Exibe todos os projetos cadastrados.                                                   |
|                              | Excluir                              | Remove projeto do sistema.                                                             |
|---|---|---|
| **Desenho**                  | Criar                                | Inicia novo desenho vinculado ao projeto.                                              |
|                              | Editar nome                          | Altera o nome do desenho atual.                                                        |
|                              | Centralizar                          | Centraliza a vista do desenho no CAD.                                                  |
|                              | Associar ao projeto                  | Relaciona o desenho ao projeto selecionado.                                            |
|                              | Selecionar camada                    | Define camada (cor, tipo, espessura) para elementos do desenho.                        |
|---|---|---|
| **Empresa**                  | Cadastrar                            | Insere nova empresa no banco de dados.                                                 |
|                              | Alterar                              | Edita os dados da empresa existente.                                                   |
|                              | Selecionar                           | Escolhe uma empresa previamente cadastrada.                                            |
|                              | Listar                               | Exibe todas as empresas cadastradas.                                                   |
|---|---|---|
| **Cliente**                  | Cadastrar                            | Insere o nome do proprietário ou contratante.                                          |
|                              | Editar                               | Altera os dados do cliente.                                                            |
|                              | Listar                               | Exibe os clientes cadastrados.                                                         |
|                              | Selecionar                           | Escolhe um cliente para vincular ao projeto.                                           |
|---|---|---|
| **Profissional**             | Cadastrar                            | Registra técnico responsável (com CREA/CAU).                                           |
|                              | Editar                               | Atualiza dados do profissional.                                                        |
|                              | Listar                               | Mostra lista de profissionais cadastrados.                                             |
|                              | Selecionar                           | Define qual profissional responde pelo projeto.                                        |
|---|---|---|
| **Imóvel**                   | Selecionar                           | Escolhe um imóvel existente no sistema.                                                |
|                              | Listar                               | Exibe todos os imóveis cadastrados.                                                    |
|                              | Associar ao projeto                  | Relaciona um imóvel ao projeto ativo.                                                  |
|---|---|---|
| **Ponto**                    | Importar                             | Adiciona pontos a partir de arquivos externos.                                         |
|                              | Verificar (`eva`)                    | Executa comando para conferência dos dados dos pontos.                                 |
|                              | Validar sigmas                       | Confirma a presença de sigmas (latitude, longitude, altitude).                         |
|---|---|---|
| **Confrontante (linha)**     | Desenhar                             | Traça confrontantes com base nos pontos importados.                                    |
|                              | Repetir comando                      | Usa atalho para continuar desenhando sem reiniciar.                                    |
|                              | Inserir dados                        | Adiciona informações como nome, matrícula, tipo de limite, etc.                        |
|                              | Editar tipo de limite                | Define se o limite é estrada, propriedade, etc.                                        |
|                              | Posicionar texto                     | Posiciona os textos informativos no desenho.                                           |
|                              | Listar                               | Exibe confrontantes existentes no projeto.                                             |
|                              | Excluir                              | Remove confrontante desenhado.                                                         |
|---|---|---|
| **Gleba**                    | Criar                                | Gera uma nova gleba com base em confrontantes.                                         |
|                              | Editar                               | Permite ajustes na gleba desenhada.                                                    |
|                              | Selecionar                           | Escolhe uma gleba cadastrada para edição ou relatório.                                 |
|                              | Definir ponto mais ao norte          | Identifica o ponto inicial para planilha SIGEF.                                        |
|                              | Inserir métodos de posicionamento    | Atribui método (GPS, estação, etc.) aos vértices.                                      |
|---|---|---|
| **Tabela (Áreas/Perímetros)**| Inserir                              | Gera a tabela com áreas e perímetros da gleba.                                         |
|                              | Editar                               | Permite alterar conteúdo e layout da tabela.                                           |
|                              | Posicionar                           | Define onde a tabela será colocada no desenho.                                         |
|                              | Configurar sistema de referência     | Define se usa SGL/INCRA ou outro sistema.                                              |
|                              | Compatibilizar com INCRA            | Ajusta dados conforme exigências do SIGEF/INCRA.                                       |
|---|---|---|
| **Tabela Geodésica**         | Inserir                              | Gera tabela geodésica com coordenadas e atributos.                                     |
|                              | Editar                               | Altera dados, estilo e dimensões da tabela.                                            |
|                              | Posicionar                           | Escolhe onde fixar a tabela no layout.                                                 |
|                              | Configurar dados                     | Define precisão, formato e outras opções do INCRA.                                     |
|---|---|---|
| **Planta de Situação**       | Inserir                              | Adiciona mini mapa da área no layout final.                                            |
|                              | Redimensionar                        | Ajusta tamanho da planta de situação.                                                  |
|                              | Posicionar                           | Define local de inserção na folha.                                                     |
|                              | Editar atributos                     | Permite alterar informações da planta no layout.                                       |
|---|---|---|
| **Norte da Quadrícula**      | Inserir                              | Adiciona o símbolo do norte geográfico no layout.                                      |
|                              | Editar                               | Permite modificar atributos do símbolo inserido.                                       |
|                              | Posicionar                           | Define a posição na folha do norte da quadrícula.                                      |
|---|---|---|
| **Malha de Coordenadas**     | Inserir                              | Cria malha de coordenadas UTM ou geográficas.                                          |
|                              | Editar                               | Altera tipo, espaçamento ou estilo da malha.                                           |
|                              | Recortar                             | Permite remover parte da malha excedente.                                              |
|                              | Escolher tipo                        | Define se a malha será cartesiana ou geográfica.                                       |
|---|---|---|
| **Relatório SIGEF**          | Gerar planilha                       | Cria a planilha de coordenadas para o SIGEF.                                           |
|                              | Nomear                               | Define o nome do arquivo gerado.                                                       |
|                              | Validar                              | Verifica consistência dos dados conforme SIGEF.                                        |
|                              | Conferir dados                       | Revisar nomes, métodos, limites, CNS, matrícula, etc.                                  |
|---|---|---|
| **Memorial Descritivo**      | Gerar                                | Cria documento técnico com descrição do perímetro.                                     |
|                              | Configurar sistema                   | Define sistema de coordenadas e referência.                                            |
|                              | Validar                              | Verifica compatibilidade do memorial com exigências do SIGEF.                          |
|                              | Nomear                               | Define o nome do documento gerado.                                                     |
|---|---|---|
| **Google Earth (Visualização)** | Visualizar área                  | Exibe o polígono do projeto no Google Earth.                                           |
