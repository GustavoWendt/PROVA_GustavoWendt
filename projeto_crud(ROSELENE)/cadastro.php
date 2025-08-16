<?php
session_start(); // Inicia a sessão PHP para controle de dados do usuário (caso necessário)
require_once 'conexao.php'; // Inclui o arquivo com a conexão ao banco de dados

// Verifica se o formulário foi enviado via método POST
if($_SERVER["REQUEST_METHOD"]=="POST"){
    // Recebe os dados do formulário
    $nome= $_POST["nome"];
    $email = $_POST["email"];
    
    // Criptografa a senha usando o algoritmo padrão (bcrypt)
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    // Prepara a consulta SQL para inserir os dados do usuário
    $sql = "INSERT INTO usuarios(nome, email, senha ) VALUES(:nome,:email,:senha)";

    // Prepara o statement com a conexão ativa
    $stmt = $conn->prepare($sql);

    // Associa os valores aos parâmetros da query
    $stmt->bindParam(':nome',$nome);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':senha',$senha);
    
    // Executa a query e verifica se deu certo
    if($stmt->execute()){
        session_destroy(); // Encerra a sessão após o cadastro (pode ser opcional)
        
        // Exibe mensagem de sucesso e redireciona para a página inicial
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='index.php';</script>";
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