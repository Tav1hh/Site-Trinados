<?php 
include '../../scripts/conexao.php';

$idmusica = $_POST['nome_musica'];
$instrumento = $_POST['instrumento'];
$iframe = $_POST['iframe'];

$sql = "SELECT * from música where id= '$idmusica'";
$res = mysqli_query($conn,$sql);
$linha = mysqli_fetch_array($res);
$nome = $linha['nome'];


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
    $path = "partituras/$nome/";

    // Criando a Pasta
    if (!is_dir("../../".$path)) {
        mkdir("../../".$path, 0777, true);
    }

    // Definindo os caminhos de cada um
    $pathPDF = "../../".$path . $PDFName;
    $pathPNG = "../../".$path . $PNGName;
    $pathMSC = "../../".$path . $MSCName;

    // Movendo os arquivos
    if (move_uploaded_file($PDFtmp, $pathPDF) && move_uploaded_file($PNGtmp, $pathPNG) && move_uploaded_file($MSCtmp, $pathMSC)) {
        echo "arquivos movidos!";

        $sql = "INSERT INTO música (path_pdf, path_png, path_msc, iframe) VALUES'$idmusica','$instrumento','$path$PDFName','$path$PNGName','$path$MSCName','$iframe')";
        if (mysqli_query($conn,$sql)) {
            echo "arquivo salvo!";
        };

    }
}

?>