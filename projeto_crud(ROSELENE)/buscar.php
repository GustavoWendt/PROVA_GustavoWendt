<?php
session_start();
require_once 'conexao.php';

$usuario = null;
$erro = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $sql = "SELECT nome, email FROM usuarios WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        $erro = "E-mail não encontrado no banco de dados.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Buscar usuário</title>
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
<h2>Buscar usuário:</h2>

<form action="" method="POST">
    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" required value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" />
    <br />
    <button type="submit">Buscar</button>
</form>

<?php if ($erro): ?>
    <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<?php if ($usuario): ?>
    <h3>Dados do usuário encontrado:</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
        </tr>
        <tr>
            <td><?= htmlspecialchars($usuario['nome']) ?></td>
            <td><?= htmlspecialchars($usuario['email']) ?></td>
        </tr>
    </table>
<?php endif; ?>

<p><a href="index.php">Menu principal</a></p>
</body>
</html>
