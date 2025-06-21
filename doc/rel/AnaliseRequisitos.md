---
## 0. Cadastro de Pessoas

Antes de iniciar o projeto, é necessário cadastrar:

### Cliente
* Nome completo ou razão social
* CPF ou CNPJ
* Telefone, e-mail e endereço

### Profissional Responsável
* Nome completo
* CREA ou CAU
* Especialidade
* Número da ART ou RRT
* Contato (telefone, e-mail)

---


---
## 1. Criação e Configuração Inicial do Projeto

* **Criar um novo projeto**: Nomeie o projeto e defina o local onde ele será salvo. O software cria uma pasta padrão, mas você pode escolher outro diretório.
* **Preencher o banco de dados do programa**: Insira e salve dados, como informações de cadastro, seja inicialmente ou posteriormente na etapa de "criar/alterar projeto".
* **Configurações gerais e geodésia**:
    * Escolher o **tipo de georreferenciamento**:
        * **Poligonal Topográfica**: Para projetos com dados de estação total e GPS.
        * **Poligonal Geodésica**: Para projetos com apenas dados de GPS.
    * Selecionar o **sistema geodésico** a ser utilizado.
* **Criar um novo desenho**: Nomeie o novo desenho.
* **Conferir sistema geodésico de referência**: Verifique o sistema de coordenadas planas, o fuso UTM e o hemisfério (ex: fuso 22).
* **Criar/Alterar Projeto (Complementar)**: Se o banco de dados não foi preenchido no início, faça-o agora, inserindo novos dados ou selecionando cadastros pré-existentes.
* **Preencher dados da empresa**: Insira informações da empresa, podendo ser um novo cadastro ou selecionando um já existente e, se necessário, alterá-lo.
* **Selecionar dados do imóvel**: Escolha cadastros de imóveis já preparados.

---
## 2. Importação e Conferência dos Pontos

* **Importar pontos**: Escolha o tipo de arquivo a ser importado (ex: relatório do Easy Surf), selecione o arquivo e abra-o.
* **Conferência Obrigatória dos Pontos**: É **mandatório** que os pontos importados contenham o **sigma da latitude, longitude e altitude**.
* **Verificação**: Para conferir, digite o comando `eva`, aperte Enter, selecione o ponto, aperte Enter novamente, e escolha o tipo de dados "georreferenciamento". Isso permite verificar se todos os sigmas necessários estão presentes.

---
## 3. Desenho e Definição dos Confrontantes

* **Configurar engate (snap)**: Clique com o botão direito, selecione "engate" e "objeto ligado", e escolha os tipos de engate desejados.
* **Definir camada de desenho**: Escolha a cor, o tipo e a espessura da linha para desenhar os confrontantes.
* **Desenhar confrontantes**: Utilize a ferramenta "polilinha" para engatar nos pontos correspondentes e desenhar cada confrontante. Após desenhar o primeiro, você pode usar a barra de espaço para repetir o comando e continuar desenhando os demais confrontantes, engatando a nova polilinha no último ponto engatado.
* **Finalizar e Centralizar**: Pressione Esc para soltar a ferramenta e F4 para centralizar o desenho no CAD. Cada polilinha desenhada corresponderá a um confrontante.

---
## 4. Definição da Escala do Projeto

* **Definir escala**: Selecione a área do projeto, escolha a folha a ser usada (o software calcula uma escala para cada folha).
* **Inserir malha de coordenadas (opcional)**: Você pode escolher inserir a malha de coordenadas neste momento ou posteriormente.
* **Editar atributos da folha**: É possível editar os atributos da folha ou inserir mais informações.
* **Visualização da malha**: Dê dois cliques na malha de coordenadas para escolher outro tipo (ex: "borda") e selecionar se será em coordenadas cartesianas ou geográficas.
* **Recortar malha de coordenadas (opcional)**.

---
## 5. Inserção e Edição das Informações dos Confrontantes

* **Inserir/Editar confrontante**: Selecione a polilinha do confrontante e pressione Enter.
* **Definir tipo de limite**: Escolha o tipo de limite (ex: propriedade, estrada).
* **Inserir dados**: Preencha informações como proprietário, propriedade, matrícula, comarca, código SMCR, código CNS. Para estradas, insira a largura ou faixa de domínio e o nome da estrada.
* **Posicionar e fixar texto**: Após inserir as informações, elas ficam no ponteiro do cursor para que você escolha o local no desenho para fixá-las.
* **Repetir processo**: Use a barra de espaço para repetir o comando para os próximos confrontantes.

---
## 6. Criação e Gerenciamento da Gleba

* **Criar gleba**: Selecione todas as polilinhas que compõem a gleba e pressione Enter. Em seguida, clique no interior da gleba e insira seu nome e matrícula.
* **Gerenciar glebas**: Selecione a gleba criada e clique em "editar".
* **Ponto mais ao norte**: Clique em "ponto mais ao norte" para que este seja o primeiro ponto na lista de coordenadas da planilha SIGEF.
* **Inserir métodos de posicionamento**: Selecione as células correspondentes aos pontos e o método aplicado. É possível selecionar várias células de uma vez.

---
## 7. Inserção de Tabelas de Áreas e Perímetros e Sistema Geodésico

* **Inserir áreas e perímetros**: Selecione a gleba e clique OK.
* **Configurações da tabela**:
    * Escolha o **sistema de referência** (SGL para INCRA).
    * Modifique coordenadas arbitrárias de origem (se necessário).
    * **Compatibilizações com INCRA**: Reduza a precisão das coordenadas geodésicas (casas decimais) e escolha remover a casa dos segundos dos azimutes (verdadeiro/falso).
* **Posicionar e fixar tabela**: A tabela fica posicionada no cursor para que você a mova e fixe no desenho.
* **Editar tabela**: Dê dois cliques na tabela para editar título, estilo da fonte, altura do texto, alinhamento, adicionar/remover linhas e colunas, e ajustar dimensões.
* **Inserir tabela em sistema geodésico**: Clique no interior da gleba e configure as compatibilizações com INCRA.
* **Posicionar e fixar tabela**: Similar à tabela de áreas e perímetros.
* **Editar tabela**: Da mesma forma que a tabela de áreas e perímetros.

---
## 8. Inserção da Planta de Situação e Norte da Quadrícula

* **Inserir planta de situação**: Determine o primeiro e segundo canto no espaço reservado da folha, arraste, desenhe a gleba no mapa e ajuste a área.
* **Inserir norte da quadrícula**: Escolha o ponto mais ao norte, revise e modifique informações, edite atributos, e posicione o desenho do norte da quadrícula na folha.
* **Inserir malha (opcional)**: Se a malha não foi inserida com a folha, pode ser inserida agora.
* **Outras funcionalidades**: Criar planta do projeto, tirar polígono da área (polígono matrícula), e atualizar dados da folha.

---
## 9. Visualização e Geração de Relatórios Finais

* **Visualizar área no Google Earth**: Permite visualizar a área do projeto no Google Earth para uma conferência visual.
* **Gerar a Planilha SIGEF**:
    * Acesse o menu "relatórios" e selecione "gerar planilha sigef".
    * Escolha a gleba(s), nomeie a planilha e selecione se será em coordenadas geográficas ou UTM.
    * **Conferência da Planilha SIGEF**: Após a geração, é crucial conferir os nomes dos vértices, coordenadas de longitude e latitude, sigmas de longitude, latitude e altura, métodos de posicionamento, tipos de limite, códigos CNS, matrículas e o descritivo dos confrontantes.
    * **Aba "Identificação"**: Verifique as informações de identificação do serviço, do detentor e da área.
    * **Validação da Planilha**: No menu SIGEF da planilha, clique em "validação". A janela indicará se "identificação ok" e "perímetro ok" ou descreverá os erros para correção.
* **Gerar Memorial Descritivo**:
    * Acesse o menu "relatórios" e selecione "memorial descritivo".
    * Selecione a gleba e configure novamente o sistema de referência, coordenadas arbitrárias de origem e as compatibilizações com INCRA.
    * Nomeie o memorial ou mantenha a sugestão do software, e abra-o.