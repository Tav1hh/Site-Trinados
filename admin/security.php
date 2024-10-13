<?php 
session_start();
include '../scripts/conexao.php';

if (isset($_POST['user']) & isset($_POST['pass'])) {
    $user = $_POST['user'];
    $senha = $_POST['pass'];

    // Verificando no Banco de Dados
    $sql = "SELECT * FROM admin where login = '$user' and senha = '$senha'";
    $res = mysqli_query($conn,$sql);

    $usuario = mysqli_fetch_array($res);
    if ($usuario == null) {
        session_unset();
        session_destroy();
        header('Location: ../x039.php');
    }
}
?>