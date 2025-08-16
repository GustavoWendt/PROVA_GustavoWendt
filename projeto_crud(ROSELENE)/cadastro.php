<?php
session_start();
require_once 'conexao.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $nome= $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios(nome, email, senha ) VALUES(:nome,:email,:senha)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome',$nome);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':senha',$senha);
    
    if($stmt->execute()){
        session_destroy(); // FINALIZA A SESSAO
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='index.php';</script>";
} else{
    echo "<script>alert('Erro ao alterar a senha!');</script>";
};
}
    ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de usuários</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h2>Cadastro:</h2>
    <form action="cadastro.php" method="POST">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>
        </br>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required>
        </br>

        <label for="email">Senha</label>
        <input type="password" id="senha" name="senha" required>
        </br>

        <button type="submit">cadastrar</button>
    </form>

    <p><a href="index.php">Menu principal</a>
</body>
</html>