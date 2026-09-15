"use strict";
const STATUS_PEDIDO_VALIDOS = ['Processando', 'Pago', 'Enviado', 'Entregue', 'Cancelado'];
// ---------------------------------------------------------------------------
// Bootstrap inicial
// ---------------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', () => {
    carregarCategorias();
    carregarProdutos();
    carregarVendas();
    carregarRankingMaisVendido();
    carregarResumoCategoria();
    carregarRankingSQL();
    carregarPedidos();
    const modalCatEl = document.getElementById('modalCategoria');
    if (modalCatEl) {
        modalCatEl.addEventListener('hidden.bs.modal', () => {
            const formCat = document.getElementById('form-categoria');
            if (formCat)
                formCat.reset();
            const idCat = document.getElementById('id_categoria');
            if (idCat)
                idCat.value = '';
            const labelCat = document.getElementById('modalCategoriaLabel');
            if (labelCat)
                labelCat.textContent = 'Nova Categoria';
        });
    }
    const modalProdEl = document.getElementById('modalProduto');
    if (modalProdEl) {
        modalProdEl.addEventListener('hidden.bs.modal', () => {
            const formProd = document.getElementById('form-produto');
            if (formProd)
                formProd.reset();
            const idProd = document.getElementById('id_produto');
            if (idProd)
                idProd.value = '';
            const labelProd = document.getElementById('modalProdutoLabel');
            if (labelProd)
                labelProd.textContent = 'Novo Produto';
        });
    }
    const formCategoria = document.getElementById('form-categoria');
    if (formCategoria) {
        formCategoria.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(formCategoria);
            try {
                const response = await fetch('../api/salvar_categoria.php', {
                    method: 'POST',
                    body: formData
                });
                const res = await response.json();
                alert(res.mensagem || (res.status ? 'Categoria salva com sucesso!' : 'Erro ao salvar.'));
                if (res.status && modalCatEl) {
                    const modalInstance = bootstrap.Modal.getInstance(modalCatEl) || new bootstrap.Modal(modalCatEl);
                    modalInstance.hide();
                    carregarCategorias();
                }
            }
            catch (error) {
                console.error('Erro ao salvar categoria:', error);
                alert('Erro de conexão ao salvar categoria.');
            }
        });
    }
    const formProduto = document.getElementById('form-produto');
    if (formProduto) {
        formProduto.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(formProduto);
            try {
                const response = await fetch('../api/salvar_produto.php', {
                    method: 'POST',
                    body: formData
                });
                const res = await response.json();
                alert(res.mensagem || (res.status ? 'Operação realizada com sucesso!' : 'Erro ao processar requisição.'));
                if (res.status && modalProdEl) {
                    const modalInstance = bootstrap.Modal.getInstance(modalProdEl) || new bootstrap.Modal(modalProdEl);
                    modalInstance.hide();
                    carregarProdutos();
                }
            }
            catch (error) {
                console.error('Erro ao salvar produto:', error);
                alert('Erro de conexão com o servidor ao salvar produto.');
            }
        });
    }
});
function obterCaminhoImagem(nomeImagem) {
    var _a;
    if (!nomeImagem)
        return null;
    const apenasNome = (_a = nomeImagem.split('/').pop()) === null || _a === void 0 ? void 0 : _a.split('\\').pop();
    if (!apenasNome)
        return null;
    return `../images/${apenasNome}`;
}
// ---------------------------------------------------------------------------
// CATEGORIAS
// ---------------------------------------------------------------------------
async function carregarCategorias() {
    try {
        const response = await fetch('../api/categorias.php');
        const categorias = await response.json();
        // Uso de Filter: isola apenas as categorias ativas
        const categoriasAtivas = categorias.filter((c) => c.st_categoria === 'ativo');
        const elTotalCat = document.getElementById('total-categorias');
        if (elTotalCat)
            elTotalCat.textContent = String(categoriasAtivas.length);
        const tbody = document.getElementById('tabela-categorias');
        const selectCategoriaProd = document.getElementById('id_categoria_produto');
        if (tbody)
            tbody.innerHTML = '';
        if (selectCategoriaProd)
            selectCategoriaProd.innerHTML = '<option value="">Selecione uma Categoria...</option>';
        categorias.forEach((cat) => {
            if (selectCategoriaProd && (cat.st_categoria === 'ativo' || !cat.st_categoria)) {
                const option = document.createElement('option');
                option.value = String(cat.id_categoria);
                option.textContent = cat.nm_categoria;
                selectCategoriaProd.appendChild(option);
            }
            if (tbody) {
                const tr = document.createElement('tr');
                const statusCat = cat.st_categoria || 'ativo';
                const botaoAcao = statusCat === 'ativo'
                    ? `<button class="btn btn-sm btn-outline-danger" onclick="desativarCategoria(${cat.id_categoria})">Desativar</button>`
                    : `<button class="btn btn-sm btn-outline-success" onclick="reativarCategoria(${cat.id_categoria})">Reativar</button>`;
                const catJson = JSON.stringify(cat).replace(/"/g, '&quot;');
                const nomeImg = cat.img_categoria || cat.im_categoria;
                const srcImg = obterCaminhoImagem(nomeImg);
                const imagemCat = srcImg
                    ? `<img src="${srcImg}" alt="${cat.nm_categoria}" style="width: 40px; height: 40px; object-fit: cover;" class="rounded" onerror="this.onerror=null; this.src='../images/${(nomeImg || '').split('/').pop()}';">`
                    : `<span class="badge bg-secondary">Sem foto</span>`;
                tr.innerHTML = `
                    <td>${cat.id_categoria}</td>
                    <td>${imagemCat}</td>
                    <td><strong>${cat.nm_categoria}</strong></td>
                    <td><span class="badge bg-secondary">${cat.ds_badge || ''}</span></td>
                    <td><span class="badge ${statusCat === 'ativo' ? 'bg-success' : 'bg-danger'}">${statusCat}</span></td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-warning me-1" onclick="abrirEdicaoCategoria(${catJson})">Editar</button>
                        ${botaoAcao}
                    </td>
                `;
                tbody.appendChild(tr);
            }
        });
    }
    catch (error) {
        console.error('Erro ao carregar categorias:', error);
    }
}
function abrirEdicaoCategoria(cat) {
    const idCatEl = document.getElementById('id_categoria');
    if (idCatEl)
        idCatEl.value = String(cat.id_categoria);
    const nmCatEl = document.getElementById('nm_categoria');
    if (nmCatEl)
        nmCatEl.value = cat.nm_categoria;
    const dsCatEl = document.getElementById('ds_categoria');
    if (dsCatEl)
        dsCatEl.value = cat.ds_categoria || '';
    const dsBadgeEl = document.getElementById('ds_badge');
    if (dsBadgeEl)
        dsBadgeEl.value = cat.ds_badge || '';
    const stCatEl = document.getElementById('st_categoria');
    if (stCatEl)
        stCatEl.value = cat.st_categoria || 'ativo';
    const lblCatEl = document.getElementById('modalCategoriaLabel');
    if (lblCatEl)
        lblCatEl.textContent = 'Editar Categoria';
    const modalEl = document.getElementById('modalCategoria');
    if (modalEl) {
        const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
        modal.show();
    }
}
async function desativarCategoria(id) {
    if (!confirm('Tem certeza que deseja desativar esta categoria?'))
        return;
    try {
        const response = await fetch('../api/excluir_categoria.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id_categoria: id })
        });
        const res = await response.json();
        alert(res.mensagem || 'Categoria desativada.');
        if (res.status)
            carregarCategorias();
    }
    catch (error) {
        console.error('Erro ao desativar categoria:', error);
    }
}
async function reativarCategoria(id) {
    if (!confirm('Deseja reativar esta categoria?'))
        return;
    try {
        const response = await fetch('../api/reativar_categoria.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id_categoria: id })
        });
        const res = await response.json();
        alert(res.mensagem || 'Categoria reativada.');
        if (res.status)
            carregarCategorias();
    }
    catch (error) {
        console.error('Erro ao reativar categoria:', error);
    }
}
// ---------------------------------------------------------------------------
// PRODUTOS E LÓGICA AVANÇADA (reduce / filter / map)
// ---------------------------------------------------------------------------
async function carregarProdutos() {
    try {
        const response = await fetch(`../api/produtos.php?t=${new Date().getTime()}`);
        const produtos = await response.json();
        // Uso de Filter: isola apenas os produtos ativos para as métricas
        const produtosAtivos = produtos.filter((p) => !p.st_produto || p.st_produto === 'ativo');
        const elTotalProdutos = document.getElementById('total-produtos');
        if (elTotalProdutos)
            elTotalProdutos.textContent = String(produtosAtivos.length);
        // Uso de Reduce: soma o valor total em estoque (patrimônio)
        const patrimonioTotal = produtosAtivos.reduce((acumulador, p) => {
            var _a, _b;
            const preco = Number((_b = (_a = p.vl_preco) !== null && _a !== void 0 ? _a : p.vl_produto) !== null && _b !== void 0 ? _b : 0);
            const estoque = Number(p.qt_estoque) || 0;
            return acumulador + preco * estoque;
        }, 0);
        void patrimonioTotal; // calculado para uso futuro (ex: exibir em um card)
        calcularDestaquesPreco(produtosAtivos);
        const tbody = document.getElementById('tabela-produtos');
        if (!tbody)
            return;
        // Uso de Map: transforma cada produto em uma linha HTML formatada
        const linhasFormatadas = produtos.map((prod) => {
            var _a, _b;
            const statusProd = prod.st_produto || 'ativo';
            const botaoAcao = statusProd === 'ativo'
                ? `<button class="btn btn-sm btn-outline-danger" onclick="desativarProduto(${prod.id_produto})">Desativar</button>`
                : `<button class="btn btn-sm btn-outline-success" onclick="reativarProduto(${prod.id_produto})">Reativar</button>`;
            const prodJson = JSON.stringify(prod).replace(/"/g, '&quot;');
            const precoValor = Number((_b = (_a = prod.vl_preco) !== null && _a !== void 0 ? _a : prod.vl_produto) !== null && _b !== void 0 ? _b : 0);
            const precoFormatado = precoValor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            const srcImg = obterCaminhoImagem(prod.im_produto);
            const estoqueNum = Number(prod.qt_estoque) || 0;
            const imagemProd = srcImg
                ? `<img src="${srcImg}" alt="${prod.nm_produto}" style="width: 40px; height: 40px; object-fit: cover;" class="rounded" onerror="this.onerror=null; this.src='images/${prod.im_produto.split('/').pop()}';">`
                : `<span class="badge bg-secondary">Sem foto</span>`;
            return `
                <tr>
                    <td>${prod.id_produto}</td>
                    <td>${imagemProd}</td>
                    <td><strong>${prod.nm_produto}</strong></td>
                    <td><span class="badge bg-info text-dark">${prod.nm_categoria || 'Sem categoria'}</span></td>
                    <td>${precoFormatado}</td>
                    <td><span class="badge ${estoqueNum < 5 ? 'bg-warning text-dark' : 'bg-light text-dark'}">${estoqueNum} un</span></td>
                    <td><span class="badge ${statusProd === 'ativo' ? 'bg-success' : 'bg-danger'}">${statusProd}</span></td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-warning me-1" onclick="abrirEdicaoProduto(${prodJson})">Editar</button>
                        ${botaoAcao}
                    </td>
                </tr>
            `;
        });
        tbody.innerHTML = linhasFormatadas.join('');
    }
    catch (error) {
        console.error('Erro ao carregar produtos:', error);
    }
}
function calcularDestaquesPreco(produtos) {
    if (!produtos || produtos.length === 0)
        return;
    // Uso de Map: normaliza o preço de cada produto em um campo numérico único
    const produtosComPreco = produtos.map((p) => {
        var _a, _b;
        return (Object.assign(Object.assign({}, p), { precoNumerico: Number((_b = (_a = p.vl_preco) !== null && _a !== void 0 ? _a : p.vl_produto) !== null && _b !== void 0 ? _b : 0) }));
    });
    // Uso de Reduce: encontra o maior e o menor preço da coleção
    const produtoMaisCaro = produtosComPreco.reduce((max, atual) => (atual.precoNumerico > max.precoNumerico ? atual : max), produtosComPreco[0]);
    const produtoMaisBarato = produtosComPreco.reduce((min, atual) => (atual.precoNumerico < min.precoNumerico ? atual : min), produtosComPreco[0]);
    const elMaiorDestaque = document.getElementById('maior-destaque-nome');
    if (elMaiorDestaque) {
        elMaiorDestaque.textContent = `${produtoMaisCaro.nm_produto} (R$ ${produtoMaisCaro.precoNumerico.toFixed(2)})`;
    }
    const elMenorDestaque = document.getElementById('menor-destaque-nome');
    if (elMenorDestaque) {
        elMenorDestaque.textContent = `${produtoMaisBarato.nm_produto} (R$ ${produtoMaisBarato.precoNumerico.toFixed(2)})`;
    }
}
async function carregarRankingMaisVendido() {
    try {
        const [resProd, resItens] = await Promise.all([
            fetch('../api/produtos.php'),
            fetch('../api/itens_pedido.php')
        ]);
        const produtos = await resProd.json();
        const resItensJson = await resItens.json();
        const itensPedido = resItensJson.dados || [];
        if (!Array.isArray(itensPedido) || itensPedido.length === 0)
            return;
        // Algoritmo de frequência com estrutura chave-valor real (Map<id, quantidade>)
        const frequenciaVendas = new Map();
        itensPedido.forEach((item) => {
            var _a;
            const idProd = item.id_produto;
            const qtd = Number(item.qt_produto) || 0;
            frequenciaVendas.set(idProd, ((_a = frequenciaVendas.get(idProd)) !== null && _a !== void 0 ? _a : 0) + qtd);
        });
        let idMaisVendido = null;
        let maiorQuantidade = -1;
        for (const [id, qtdTotal] of frequenciaVendas) {
            if (qtdTotal > maiorQuantidade) {
                maiorQuantidade = qtdTotal;
                idMaisVendido = id;
            }
        }
        const produtoMaisVendidoObj = produtos.find((p) => p.id_produto === idMaisVendido);
        const elMaisVendido = document.getElementById('produto-mais-vendido');
        if (elMaisVendido && produtoMaisVendidoObj) {
            elMaisVendido.textContent = `${produtoMaisVendidoObj.nm_produto} (${maiorQuantidade} unidades vendidas)`;
        }
    }
    catch (error) {
        console.error('Erro ao calcular o produto mais vendido:', error);
    }
}
function abrirEdicaoProduto(prod) {
    var _a, _b;
    const idProdEl = document.getElementById('id_produto');
    if (idProdEl)
        idProdEl.value = String(prod.id_produto);
    const nmProdEl = document.getElementById('nm_produto');
    if (nmProdEl)
        nmProdEl.value = prod.nm_produto;
    const idCatProdEl = document.getElementById('id_categoria_produto');
    if (idCatProdEl)
        idCatProdEl.value = String(prod.id_categoria);
    const vlPrecoEl = document.getElementById('vl_preco');
    if (vlPrecoEl)
        vlPrecoEl.value = String((_b = (_a = prod.vl_preco) !== null && _a !== void 0 ? _a : prod.vl_produto) !== null && _b !== void 0 ? _b : 0);
    const qtEstoqueEl = document.getElementById('qt_estoque');
    if (qtEstoqueEl)
        qtEstoqueEl.value = String(prod.qt_estoque);
    const dsProdEl = document.getElementById('ds_produto');
    if (dsProdEl)
        dsProdEl.value = prod.ds_produto || '';
    const stProdEl = document.getElementById('st_produto');
    if (stProdEl)
        stProdEl.value = prod.st_produto || 'ativo';
    const lblProdEl = document.getElementById('modalProdutoLabel');
    if (lblProdEl)
        lblProdEl.textContent = 'Editar Produto';
    const modalEl = document.getElementById('modalProduto');
    if (modalEl) {
        const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
        modal.show();
    }
}
async function desativarProduto(id) {
    if (!confirm('Tem certeza que deseja desativar este produto?'))
        return;
    try {
        const response = await fetch('../api/excluir_produto.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id_produto: id })
        });
        const res = await response.json();
        alert(res.mensagem || 'Produto desativado.');
        if (res.status)
            carregarProdutos();
    }
    catch (error) {
        console.error('Erro ao desativar produto:', error);
    }
}
async function reativarProduto(id) {
    if (!confirm('Deseja reativar este produto?'))
        return;
    try {
        const response = await fetch('../api/reativar_produto.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id_produto: id })
        });
        const res = await response.json();
        alert(res.mensagem || 'Produto reativado.');
        if (res.status)
            carregarProdutos();
    }
    catch (error) {
        console.error('Erro ao reativar produto:', error);
    }
}
async function carregarVendas() {
    try {
        const response = await fetch(`../api/vendas.php?t=${new Date().getTime()}`);
        const res = await response.json();
        const elTotalVendas = document.getElementById('total-vendas');
        if (elTotalVendas && res.status) {
            elTotalVendas.textContent = Number(res.total_vendas).toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
        }
    }
    catch (error) {
        console.error('Erro ao carregar vendas:', error);
    }
}
// ---------------------------------------------------------------------------
// RESUMO POR CATEGORIA (Stored Procedure sp_resumo_categoria)
// ---------------------------------------------------------------------------
async function carregarResumoCategoria() {
    const tbody = document.getElementById('tabela-resumo-categoria');
    if (!tbody)
        return;
    try {
        const response = await fetch('../api/relatorio_categorias.php');
        const res = await response.json();
        if (!res.status || res.dados.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted">Sem dados.</td></tr>';
            return;
        }
        // Uso de Map: transforma cada linha vinda da Stored Procedure em HTML
        const linhas = res.dados.map((cat) => {
            const valorFormatado = Number(cat.vl_total_estoque).toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
            return `
                <tr>
                    <td>${cat.nm_categoria}</td>
                    <td>${cat.qt_produtos_ativos}</td>
                    <td>${valorFormatado}</td>
                    <td><span class="badge bg-secondary">${cat.status_mais_critico}</span></td>
                </tr>
            `;
        });
        tbody.innerHTML = linhas.join('');
    }
    catch (error) {
        console.error('Erro ao carregar resumo por categoria:', error);
        tbody.innerHTML = '<tr><td colspan="4" class="text-center text-danger">Erro ao carregar.</td></tr>';
    }
}
// ---------------------------------------------------------------------------
// RANKING VIA VIEW SQL (vw_ranking_produtos, que usa uma CTE)
// ---------------------------------------------------------------------------
async function carregarRankingSQL() {
    const tbody = document.getElementById('tabela-ranking-sql');
    if (!tbody)
        return;
    try {
        const response = await fetch('../api/ranking_produtos.php');
        const res = await response.json();
        if (!res.status || res.dados.length === 0) {
            tbody.innerHTML = '<tr><td colspan="2" class="text-center text-muted">Sem vendas registradas.</td></tr>';
            return;
        }
        const linhas = res.dados.map((item) => `
                <tr>
                    <td>${item.nm_produto}</td>
                    <td>${item.qt_total_vendida}</td>
                </tr>
            `);
        tbody.innerHTML = linhas.join('');
    }
    catch (error) {
        console.error('Erro ao carregar ranking via view SQL:', error);
        tbody.innerHTML = '<tr><td colspan="2" class="text-center text-danger">Erro ao carregar.</td></tr>';
    }
}
// ---------------------------------------------------------------------------
// PEDIDOS (3º CRUD: Read + Update de status + Delete lógico/cancelamento;
// o Create acontece no checkout, em ts/checkout.ts)
// ---------------------------------------------------------------------------
async function carregarPedidos() {
    const tbody = document.getElementById('tabela-pedidos');
    if (!tbody)
        return;
    try {
        const response = await fetch(`../api/pedidos.php?t=${new Date().getTime()}`);
        const pedidos = await response.json();
        if (!Array.isArray(pedidos) || pedidos.length === 0) {
            tbody.innerHTML = '<tr><td colspan="7" class="text-center text-muted">Nenhum pedido registrado.</td></tr>';
            return;
        }
        const linhas = pedidos.map((pedido) => {
            const totalFormatado = Number(pedido.vl_total).toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
            const dataFormatada = new Date(pedido.dt_pedido).toLocaleDateString('pt-BR');
            // Uso de Map: gera as <option> de status a partir da lista de status válidos,
            // marcando a opção atual do pedido como selecionada
            const opcoesStatus = STATUS_PEDIDO_VALIDOS.map((status) => {
                const selecionado = status === pedido.st_pedido ? 'selected' : '';
                return `<option value="${status}" ${selecionado}>${status}</option>`;
            }).join('');
            const cancelado = pedido.st_pedido === 'Cancelado';
            const botaoCancelar = cancelado
                ? `<span class="badge bg-danger">Cancelado</span>`
                : `<button class="btn btn-sm btn-outline-danger" onclick="cancelarPedido(${pedido.id_pedido})">Cancelar</button>`;
            return `
                <tr>
                    <td>${pedido.id_pedido}</td>
                    <td>${pedido.nm_cliente}</td>
                    <td>${dataFormatada}</td>
                    <td>${pedido.qt_itens}</td>
                    <td>${totalFormatado}</td>
                    <td>
                        <select class="form-select form-select-sm" style="min-width: 130px;" ${cancelado ? 'disabled' : ''}
                                onchange="atualizarStatusPedido(${pedido.id_pedido}, this.value)">
                            ${opcoesStatus}
                        </select>
                    </td>
                    <td class="text-end">${botaoCancelar}</td>
                </tr>
            `;
        });
        tbody.innerHTML = linhas.join('');
    }
    catch (error) {
        console.error('Erro ao carregar pedidos:', error);
        tbody.innerHTML = '<tr><td colspan="7" class="text-center text-danger">Erro ao carregar pedidos.</td></tr>';
    }
}
async function atualizarStatusPedido(id, novoStatus) {
    try {
        const response = await fetch('../api/atualizar_status_pedido.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id_pedido: id, st_pedido: novoStatus })
        });
        const res = await response.json();
        if (!res.status) {
            alert(res.mensagem || 'Erro ao atualizar o status do pedido.');
        }
        carregarPedidos();
        carregarRankingMaisVendido();
    }
    catch (error) {
        console.error('Erro ao atualizar status do pedido:', error);
        alert('Erro de conexão ao atualizar o pedido.');
    }
}
async function cancelarPedido(id) {
    if (!confirm('Tem certeza que deseja cancelar este pedido?'))
        return;
    try {
        const response = await fetch('../api/cancelar_pedido.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id_pedido: id })
        });
        const res = await response.json();
        alert(res.mensagem || 'Pedido cancelado.');
        if (res.status) {
            carregarPedidos();
            carregarVendas();
        }
    }
    catch (error) {
        console.error('Erro ao cancelar pedido:', error);
    }
}
