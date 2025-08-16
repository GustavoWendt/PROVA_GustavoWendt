<?php 
session_start();
require_once 'conexao.php';
require_once 'funcoes_email.php'; // Funções auxiliares, como envio simulado de email

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $sql = "SELECT email FROM usuarios WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);   

    if ($usuario) {
        $_SESSION['email'] = $usuario['email'];

        echo "<script>alert('Usuário encontrado! Redirecionando para alteração...'); window.location.href='alterar.php';</script>";
    } else {
        echo "<script>alert('Erro: E-mail não encontrado no banco de dados.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar usuário(a)</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h2>Buscar:</h2>
    <form action="busca_alterar.php" method="POST">

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required>
        </br>

        <button type="submit">cadastrar</button>
    </form>

    <p><a href="index.php">Menu principal</a>
</body>
</html>