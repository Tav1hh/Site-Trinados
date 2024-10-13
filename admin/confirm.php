<?php 
include '../scripts/conexao.php';

if (isset($_POST['user']) & isset($_POST['pass'])) {
    $user = $_POST['user'];
    $senha = $_POST['pass'];

    // Verificando no Banco de Dados
    $sql = "SELECT * FROM admin where login = '$user' and senha = '$senha'";
    $res = mysqli_query($conn,$sql);

    $usuario = mysqli_fetch_array($res);
    if ($usuario !== null) {
        session_start();
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['adm'] = true;
        header("Location: painel/index.php");
    } else {
        session_unset();
        session_destroy();
        header('Location: ../x039.php');
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site</title>
</head>
<body>
    <h1>Teste</h1>
</body>
</html>