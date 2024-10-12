<?php 
include '../../scripts/conexao.php';

$nome = $_POST['nome_author'];
$file = $_FILES['part'];

if (isset($_FILES['part']) && $_FILES['part']['error'] === 0) {
    $file = $_FILES['part'];

    // Informações sobre o arquivo
    $fileName = $file['name']; // Nome do arquivo
    $fileTmp = $file['tmp_name']; // Local temporário do arquivo no servidor

    // Define o diretório para mover o arquivo
    $uploadDir = 'author/';
    $destination = $uploadDir . basename($fileName);

    // Salva os dados no Banco de Dados
    $sql = "INSERT INTO author (nome, path_foto) VALUES('$nome','$destination')";

    if (mysqli_query($conn,$sql)) {
        
        // Move o arquivo para o diretório desejado
        if (move_uploaded_file($fileTmp, "../../$destination")) {
            echo "Arquivo salvo na pasta: " . "$uploadDir <br>";
            
        } else {
            echo "Erro ao mover o arquivo.";
            
        }
    };
} else {
    echo "Nenhum arquivo enviado ou erro no envio.";
}

?>