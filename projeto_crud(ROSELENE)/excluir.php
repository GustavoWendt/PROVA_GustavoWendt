<?php
session_start();
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    $sql = "DELETE FROM usuarios WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);

    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Usuário excluído com sucesso.'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Usuário não encontrado.'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Erro ao executar a exclusão.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Usuário</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h2>Excluir usuário pelo e-mail:</h2>

<form action="excluir.php" method="POST">
    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" required><br><br>
    <button type="submit">Excluir</button>
</form>

<p><a href="index.php">Menu principal</a></p>
</body>
</html>
