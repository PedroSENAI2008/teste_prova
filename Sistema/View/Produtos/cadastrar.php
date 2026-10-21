<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../Usuario/login.php');
    exit();
}

require_once __DIR__ . "/../../DB/Database.php";
require_once __DIR__ . "/../../Controller/ProdutoController.php";

$produtoController = new ProdutoController($pdo);
$erro = '';
$nome = '';
$descricao = '';
$valor = '';
$quantidade = '0';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $valor = $_POST['valor'] ?? '';
    $quantidade = $_POST['quantidade'] ?? '0';
    $erro = $produtoController->validarDados($nome, $descricao, $valor, $quantidade) ?? '';

    if ($erro === '') {
        $produtoController->cadastrar($nome, $descricao, $valor, (int) $quantidade);
        header('Location: ../Usuario/dashboard.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar produto</title>
</head>
<body>
    <h1>Cadastrar produto</h1>
    <?php if ($erro !== ''): ?>
        <p role="alert"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" maxlength="255" required value="<?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?>"><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" maxlength="255" required><?= htmlspecialchars($descricao, ENT_QUOTES, 'UTF-8') ?></textarea><br>

        <label for="valor">Valor:</label>
        <input type="number" id="valor" name="valor" min="0" step="0.01" required value="<?= htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8') ?>"><br>

        <label for="quantidade">Quantidade inicial:</label>
        <input type="number" id="quantidade" name="quantidade" min="0" step="1" required value="<?= htmlspecialchars((string) $quantidade, ENT_QUOTES, 'UTF-8') ?>"><br>

        <button type="submit">Cadastrar</button>
    </form>
    <p><a href="../Usuario/dashboard.php">Voltar ao painel</a></p>
</body>
</html>
