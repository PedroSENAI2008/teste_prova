<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");

    require_once __DIR__ . "/../../DB/Database.php";  
    require_once __DIR__ . "/../../Controller/MovimentacaoController.php";
    require_once __DIR__ . "/../../Controller/ProdutoController.php";


    $estoqueController = new MovimentacaoController($pdo);
    $produtoController = new ProdutoController($pdo);
    

    $produto = $produtoController->listar();
    $estoque = $estoqueController->listar();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Olá, <?= htmlspecialchars($_SESSION["usuario"]["nome"]) ?>!</h1>

    <main>

    </main>
<a href="logout.php">Sair</a>
</body>
</html>

<?php

 exit();
    }?>