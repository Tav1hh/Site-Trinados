<?php
include 'scripts/conexao.php';

if (isset($_SESSION['nome']) and isset($_SESSION['id'])) {
    $nome = $_SESSION['nome'];
    $id = $_SESSION['id'];

    // Verificando no Banco de Dados
    $sql = "SELECT * FROM admin where id = '$id' and nome = '$nome'";
    $res = mysqli_query($conn,$sql);

    $usuario = mysqli_fetch_array($res);
    if ($usuario !== null) {
        header("Location: admin/painel/index.php");
    };
};

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="x039.css">
</head>
<body>
    <header>
        <h1>Tela de Login</h1>
    </header>
    <main>
        <form action="admin/confirm.php" method="post">
            <input type="text" name="user" id="Iuser" placeholder="Usúario">
            <input type="password" name="pass" id="Ipass" placeholder="Senha">
            <div class="btns">
                <button type="reset">Limpar</button>
                <button type="submit">Logar</button>
            </div>
        </form>
    </main>
    <footer>
        <p>Site Criado por &copy;<strong>Santiago</strong></p>
    </footer>
</body>
</html>