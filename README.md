# Grime Shop - Documentação de Banco de Dados

Este arquivo serve como um guia rápido para a banca avaliadora, mostrando exatamente onde cada critério da rubrica de **Modelagem e Banco de Dados** foi aplicado no projeto.

## 🗄️ Mapeamento da Rubrica

### 1. Apresentou o Diagrama de Entidade Relacionamento (DER)
* **Status:** Concluído.
* **Onde encontrar:** Arquivo de imagem enviado nos slides / anexo do projeto.
* **Descrição:** O DER mapeia um ecossistema completo de e-commerce com 13 tabelas normalizadas, cobrindo o fluxo desde o cadastro de pessoas, endereços e gêneros até a gestão de produtos, categorias e itens de pedidos.

### 2. O sistema possui tabelas suficientes (Mínimo 3)
* **Status:** Concluído.
* **Descrição:** A aplicação utiliza ativamente 3 tabelas fundamentais do banco de dados `dbgrime2` para compor as telas e regras de negócio:
  1. `produto`: Armazena as roupas e acessórios cadastrados.
  2. `categoria`: Classifica os produtos (Calças, Camisas, etc.).
  3. `itempedido`: Registra a persistência física dos produtos enviados para a sacola.

### 3. Adição correta de Chaves Primárias (PK)
* **Status:** Concluído.
* **Descrição:** Todas as tabelas do banco contam com chaves primárias numéricas exclusivas e configuradas com `AUTO_INCREMENT` (ex: `id_produto`, `id_categoria`), garantindo a integridade e a unicidade de cada registro.

### 4. O projeto possui ao menos 1 Chave Estrangeira (FK)
* **Status:** Concluído.
* **Onde encontrar:** Arquivo `index.php` (Linha 9) e na exibição dos cards de produtos.
* **Descrição:** A tabela `produto` possui a chave estrangeira `id_categoria` ligada à tabela `categoria`. No código PHP da página principal, há um cruzamento de tabelas via `INNER JOIN` para buscar e exibir dinamicamente o nome correto da categoria de cada produto na tela:
  ```php
  SELECT p.*, c.nm_categoria FROM produto p 
  INNER JOIN categoria c ON p.id_categoria = c.id_categoria

### 5. O projeto possui ao menos 1 relacionamento Muitos para Muitos (N:N)
* **Status:** Concluído.
* **Onde encontrar:** Arquivo `paginas/adicionar_carrinho.php` (linhas 25 a 52) e tabela `itempedido` no banco de dados.
* **Descrição:** O relacionamento de muitos para muitos entre **Pedidos** e **Produtos** foi resolvido através da tabela intermediária (tabela pivô) **`itempedido`**. 
* Sempre que o usuário clica em "Adicionar ao Carrinho", o script PHP intercepta a ação e faz uma gravação física direto no banco de dados na VM, relacionando o código do produto (`id_produto`) ao pedido simulado da Sprint (`id_pedido`), gravando também a quantidade e o valor real capturado dinamicamente da tabela de produtos.
*





## 🌐 Checklist da Rubrica - Redes e Sistemas Operacionais

### 1. Aplicação e Banco de Dados em máquinas separadas
* **Status:** Concluído.
* **Descrição:** Arquitetura distribuída real. A aplicação PHP/Web roda localmente na máquina hospedeira (Host), enquanto o servidor de banco de dados MySQL (`dbgrime2`) está isolado e rodando dentro da Máquina Virtual.

### 2. O Banco de Dados possui IP Fixo
* **Status:** Concluído.
* **Onde encontrar:** Arquivo `config/conexao.php`.
* **Descrição:** A conexão com o banco não utiliza `localhost`. Foi configurado o IP estático da placa de rede da VM para garantir a persistência e comunicação fixa entre os ambientes.

### 3. Aplicação funcionando na porta 8080
* **Status:** Concluído.
* **Descrição:** O servidor web (Apache/PHP) foi configurado para ter as requisições HTTP na porta alternativa `8080`

### 4. Configurar DNS Local para a aplicação
* **Status:** Concluído.
* **Descrição:** Foi alterado o arquivo de mapeamento de hosts do Sistema Operacional (`hosts`), criando o domínio local personalizado `www.grimeshop.local` apontando para a aplicação, simulando um ambiente real de produção.

### 5. Proibir listagem de diretórios
* **Status:** Concluído.
* **Onde encontrar:** Arquivo `.htaccess`.
* **Descrição:** Implementada a segurança que desativa a indexação automática de pastas. Caso um usuário tente acessar uma pasta diretamente (ex: `/includes/` ou `/config/`), o servidor retorna o erro `403 Forbidden` em vez de listar os arquivos do projeto.
*




# 🌐 Checklist da Rubrica - Desenvolvimento Web Moderna

### 1. Layout minimamente agradável e dinâmico com PHP
* **Status:** Concluído.
* **Descrição:** O site adota uma identidade visual urbana e underground inspirada na gótica/cyber (neon vermelho, fundo escuro e contrastes pesados). O dinamismo se dá pelo PHP injetando as informações de produtos em tempo real de acordo com o que está cadastrado no banco.

### 2. Utilização de Template com PHP
* **Status:** Concluído.
* **Onde encontrar:** No topo e na base do arquivo `index.php`.
* **Descrição:** Aplicação do conceito de modularização e reaproveitamento de código utilizando estruturas de template do PHP:
  ```php
  include 'includes/header.php';
  include 'includes/footer.php';

### 3. Utilização de Bootstrap e pelo menos 3 componentes
* **Status:** Concluído.
* **Descrição:** O front-end foi construído sobre o framework Bootstrap, utilizando de forma nativa os componentes:
  1. **Cards (`.card`):** Para envelopar e organizar as informações visuais de cada produto.
  2. **Grid System (`.row` e `.col-md-4`):** Para garantir o alinhamento responsivo da vitrine.
  3. **Buttons (`.btn`):** Estilizados para as ações como "Adicionar ao Carrinho".
  4. **Typography / Utilities:** Classes de posicionamento absoluto, opacidade e margens (`position-relative`, `my-4`, `w-100`).

### 4. Conexão com Banco de Dados
* **Status:** Concluído.
* **Onde encontrar:** Arquivo `config/conexao.php` integrado via `include` no topo das páginas.
* **Descrição:** Conexão ativa estabelecida via extensão `mysql` do PHP, comunicando-se diretamente com a base de dados `dbgrime2`.

### 5. Dados recuperados do banco e demonstrados na tela
* **Status:** Concluído.
* **Onde encontrar:** Na vitrine principal do `index.php`.
* **Descrição:** Os campos `nm_produto`, `ds_produto`, `vl_produto` e a imagem `im_produto` são extraídos dinamicamente do banco de dados MySQL e renderizados dentro do HTML do card.

### 6. Correta utilização de comandos no PHP (IF, WHILE, FOREACH)
* **Status:** Concluído.
* **Onde encontrar:** No laço de repetição da vitrine no `index.php`.
* **Descrição:** Uso do laço `while` integrado ao método `fetch_assoc()` para iterar sobre os registros retornados do banco de dados, renderizando dinamicamente um card HTML para cada produto retornado enquanto houver dados na consulta. Também são utilizados blocos condicionais `if` para validações estruturais ao longo do fluxo de dados.
*





## 🟣 3. Checklist da Rubrica - Tech Forge (Lógica e Algoritmos)

### 1 Armazenamento Estruturado com Arrays
* **Status:** Concluído.
* **Onde encontrar:** Arquivo `carrinho.php` (Linhas 8 a 12 e parâmetros das funções).
* **Descrição:** Uso de estruturas de dados complexas e coleções. O sistema gerencia os cupons disponíveis através de um array multidimensional associativo (`$cuponsDisponiveis`) contendo chaves para código, valor e status, além de manipular os produtos do carrinho estruturados em arrays.

### 2 Modularização com Funções de Processamento
* **Status:** Concluído.
* **Onde encontrar:** Arquivo `carrinho.php` (Linhas 17, 32 e 43).
* **Descrição:** O código foi modularizado com funções personalizadas de back-end focado em regras de negócio: `calcularSubtotalCarrinho()`, `filtrarCupomPHP()` e `obterDestaquesCarrinho()`.

### 3 Fluxo de Dados (Parâmetros e Retorno)
* **Status:** Concluído.
* **Onde encontrar:** Arquivo `carrinho.php` (Cláusulas `return` nas linhas 20, 29, 35, 37 e 50).
* **Descrição:** Isolamento completo de escopo. As funções recebem dados estritamente por parâmetros tipados (como `array` e `string`) e devolvem os dados processados para o fluxo principal obrigatoriamente através da instrução `return` (`return $soma;`, `return $cupom;` e `return $destaques;`).

### 4 Lógica de Pesquisa ou Filtro
* **Status:** Concluído.
* **Onde encontrar:** Arquivo `carrinho.php` (Funções `filtrarCupomPHP` e `obterDestaquesCarrinho`).
* **Descrição:** Implementação de algoritmos de varredura e filtragem sobre coleções:
  1. `filtrarCupomPHP`: Varre o array de cupons procurando a correspondência exata do código digitado.
  2. `obterDestaquesCarrinho`: Aplica um filtro de corte no array de produtos salvos para isolar e criar uma sublista contendo apenas itens exclusivos de grife (com valores superiores a R$ 150,00) que é renderizada na tela.

### 5 Validação de Regras de Negócio com Condicionais
* **Status:** Concluído.
* **Onde encontrar:** Arquivo `carrinho.php` (Estruturas `if` nas linhas 19, 26, 34, 46 e 62).
* **Descrição:** Uso de controle de fluxo condicional para blindagem de regras do e-commerce. O sistema valida se o carrinho está vazio antes de calcular valores (`if (empty($itens_carrinho))`), verifica se o cupom pesquisado está ativo (`$cupom['ativo'] === true`) e impede a renderização do bloco de destaques na tela caso nenhum produto atinja o teto estipulado.
*