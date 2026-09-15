<?php
ob_start();
error_reporting(0);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');

try {
    $path_conexao = __DIR__ . '/../config/conexao.php';
    if (!file_exists($path_conexao)) {
        ob_clean();
        echo json_encode(['status' => false, 'mensagem' => 'Arquivo de conexão não encontrado.']);
        exit;
    }
    require_once $path_conexao;

    $id = !empty($_POST['id_produto']) ? intval($_POST['id_produto']) : null;
    $nome = trim($_POST['nm_produto'] ?? '');
    $id_categoria = !empty($_POST['id_categoria']) ? intval($_POST['id_categoria']) : null;
    $descricao = trim($_POST['ds_produto'] ?? '');

    $preco_raw = str_replace(',', '.', $_POST['vl_preco'] ?? '0');
    $preco = floatval($preco_raw);

    $estoque = intval($_POST['qt_estoque'] ?? 0);
    $status = !empty($_POST['st_produto']) ? trim($_POST['st_produto']) : 'ativo';

    if (empty($nome) || empty($id_categoria)) {
        ob_clean();
        echo json_encode(['status' => false, 'mensagem' => 'Selecione uma categoria e preencha o nome do produto.']);
        exit;
    }

    $nome_imagem = null;

    // Se houver envio de nova imagem
    if (isset($_FILES['im_produto']) && $_FILES['im_produto']['error'] === UPLOAD_ERR_OK) {
        $extensao = strtolower(pathinfo($_FILES['im_produto']['name'], PATHINFO_EXTENSION));
        $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($extensao, $extensoes_permitidas)) {
            $diretorio_destino = __DIR__ . '/../images/';

            if (!is_dir($diretorio_destino)) {
                mkdir($diretorio_destino, 0777, true);
            }

            // Se for uma EDIÇÃO, apaga a imagem antiga da pasta
            if ($id) {
                $stmt_antiga = $conexao->prepare("SELECT im_produto FROM produto WHERE id_produto = ?");
                $stmt_antiga->bind_param("i", $id);
                $stmt_antiga->execute();
                $res_antiga = $stmt_antiga->get_result()->fetch_assoc();

                if (!empty($res_antiga['im_produto'])) {
                    $caminho_antigo = $diretorio_destino . basename($res_antiga['im_produto']);
                    if (file_exists($caminho_antigo)) {
                        unlink($caminho_antigo); // Deleta o arquivo antigo
                    }
                }
            }

            // Gera nome único para a nova imagem
            $nome_imagem = uniqid('prod_') . '.' . $extensao;
            move_uploaded_file($_FILES['im_produto']['tmp_name'], $diretorio_destino . $nome_imagem);
        }
    }

    if ($id) {
        // EDIÇÃO
        if ($nome_imagem) {
            $sql = "UPDATE produto SET id_categoria = ?, nm_produto = ?, ds_produto = ?, vl_produto = ?, im_produto = ?, qt_estoque = ?, st_produto = ? WHERE id_produto = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("issdsisi", $id_categoria, $nome, $descricao, $preco, $nome_imagem, $estoque, $status, $id);
        } else {
            $sql = "UPDATE produto SET id_categoria = ?, nm_produto = ?, ds_produto = ?, vl_produto = ?, qt_estoque = ?, st_produto = ? WHERE id_produto = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("issdisi", $id_categoria, $nome, $descricao, $preco, $estoque, $status, $id);
        }
        $mensagem = "Produto atualizado com sucesso!";
    } else {
        // INSERÇÃO
        $sql = "INSERT INTO produto (id_categoria, nm_produto, ds_produto, vl_produto, im_produto, qt_estoque, st_produto) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("issdsis", $id_categoria, $nome, $descricao, $preco, $nome_imagem, $estoque, $status);
        $mensagem = "Produto cadastrado com sucesso!";
    }

    if ($stmt->execute()) {
        ob_clean();
        echo json_encode(['status' => true, 'mensagem' => $mensagem]);
    } else {
        ob_clean();
        echo json_encode(['status' => false, 'mensagem' => 'Erro MySQL: ' . $stmt->error]);
    }

} catch (Exception $e) {
    ob_clean();
    echo json_encode(['status' => false, 'mensagem' => 'Erro interno: ' . $e->getMessage()]);
}