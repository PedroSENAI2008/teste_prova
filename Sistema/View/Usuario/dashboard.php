<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

require_once __DIR__ . "/../../DB/Database.php";
require_once __DIR__ . "/../../Controller/ProdutoController.php";

$produtoController = new ProdutoController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sucesso = $produtoController->ajustarEstoque(
        $_POST['produto_id'] ?? '',
        $_POST['tipo'] ?? '',
        $_POST['quantidade'] ?? ''
    );
    header('Location: dashboard.php?estoque=' . ($sucesso ? 'atualizado' : 'erro'));
    exit();
}

$produtos = $produtoController->listar();
$mensagens = [
    'atualizado' => 'Estoque atualizado.',
    'erro' => 'Não foi possível atualizar. Confira a quantidade e se há estoque suficiente.',
    'em-uso' => 'Este produto não pode ser excluído porque possui movimentações vinculadas.',
    'excluido' => 'Produto excluído.',
    'nao-encontrado' => 'Produto não encontrado.'
];
$status = $_GET['estoque'] ?? ($_GET['produto'] ?? '');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de estoque</title>
</head>
<body>
    
    <h1>Olá, <?= htmlspecialchars($_SESSION['usuario']['nome'], ENT_QUOTES, 'UTF-8') ?>!</h1>
    <p><a href="../Produtos/cadastrar.php">Cadastrar produto</a></p>

    <?php if (isset($mensagens[$status])): ?>
        <p role="status"><?= htmlspecialchars($mensagens[$status], ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <main>
        <h2>Produtos e estoque</h2>
        <?php include __DIR__ . "/../Produtos/listar.php"; ?>
    </main>

    <p><a href="logout.php">Sair</a></p>
</body>
</html>
