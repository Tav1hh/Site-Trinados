<?php 
include '../../scripts/conexao.php';

$nome = $_POST['nome_autor'];
$file = $_FILES['part'];


// Verifica se o arquivo foi enviado
if (isset($_FILES['part'])) {

    $filePNG = $_FILES['part'];
    $PNGName = $filePNG['name'];
    $PNGtmp = $filePNG['tmp_name'];

    // Definindo o caminho de destino
    $path =  "autor/$nome";

    // Criando a Pasta
    if (!is_dir("../../".$path)) {
        mkdir("../../".$path, 0777, true);
    }

    // Definindo o caminho
    $pathPNG = "../../$path/" . $PNGName;

    // Movendo os arquivos
    if (move_uploaded_file($PNGtmp, $pathPNG)) {

        // Saber qual é a extensão
        $typePNG = mime_content_type($pathPNG);
        $mime_map = [
        'text/plain' => 'txt',
        'text/html' => 'html',
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'application/pdf' => 'pdf',
        'application/zip' => 'mscz',
        'audio/mpeg' => 'mp3',
        'video/mp4' => 'mp4',
        'image/webp' => 'webp',
        // Adicione mais mapeamentos conforme necessário
        ];

        $typePNG = $mime_map[$typePNG];
        $PNGName = "$nome.$typePNG";

        // Renomeando
        rename($pathPNG,"../../$path/" . "$PNGName");

        $pathPNG = "$path/$PNGName";
        
        $sql = "INSERT INTO autor (nome, path_foto, path, foto_name) VALUES('$nome','$pathPNG','$path','$PNGName')";
        if (mysqli_query($conn,$sql)) {
            echo "arquivo salvo!";
            header("Location: criarMusica.php");
        } else {
            echo "Erro em salvar no BD!";
        };

    }
}

?>
