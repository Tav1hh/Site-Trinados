<?php 
include '../../../scripts/conexao.php';

$nome = $_POST['nome'];
$login = $_POST['login'];
$senha = $_POST['senha'];
$id = $_GET['id'];

$sql = "UPDATE admin set nome = '$nome', login = '$login', senha = '$senha' where id=$id";
if (mysqli_query($conn,$sql)) {
    header('Location: ../../Painel/index.php');
} else {
    echo "Não foi possivel Atualizar..!";
}
?>