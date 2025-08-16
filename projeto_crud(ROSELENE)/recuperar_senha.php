<?php 
session_start();
require_once 'conexao.php';
require_once 'funcoes_email.php'; //ARQUIVO COM AS FUNÇÕES QUE GERAM A SENHA E SIMULAM O ENVIO

if($_SERVER["REQUEST_METHOD"] =="POST"){
    $email = $_POST['email'];

    $sql = "SELECT * FROM usuarios WHERE email=:email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email',$email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if($usuario){
        //GERA UMA SENHA TEMPORARIA E ALEATORIA

        $token_recuperacao = gerarSenhaTemporaria();
        $senha_hash = password_hash($token_recuperacao,PASSWORD_DEFAULT);
        // Gera a data atual
        $data_token = date('Y-m-d H:i:s');

        $sql = "UPDATE usuarios SET senha = :senha, token_recuperacao = :token_recuperacao, data_token = :data_token WHERE email = :email";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':senha', $senha_hash);
        $stmt->bindParam(':token_recuperacao', $token_recuperacao);
        $stmt->bindParam(':data_token', $data_token);
        $stmt->bindParam(':email', $email);
        $stmt->execute();


        //SIMULA O ENVIO DO EMAIL (GRAVA EM txt)
        simularEnvioEmail($email,$token_recuperacao);
        echo "<script>alert('Uma senha temporaria foi gerada e enviada(simulação). Verifique o arquivo emails_simulados.txt'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Email não encontrado'); window.location.href='index.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar a senha</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h2>Recuperar senha</h2>
    <form action="recuperar_senha.php" method="POST">
        <label for="email">Digite o email cadastrado!</label>
        <input type="email" id="email" name="email" required>
        </br>

        <button type="submit">Enviar a senha Temporaria</button>
    </form>
</body>
</html>