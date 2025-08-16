<?php
session_start();
require 'conexao.php';

if($_SERVER["REQUEST_METHOD"] =="POST"){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email=:email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email',$email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if($usuario && password_verify($senha,$usuario['senha'])){
        //LOGIN BEM SUCEDIDO, DEFINE VARIAVEIS DE SESSÃO
        $_SESSION['usuario'] = $usuario['nome'];
        $_SESSION['perfil'] = $usuario['id'];
        $_SESSION['id'] = $usuario['id'];

        // VERIFICA SE A SENHA É TEMPORARIA
        if($usuario['token_recuperacao']){
            // REDIRECIONA PARA A PAGINA "senha_temporaria"
            header("Location: alterar_senha.php");
            exit();
        } else {
            //REDIRECIONA PARA A PAGINA PRINCIPAL
            header("Location: index.php");
            exit();
        }
    }else{
        //LOGIN INVALIDO
        echo "<script>alert('E-mail ou senha incorretos'); window.location.href='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h2>Login:</h2>
    <form action="login.php" method="POST">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required>
        </br>

        <label for="email">Senha</label>
        <input type="password" id="senha" name="senha" required>
        </br>

        <button type="submit">Entrar</button>
    </form>

    <p><a href="recuperar_senha.php">Esqueci minha senha</a>
</body>
</html>