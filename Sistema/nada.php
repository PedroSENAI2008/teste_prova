<?php
require_once __DIR__ ."../DB/Database.php";
require_once __DIR__ ."Controller/UsuarioController.php";

$usuarioController = new UsuarioController($pdo);

$usuarios = $usuarioController->listar();

?>