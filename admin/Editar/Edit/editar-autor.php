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

            // Salva os dados no Banco de Dados
            $sql = "UPDATE autor set nome='$nome', path_foto='$destination', path='$uploadDir', foto_name='$fileName' where id=$id";

            // Move o arquivo para o diretório desejado
            if (move_uploaded_file($fileTmp, "../../../$destination")) {
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

    rename("../../../".$linha['path'],"../../../autor/$nome");

    $path = "autor/$nome";
    $path_foto = "autor/$nome/".$linha['foto_name'];

    // Atualizando o Nome do Autor
    $sql = "UPDATE autor set nome='$nome', path_foto='$path_foto', path='$path' where id='$id'";
    mysqli_query($conn,$sql);

}

header('Location: ../../Painel/index.php')
?>