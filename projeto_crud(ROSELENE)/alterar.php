<?php
session_start(); // Inicia a sessão PHP para controle de dados do usuário (caso necessário)
require_once 'conexao.php'; // Inclui o arquivo com a conexão ao banco de dados

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $E_MAIL = $_SESSION["email"];
    // Recebe os dados do formulário
    $email= $_POST["email"];
    $nome= $_POST["nome"];

    $sql = "UPDATE usuarios SET nome = :nome, email = :email_novo WHERE email = :email_antigo";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email_novo', $email); // novo e-mail que o usuário digitou
    $stmt->bindParam(':email_antigo', $E_MAIL); // e-mail antigo armazenado na sessão
    

    if($stmt->execute()){
        session_destroy(); // Encerra a sessão após o cadastro (pode ser opcional)
        
        // Exibe mensagem de sucesso e redireciona para a página inicial
        echo "<script>alert('Alteração realizada com sucesso!'); window.location.href='index.php';</script>";
    } else {
        // Exibe mensagem de erro se algo der errado ao inserir no banco
        echo "<script>alert('Erro ao alterar a senha!');</script>";
    };
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de usuários</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h2>Alteração:</h2>
    <form action="alterar.php" method="POST">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>
        </br>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required>
        </br>

        <button type="submit">cadastrar</button>
    </form>

    <p><a href="index.php">Menu principal</a>
</body>
</html>