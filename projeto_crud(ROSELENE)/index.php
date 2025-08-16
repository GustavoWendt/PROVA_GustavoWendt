<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
        <ul>

        <li class="dropdow logo-item">
            <img src="images.png" alt="Logo Fornjet" height="60" width="60">
        </li>
        <li class="dropdow">
            <a href="javascript:void(0)" class="dropbtn">Cadastrar</a>
            <div class="dropdow-content">
                <a href=cadastro.php>Cadastrar cliente</a>
            </div>
        </li>

        <li class="dropdow">
            <a href="javascript:void(0)" class="dropbtn">Pesquisar</a>
            <div class="dropdow-content">
                <a href=buscar_funcionario.php>Pesquisar cliente</a>
            </div>
        </li>
        
        <li class="dropdow">
            <a href="javascript:void(0)" class="dropbtn">Excluir</a>
            <div class="dropdow-content">
                <a href=Excluir_funcionario.php>Excluir funcionario</a>
            </div>
        </li>

                <li class="dropdow">
            <a href="javascript:void(0)" class="dropbtn">Alterar</a>
            <div class="dropdow-content">
                <a href=Alterar_funcionario.php>Alterar Cliente</a>
            </div>
        </li>

        <li class="dropdow">
            <a href="javascript:void(0)" class="dropbtn">Alterar</a>
            <form action="logout.php" method="POST">
                <button type="submit">logout</button>
            </div>
        </li>
    </ul>
</body>
</html>