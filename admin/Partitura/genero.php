<?php 
include '../../scripts/conexao.php';
include "../security.php";

$nome = $_POST['nome_genero'];

// Salva os dados no Banco de Dados
$sql = "INSERT INTO genero (nome) VALUES('$nome')";

if (mysqli_query($conn,$sql)) {
    
    header("Location: criarGenero.php");
        
} else {
    echo "Erro ao salvar no BD.";
}


?>