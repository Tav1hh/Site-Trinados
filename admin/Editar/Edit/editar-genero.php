<?php 
include '../../../scripts/conexao.php';

$nome = $_POST['nome'];
$id = $_GET['id'];

$sql = "UPDATE genero set nome = '$nome' where id=$id";
if (mysqli_query($conn,$sql)) {
    header('Location: ../../Painel/index.php');
} else {
    echo "Não foi possivel Atualizar..!";
}
?>