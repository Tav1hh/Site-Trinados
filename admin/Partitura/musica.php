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

$nome = $_POST['nome_musica'];
$autor = $_POST['autor'];
$genero = $_POST['gen'];
$Idinstrumento = $_POST['instrumento'];
$iframe = $_POST['iframe'];

$sql = "SELECT * from instrumento where id = $Idinstrumento";
$res = mysqli_query($conn,$sql);
$linha = mysqli_fetch_array($res);
$instrumento = $linha['nome'];


// Verifica se os arquivos foram enviados
if (isset($_FILES['part1']) && isset($_FILES['part2']) && isset($_FILES['part3'])) {
    
    $filePDF = $_FILES['part1'];
    $filePNG = $_FILES['part2'];
    $fileMSC = $_FILES['part3'];

    $PDFName = $filePDF['name'];
    $PNGName = $filePNG['name'];
    $MSCName = $fileMSC['name'];
    
    $PDFtmp = $filePDF['tmp_name'];
    $PNGtmp = $filePNG['tmp_name'];
    $MSCtmp = $fileMSC['tmp_name'];

    // Definindo o caminho de destino
    $path = "partituras/$instrumento/$nome";

    // Criando a Pasta
    if (!is_dir("../../".$path)) {
        mkdir("../../".$path, 0777, true);
    }

    // Definindo os caminhos de cada um

    $pathPDF = "../../$path/" . $PDFName;
    $pathPNG = "../../$path/" . $PNGName;
    $pathMSC = "../../$path/" . $MSCName;


    // Movendo os arquivos
    if (move_uploaded_file($PDFtmp, $pathPDF) && move_uploaded_file($PNGtmp, $pathPNG) && move_uploaded_file($MSCtmp, $pathMSC)) {

        // Tipos de Cada arquivo
        $typePDF = "pdf";
        $typePNG = "png";
        $typeMSC = "mxl";
        

        $PDFName = "$nome - $instrumento.$typePDF";
        $PNGName = "$nome - $instrumento.$typePNG";
        $MSCName = "$nome - $instrumento.$typeMSC";

        rename($pathPDF,"../../$path/" . "$PDFName");
        rename($pathPNG,"../../$path/" . "$PNGName");
        rename($pathMSC,"../../$path/" . "$MSCName");

        // Verifica se foi enviado um MP3
        if (isset($_FILES['part4'])) {

            $fileMP3 = $_FILES['part4'];
            $MP3Name = $fileMP3['name'];
            $MP3tmp = $fileMP3['tmp_name'];

            // Definindo o Caminho
            $pathMP3 = "../../$path/" . $MP3Name;

            if (move_uploaded_file($MP3tmp, $pathMP3)) {

                $typeMP3 = "mp3";
                $MP3Name = "$nome - $instrumento.$typeMP3";
                $pathMP3Name = "$path/$MP3Name";
                rename($pathMP3,"../../$path/" . "$MP3Name");
            } else {
                $pathMP3Name = "";
            }

        }
        echo "arquivos movidos!";
        $sql = "INSERT INTO musica (nome, autor_fid, genero_fid, path, path_pdf, path_png, path_msc, path_mp3, pdf_name, png_name, msc_name, mp3_name, iframe, Idinstrumento) VALUES (\"$nome\",\"$autor\",\"$genero\",\"$path\",\"$path/$PDFName\",\"$path/$PNGName\",\"$path/$MSCName\", \"$pathMP3Name\",\"$PDFName\",\"$PNGName\",\"$MSCName\", \"$MP3Name\",\"$iframe\",\"$Idinstrumento\")";
        if (mysqli_query($conn,$sql)) {
            echo "arquivo salvo!";
            header("Location: criarMusica.php");
        } else {
            unlink("../../../".$path/$PDFName);
            unlink("../../../".$path/$PNGName);
            unlink("../../../".$path/$MSCName);
            unlink("../../../".$path/$MP3Name);
            
            rmdir("../../../$path");

            echo "Erro em salvar no BD!";
        };



    }
}

?>