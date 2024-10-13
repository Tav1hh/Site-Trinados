<?php 
include '../../scripts/conexao.php';

$nome = $_POST['nome_genero'];

// Salva os dados no Banco de Dados
$sql = "INSERT INTO genero (nome) VALUES('$nome')";

if (mysqli_query($conn,$sql)) {
    
    header("Location: criarGenero.html");
        
} else {
    echo "Erro ao salvar no BD.";
}


?>