<?php 
include "../../../scripts/conexao.php";

$id = $_GET['id'];
$nome = $_POST['nome_musica'];
$autor = $_POST['autor'];
$genero = $_POST['gen'];
$Idinstrumento = $_POST['instrumento'];
$iframe = $_POST['iframe'];

// Pegando os Dados do Instrumento
$sql = "SELECT * from instrumento where id = $Idinstrumento";
$res = mysqli_query($conn,$sql);
$linha = mysqli_fetch_array($res);
$instrumento = $linha['nome'];

// Pegando os Dados da Música
$sql = "SELECT * From música where id=".$id;
$res = mysqli_query($conn,$sql);
$musica = mysqli_fetch_array($res);

$sql = "Select música.IdInstrumento, instrumento.nome As instrumento from música join instrumento on instrumento.id = música.IdInstrumento where música.id = $id";
$res = mysqli_query($conn,$sql);
$intr = mysqli_fetch_array($res);


// Dados Música
$MusicaNome = $musica['nome'];
$MusicaPath = $musica['path'];
$MusicaInstrumento = $intr['instrumento'];

$namePDF = $musica['pdf_name'];
$namePNG = $musica['png_name'];
$nameMSC = $musica['msc_name'];

$pathPDF = $musica['path_pdf'];
$pathPNG = $musica['path_png'];
$pathMSC = $musica['path_msc'];

// Tipos de Cada arquivo
$typePDF = "pdf";
$typePNG = "png";
$typeMSC = "mxl";;

// Variaveis para Renomear os arquivos
$novoPathPDF = "$MusicaPath/$nome - $instrumento.$typePDF";
$novoPathPNG = "$MusicaPath/$nome - $instrumento.$typePNG";
$novoPathMSC = "$MusicaPath/$nome - $instrumento.$typeMSC";

echo "$pathPDF <br>";
echo "$novoPathPDF <br>";

rename("../../../$pathPDF","../../../$novoPathPDF");
rename("../../../$pathPNG","../../../$novoPathPNG");
rename("../../../$pathMSC","../../../$novoPathMSC");

// Variaveis para Renomear a Pasta Música
$pathMusica = "partituras/$MusicaInstrumento/$MusicaNome";
$novoPathMusica = "partituras/$MusicaInstrumento/$nome";

rename("../../../$pathMusica","../../../$novoPathMusica");


// Movendo a Pasta Instrumento
// $pastaRename = "partituras/#rename";
// rename("../../../$novoPathInstrumento","../../../$pastaRename/$instrumento");

// Variaveis para Renomear a Pasta instrumento
$pathPasta = "partituras/$MusicaInstrumento/$nome";
$novoPathPasta =  "partituras/$instrumento/$nome";
$PathInstrumento = "partituras/$instrumento/";

// Criando a Pasta
if (!is_dir("../../../".$PathInstrumento)) {
    mkdir("../../../".$PathInstrumento, 0777, true);
}


if ($pathPasta != $novoPathPasta) {
    rename("../../../$pathPasta","../../../$novoPathPasta");
}

// Movendo a Pasta instrumento devolta para seu local
// rename("../../../$pastaRename/$instrumento","../../../$novoPathPasta/$instrumento");

// Todos os caminhos
$path = $novoPathPasta;
$PDFname = "$nome - $instrumento.$typePDF";
$PNGname = "$nome - $instrumento.$typePNG";
$MSCname = "$nome - $instrumento.$typeMSC";
$pathPDF = "$path/$PDFname";
$pathPNG = "$path/$PNGname";
$pathMSC = "$path/$MSCname";

if(isset($_FILES['part1']) && $_FILES['part1']['error'] === UPLOAD_ERR_OK) {
    $PDF = $_FILES['part1'];
    $namePDF = $PDF['name'];
    $tmpPDF = $PDF['tmp_name'];

    // Variaveis para Renomear os arquivos
    $novoPathPDF = "partituras/$instrumento/$nome/$nome - $instrumento.$typePDF";

    unlink("../../../$novoPathPDF");
    move_uploaded_file($tmpPDF,"../../../$novoPathPDF");
    $pathPDF = "$novoPathPDF";
}
if(isset($_FILES['part2']) && $_FILES['part2']['error'] === UPLOAD_ERR_OK) {
    $PNG = $_FILES['part2'];
    $namePNG = $PNG['name'];
    $tmpPNG = $PNG['tmp_name'];

    // Variaveis para Renomear os arquivos
    $novoPathPNG = "partituras/$instrumento/$nome/$nome - $instrumento.$typePNG";

    unlink("../../../$novoPathPNG");
    move_uploaded_file($tmpPNG,"../../../$novoPathPNG");
    $pathPNG = "$novoPathPNG";
}
if(isset($_FILES['part3']) && $_FILES['part3']['error'] === UPLOAD_ERR_OK) {
    $MSC = $_FILES['part3'];
    $nameMSC = $MSC['name'];
    $tmpMSC = $MSC['tmp_name'];

    // Variaveis para Renomear os arquivos
    $novoPathMSC = "partituras/$instrumento/$nome/$nome - $instrumento.$typeMSC";

    unlink("../../../$novoPathMSC");
    move_uploaded_file($tmpMSC,"../../../$novoPathMSC");
    $pathMSC = "$novoPathMSC";
}

$sql = "UPDATE música SET 
    nome = '$nome', 
    autor_fid = '$autor', 
    genero_fid = '$genero', 
    path = '$path', 
    path_pdf = '$pathPDF', 
    path_png = '$pathPNG', 
    path_msc = '$pathMSC', 
    pdf_name = '$PDFname', 
    png_name = '$PNGname', 
    msc_name = '$MSCname', 
    iframe = '$iframe', 
    Idinstrumento = '$Idinstrumento' 
WHERE id = '$id'";

if (mysqli_query($conn,$sql)) {
    echo "Dados atualizados no BD";
    header("Location: ../../Painel/index.php");
} else {
    echo "Dados não foram atualizados!";
};
?>