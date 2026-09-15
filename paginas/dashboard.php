<?php
// TRAVA DE SEGURANÇA: Bloqueia acesso direto sem login
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Inclui o cabeçalho padrão do site
require_once '../includes/header.php';
?>

<div class="container my-5">
    <h1 class="mb-4">Painel Administrativo</h1>

    <!-- 1. Cards de Métricas (Componentes Bootstrap) -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total de Categorias</h5>
                    <p class="card-text display-6" id="total-categorias">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Produtos Cadastrados</h5>
                    <p class="card-text display-6" id="total-produtos">0</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Vendas Realizadas</h5>
                    <p class="card-text display-6" id="total-vendas">0</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 1.1. Cards de Algoritmo de Ranking e Destaques (Lógica Avançada) -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-success">Produto de Maior Destaque (Preço Alto)</h5>
                    <p id="maior-destaque-nome" class="card-text fs-5 fw-bold text-dark mb-0">Calculando...</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary">Produto de Menor Destaque (Preço Baixo)</h5>
                    <p id="menor-destaque-nome" class="card-text fs-5 fw-bold text-dark mb-0">Calculando...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 1.2. Card do Algoritmo de Frequência (Produto Mais Vendido) -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-warning fw-bold">🔥 Produto Mais Vendido (Ranking de Frequência)</h5>
                    <p id="produto-mais-vendido" class="card-text fs-5 text-dark mb-0">Calculando o mais vendido...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 1.3. Cards alimentados por objetos do banco (Function + Stored Procedure + View com CTE) -->
    <div class="row mb-4">
        <div class="col-md-7">
            <div class="card shadow-sm h-100">
                <div class="card-header">
                    <h6 class="m-0">Resumo por Categoria <small class="text-muted">(Stored Procedure: sp_resumo_categoria)</small></h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead>
                                <tr>
                                    <th>Categoria</th>
                                    <th>Produtos ativos</th>
                                    <th>Valor em estoque</th>
                                    <th>Status crítico</th>
                                </tr>
                            </thead>
                            <tbody id="tabela-resumo-categoria">
                                <tr><td colspan="4" class="text-center text-muted">Carregando...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card shadow-sm h-100">
                <div class="card-header">
                    <h6 class="m-0">Top vendidos <small class="text-muted">(View: vw_ranking_produtos)</small></h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Qtd. vendida</th>
                                </tr>
                            </thead>
                            <tbody id="tabela-ranking-sql">
                                <tr><td colspan="2" class="text-center text-muted">Carregando...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Tabela Dinâmica do CRUD de Categorias -->
    <div class="card shadow-sm mb-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Gerenciar Categorias</h5>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalCategoria">
                + Nova Categoria
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Badge</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="tabela-categorias">
                        <!-- Os dados em JSON da API de Categorias serão inseridos aqui via JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 3. Tabela Dinâmica do CRUD de Produtos (Entidade 2) -->
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Gerenciar Produtos</h5>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalProduto">
                + Novo Produto
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="tabela-produtos">
                        <!-- Os dados em JSON da API de Produtos serão inseridos aqui via JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 4. Tabela Dinâmica do CRUD de Pedidos (Entidade 3 - Create acontece no checkout, aqui: Read, Update de status e Delete lógico/cancelamento) -->
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="m-0">Gerenciar Pedidos</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Data</th>
                            <th>Itens</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="tabela-pedidos">
                        <!-- Os dados em JSON da API de Pedidos serão inseridos aqui via JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Cadastrar / Editar Categoria -->
<div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="modalCategoriaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCategoriaLabel">Nova Categoria</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form-categoria" enctype="multipart/form-data">
        <div class="modal-body">
            <!-- Campo oculto para guardar o ID durante a edição -->
            <input type="hidden" id="id_categoria" name="id_categoria">

            <div class="mb-3">
                <label for="nm_categoria" class="form-label">Nome da Categoria</label>
                <input type="text" class="form-control" id="nm_categoria" name="nm_categoria" required>
            </div>
            <div class="mb-3">
                <label for="ds_categoria" class="form-label">Descrição da Categoria</label>
                <textarea class="form-control" id="ds_categoria" name="ds_categoria" rows="2" placeholder="Descrição rápida da categoria..."></textarea>
            </div>
            <div class="mb-3">
                <label for="ds_badge" class="form-label">Badge (ex: destaque, hot, novidade)</label>
                <input type="text" class="form-control" id="ds_badge" name="ds_badge">
            </div>
            <div class="mb-3">
                <label for="st_categoria" class="form-label">Status</label>
                <select class="form-select" id="st_categoria" name="st_categoria">
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="img_categoria" class="form-label">Imagem da Categoria</label>
                <input type="file" class="form-control" id="img_categoria" name="img_categoria" accept="image/*">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Salvar Categoria</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal para Cadastrar / Editar Produto -->
<div class="modal fade" id="modalProduto" tabindex="-1" aria-labelledby="modalProdutoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalProdutoLabel">Novo Produto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form-produto" enctype="multipart/form-data">
        <div class="modal-body">
            <!-- Campo oculto para guardar o ID do produto durante a edição -->
            <input type="hidden" id="id_produto" name="id_produto">

            <div class="mb-3">
                <label for="nm_produto" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" id="nm_produto" name="nm_produto" required>
            </div>
            <div class="mb-3">
                <label for="id_categoria_produto" class="form-label">Categoria</label>
                <select class="form-select" id="id_categoria_produto" name="id_categoria" required>
                    <!-- As opções serão preenchidas dinamicamente via JS com as categorias do banco -->
                </select>
            </div>
            <div class="mb-3">
                <label for="ds_produto" class="form-label">Descrição do Produto</label>
                <textarea class="form-control" id="ds_produto" name="ds_produto" rows="3" placeholder="Detalhes, tecido, caimento..."></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="vl_preco" class="form-label">Preço (R$)</label>
                    <input type="number" step="0.01" class="form-control" id="vl_preco" name="vl_preco" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="qt_estoque" class="form-label">Estoque</label>
                    <input type="number" class="form-control" id="qt_estoque" name="qt_estoque" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="st_produto" class="form-label">Status</label>
                <select class="form-select" id="st_produto" name="st_produto">
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="im_produto" class="form-label">Imagem do Produto</label>
                <input type="file" class="form-control" id="im_produto" name="im_produto" accept="image/*">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Salvar Produto</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Script de integração JS da Dashboard -->
<script src="../js/dashboard.js"></script>

<?php
// Inclui o rodapé padrão do site
require_once '../includes/footer.php';
?>