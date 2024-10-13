<?php 
include '../../scripts/conexao.php';

//Testa se está logado
if (isset($_SESSION['id']) & isset($_SESSION['nome'])) {
    $id = $_SESSION['id'];
    $nome = $_SESSION['nome'];

    // Verificando no Banco de Dados
    $sql = "SELECT * FROM admin where id = '$id' and nome = '$nome'";
    $res = mysqli_query($conn,$sql);

    $usuario = mysqli_fetch_array($res);
    if ($usuario == null) {
        session_unset();
        session_destroy();
        header('Location: ../../x039.php');
    }
} else { 
    session_unset();
    session_destroy();
    header('Location: ../../x039.php');
}

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