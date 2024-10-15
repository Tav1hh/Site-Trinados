<?php 
include '../../../scripts/conexao.php';

$nome = $_POST['nome_autor'];
$id = $_GET['id'];

// Pegando os Dados do Autor
$sql = "SELECT * FROM autor where id=$id";
$res = mysqli_query($conn,$sql);
$linha = mysqli_fetch_array($res);

if ($_FILES['part']['name'] != null) {
    $file = $_FILES['part'];

    // Informações sobre o arquivo
    $fileName = $file['name']; // Nome do arquivo
    $fileTmp = $file['tmp_name']; // Local temporário do arquivo no servidor

    if (unlink('../../../'.$linha['path_foto'])) {
        echo "Arquivo Apagado!";
        if (rmdir('../../../'.$linha['path'])) {
            echo "Pasta Apagada!";
            
             // Define o diretório para mover o arquivo
            $uploadDir = "autor/$nome";
            $destination = "$uploadDir/" . basename($fileName);

            // Criando a Pasta
            if (!is_dir("../../../".$uploadDir)) {
                mkdir("../../../".$uploadDir, 0777, true);
            }
            
            // Move o arquivo para o diretório desejado
            if (move_uploaded_file($fileTmp, "../../../$destination")) {
                
                // Saber qual é a extensão
                $typePNG = mime_content_type("../../../$destination");
                $mime_map = [
                'text/plain' => 'txt',
                'text/html' => 'html',
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'application/pdf' => 'pdf',
                'application/zip' => 'mscz',
                'audio/mpeg' => 'mp3',
                'video/mp4' => 'mp4',
                // Adicione mais mapeamentos conforme necessário
                ];

                $typePNG = $mime_map[$typePNG];
                $PNGName = "$nome.$typePNG";
                $pathPNG = "$uploadDir/$PNGName";

                rename("../../../$destination","../../../$uploadDir/$PNGName");


                // Salva os dados no Banco de Dados
                $sql = "UPDATE autor set nome='$nome', path_foto='$pathPNG', path='$uploadDir', foto_name='$PNGName' where id=$id";
                mysqli_query($conn,$sql);

                echo "Arquivo salvo na pasta: " . "$uploadDir <br>";
                header("Location: criarAutor.php");
                
            } else {
                echo "Erro ao mover o arquivo.";
                
            };
        } else {
            echo "Pasta não Apagada!";
        };
    } else {
        echo "Arquivo Não Apagado!";
    };



} else {
    // Saber qual é a extensão
    $typePNG = mime_content_type("../../../".$linha['path_foto']);
    $mime_map = [
    'text/plain' => 'txt',
    'text/html' => 'html',
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'application/pdf' => 'pdf',
    'application/zip' => 'mscz',
    'audio/mpeg' => 'mp3',
    'video/mp4' => 'mp4',
    // Adicione mais mapeamentos conforme necessário
    ];
    
    $path = "autor/$nome";
    $typePNG = $mime_map[$typePNG];
    $PNGName = "$nome.$typePNG";
    $pathPNG = "$path/$PNGName";


    rename("../../../".$linha['path_foto'], "../../../".$linha['path']."/$PNGName");
    rename("../../../".$linha['path'],"../../../autor/$nome");

    // Atualizando o Nome do Autor
    $sql = "UPDATE autor set nome='$nome', path_foto='$pathPNG', path='$path', foto_name='$PNGName' where id=$id";
    mysqli_query($conn,$sql);

}

header('Location: ../../Painel/index.php')
?>