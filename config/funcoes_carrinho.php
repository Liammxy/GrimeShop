<?php

function calcularSubtotalCarrinho(array $itens_carrinho, array $quantidades_sessao) {
    // Regra de Negócio: Se o array estiver vazio, o total é zero.
    if (empty($itens_carrinho)) {
        return 0.0;
    }

    $soma = 0;
    foreach ($itens_carrinho as $produto) {
        $id_prod = $produto['id_produto'];
        // Valida se a quantidade existe na sessão para evitar erros de índice
        $qtd = isset($quantidades_sessao[$id_prod]) ? $quantidades_sessao[$id_prod] : 0;
        $soma += ($produto['vl_produto'] * $qtd);
    }
    
    return $soma; // Retorno puro
}

/**
 * REQUISITO: Lógica de Pesquisa ou Filtro em Arrays
 */
function obterDestaquesCarrinho(array $itens_carrinho) {
    $destaques = array();
    foreach ($itens_carrinho as $produto) {
        if ($produto['vl_produto'] > 150.00) {
            $destaques[] = $produto['nm_produto'];
        }
    }
    return $destaques;
}