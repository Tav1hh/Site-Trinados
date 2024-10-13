<?php 
include '../../scripts/conexao.php';
include "../security.php";

$nome = $_POST['adm_nome'];
$login = $_POST['adm_login'];
$senha = $_POST['adm_senha'];

// Salva os dados no Banco de Dados
$sql = "INSERT INTO admin (nome, login, senha) VALUES('$nome','$login','$senha')";

if (mysqli_query($conn,$sql)) {
    
    header("Location: ../Painel/index.php");
    
} else {
    echo "Erro ao salvar o ADM no db.";
}

?>