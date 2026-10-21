<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
</head>
<body>
    <form method="post">
       
       <select name="tipo" required>
           <option value="entrada">Entrada</option>
           <option value="saida">Saída</option>
       </select>
       
       <select name = "produto" required>
        <?php foreach ($produtos as $produto): ?>
            <option value="<?= $produto['id'] ?>"><?= $produto['nome'] ?></option>
        <?php endforeach; ?>
       </select>
       <select>
        <?php foreach ($estoques as $estoque): ?>
            <option value="<?= $estoque['id'] ?>"><?= $estoque['nome'] ?></option>
        <?php endforeach; ?>
       </select>
       <label for="quantidade">Quantidade:</label>
       <input type="number" name="quantidade" required><br> 

       <input type="submit">
    
    </form>
</body>
</html>

<?php

require_once __DIR__ . "/../../../mvc/DB/Database.php";
require_once __DIR__ . "/../../../mvc/Controller/UsuarioController.php";

$UsuarioController = new UsuarioController($pdo);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['nome'];
    $descr = $_POST['descr'];
    $senha = $_POST['senha'];

    $UsuarioController->cadastrar($nome, $descr, $senha);
    header('Location: ../../index.php');
}










