<?php 
include "../../../scripts/conexao.php";

$id = $_GET['id'];
$nome = $_POST['nome_musica'];
$autor = $_POST['autor'];
$genero = $_POST['gen'];
$Idinstrumento = $_POST['instrumento'];
$iframe = $_POST['iframe'];

$sql = "SELECT * from instrumento where id = $Idinstrumento";
$res = mysqli_query($conn,$sql);
$linha = mysqli_fetch_array($res);
$instrumento = $linha['nome'];

$sql = "SELECT * From música where id=".$id;
$res = mysqli_query($conn,$sql);
$musica = mysqli_fetch_array($res);


// // Verifica se os arquivos foram enviados
// if (isset($_FILES['part1']) && isset($_FILES['part2']) && isset($_FILES['part3'])) {
    
//     $filePDF = $_FILES['part1'];
//     $filePNG = $_FILES['part2'];
//     $fileMSC = $_FILES['part3'];

//     $PDFName = $filePDF['name'];
//     $PNGName = $filePNG['name'];
//     $MSCName = $fileMSC['name'];
    
//     $PDFtmp = $filePDF['tmp_name'];
//     $PNGtmp = $filePNG['tmp_name'];
//     $MSCtmp = $fileMSC['tmp_name'];

//     // Definindo o caminho de destino
//     $path = "partituras/$nome/$instrumento";

//     // Criando a Pasta
//     if (!is_dir("../../".$path)) {
//         mkdir("../../".$path, 0777, true);
//     }

//     // Definindo os caminhos de cada um

//     $pathPDF = "../../$path/" . $PDFName;
//     $pathPNG = "../../$path/" . $PNGName;
//     $pathMSC = "../../$path/" . $MSCName;

//     // Movendo os arquivos
//     if (move_uploaded_file($PDFtmp, $pathPDF) && move_uploaded_file($PNGtmp, $pathPNG) && move_uploaded_file($MSCtmp, $pathMSC)) {

//         echo "arquivos movidos!";

//         $sql = "INSERT INTO música (nome, autor_fid, genero_fid, path, path_pdf, path_png, path_msc, pdf_name, png_name, msc_name, iframe, Idinstrumento, instrumento) VALUES ('$nome','$autor','$genero','$path','$path/$PDFName','$path/$PNGName','$path/$MSCName','$PDFName','$PNGName','$MSCName','$iframe','$Idinstrumento', '$instrumento')";
//         if (mysqli_query($conn,$sql)) {
//             echo "arquivo salvo!";
//             header("Location: criarMusica.php");
//         } else {
//             echo "Erro em salvar no BD!";
//         };

//     }
// }
// "path, path_pdf, path_png, path_msc, pdf_name, png_name, msc_name,";

$path = "partituras/$nome/$instrumento";

$PDFName = $musica['pdf_name'];
$PNGName = $musica['png_name'];
$MSCName = $musica['msc_name'];

// $path;
// $path/$PDFName;
// $path/$PNGName;
// $path/$MSCName;
// $PDFName;
// $PNGName;
// $MSCName;

$sql = "UPDATE música set nome='$nome', autor_fid='$autor', genero_fid='$genero', iframe='$iframe', Idinstrumento='$Idinstrumento', instrumento='$instrumento',path='$path', path_pdf='$path/$PDFName', path_png='$path/$PNGName', path_msc='$path/$MSCName' where id=".$id;


// echo "../../../partituras/".$musica['nome'] ."<br>";
// echo "../../../partituras/".$nome. "<br>";
// echo "../../../partituras/".$nome."/".$musica['instrumento']. "<br>";
// echo "../../../partituras/".$nome."/".$instrumento. "<br>";


// if (rename("../../../PARTS","../../../PARA")) {
//     echo "Renomeada!";
// } else {
//     echo "Não renomeada!";
// };

// if (rename("../../../partituras/".$musica['nome'],"../../../partituras/".$nome) & rename("../../../partituras/".$nome."/".$musica['instrumento'],"../../../partituras/".$nome."/".$instrumento)) {
//     echo "Renomeado com Sucesso! <br>";
//     if (mysqli_query($conn,$sql)) {
//         echo "Atualizado! <br>";
//     } else {
//         echo "Erro! <br>";
//     }
// } else {
//     echo "Não foi possivel Renomear <br>";
// };

$caminho = "../../partituras/Pixinguinha/Trio/Aquarela do Brasil-1.png";
function verificarPermissoes($caminho) {
    if (!file_exists($caminho)) {
        echo 'O caminho especificado não existe.';
        return;
    }

    $permissoes = fileperms($caminho);

    // Formatar as permissões em formato legível (por exemplo, rwxr-xr-x)
    $info = ($permissoes & 0x4000) ? 'd' : '-'; // Diretório ou arquivo
    $info .= ($permissoes & 0x0100) ? 'r' : '-'; // Dono: leitura
    $info .= ($permissoes & 0x0080) ? 'w' : '-'; // Dono: escrita
    $info .= ($permissoes & 0x0040) ? (($permissoes & 0x0800) ? 's' : 'x') : '-'; // Dono: execução

    $info .= ($permissoes & 0x0020) ? 'r' : '-'; // Grupo: leitura
    $info .= ($permissoes & 0x0010) ? 'w' : '-'; // Grupo: escrita
    $info .= ($permissoes & 0x0008) ? (($permissoes & 0x0400) ? 's' : 'x') : '-'; // Grupo: execução

    $info .= ($permissoes & 0x0004) ? 'r' : '-'; // Outros: leitura
    $info .= ($permissoes & 0x0002) ? 'w' : '-'; // Outros: escrita
    $info .= ($permissoes & 0x0001) ? (($permissoes & 0x0200) ? 't' : 'x') : '-'; // Outros: execução

    echo "Permissões de '$caminho': $info";
}

$caminho = '../../../partituras/Aquarela do Brasil';
verificarPermissoes($caminho);

?>