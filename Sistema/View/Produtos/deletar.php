<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../Usuario/login.php');
    exit();
}

require_once __DIR__ . "/../../DB/Database.php";
require_once __DIR__ . "/../../Controller/ProdutoController.php";

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    header('Location: ../Usuario/dashboard.php?produto=nao-encontrado');
    exit();
}

$produtoController = new ProdutoController($pdo);
if (!$produtoController->deletar($id)) {
    header('Location: ../Usuario/dashboard.php?produto=em-uso');
    exit();
}

header('Location: ../Usuario/dashboard.php?produto=excluido');
exit();
