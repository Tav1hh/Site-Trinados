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

$nome = $_POST['nome_autor'];
$file = $_FILES['part'];

if (isset($_FILES['part']) && $_FILES['part']['error'] === 0) {
    $file = $_FILES['part'];

    // Informações sobre o arquivo
    $fileName = $file['name']; // Nome do arquivo
    $fileTmp = $file['tmp_name']; // Local temporário do arquivo no servidor

    // Define o diretório para mover o arquivo
    $uploadDir = "autor/$nome";
    $destination = "$uploadDir/" . basename($fileName);

    // Criando a Pasta
    if (!is_dir("../../".$uploadDir)) {
        mkdir("../../".$uploadDir, 0777, true);
    }

    // Salva os dados no Banco de Dados
    $sql = "INSERT INTO autor (nome, path_foto, path, foto_name) VALUES('$nome','$destination','$uploadDir','$fileName')";

    // Move o arquivo para o diretório desejado
    if (move_uploaded_file($fileTmp, "../../$destination")) {
        mysqli_query($conn,$sql);
        echo "Arquivo salvo na pasta: " . "$uploadDir <br>";
        header("Location: criarAutor.php");
        
    } else {
        echo "Erro ao mover o arquivo.";
        
    };
} else {
    echo "Nenhum arquivo enviado ou erro no envio.";
}

?>