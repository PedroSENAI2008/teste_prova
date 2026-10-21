<?php
session_start();

require_once __DIR__ . "/../../DB/Database.php";
require_once __DIR__ . "/../../Controller/UsuarioController.php";

$usuarioController = new UsuarioController($pdo);
$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $usuario = $usuarioController->login($email, $senha);
    if ($usuario) {
        session_start();
        $_SESSION['usuario'] = $usuario;
        header("Location: dashboard.php");
        exit();
    }

    $erro = "Email ou senha inválidos.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="login.php">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <br>
        <button type="submit">Login</button>
        <?php if ($erro !== ""): ?>
            <p style="color: red;"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
    </form>
</body>

</html>
