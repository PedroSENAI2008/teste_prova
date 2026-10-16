
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
</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    logar($email, $senha);

function logar ($email, $senha) {
    
    $usuario = $this->usuarioModel->Login($email, $senha);
    return $usuario;

    if ($usuario) {
        // Login bem-sucedido
        session_start();
        $_SESSION['usuario'] = $usuario;
        header("Location: dashboard.php");
        exit();
    } else {
        // Login falhou
        echo "Email ou senha inválidos.";
    }
    }
}
?>
