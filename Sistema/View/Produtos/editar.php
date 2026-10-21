<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../Usuario/login.php');
    exit();
}

require_once __DIR__ . "/../../DB/Database.php";
require_once __DIR__ . "/../../Controller/ProdutoController.php";

$produtoController = new ProdutoController($pdo);
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    header('Location: ../Usuario/dashboard.php');
    exit();
}

$produto = $produtoController->buscarProduto($id);
if (!$produto) {
    header('Location: ../Usuario/dashboard.php?produto=nao-encontrado');
    exit();
}

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $valor = $_POST['valor'] ?? '';
    $quantidade = $_POST['quantidade'] ?? '';
    $erro = $produtoController->validarDados($nome, $descricao, $valor, $quantidade) ?? '';

    if ($erro === '') {
        $produtoController->editar($nome, $descricao, $valor, (int) $quantidade, $id);
        header('Location: ../Usuario/dashboard.php');
        exit();
    }

    $produto['nome'] = $nome;
    $produto['descricao'] = $descricao;
    $produto['valor'] = $valor;
    $produto['quantidade'] = $quantidade;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar produto</title>
</head>
<body>
    <h1>Editar produto</h1>
    <?php if ($erro !== ''): ?>
        <p role="alert"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" maxlength="255" required value="<?= htmlspecialchars((string) $produto['nome'], ENT_QUOTES, 'UTF-8') ?>"><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" maxlength="255" required><?= htmlspecialchars((string) $produto['descricao'], ENT_QUOTES, 'UTF-8') ?></textarea><br>

        <label for="valor">Valor:</label>
        <input type="number" id="valor" name="valor" min="0" step="0.01" required value="<?= htmlspecialchars((string) $produto['valor'], ENT_QUOTES, 'UTF-8') ?>"><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" id="quantidade" name="quantidade" min="0" step="1" required value="<?= htmlspecialchars((string) $produto['quantidade'], ENT_QUOTES, 'UTF-8') ?>"><br>

        <button type="submit">Salvar alterações</button>
    </form>
    <p><a href="../Usuario/dashboard.php">Voltar ao painel</a></p>
</body>
</html>
