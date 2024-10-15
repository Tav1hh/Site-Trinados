<?php 
// include '../../scripts/conexao.php';

// //Testa se está logado
// if (isset($_SESSION['id']) & isset($_SESSION['nome'])) {
//     $id = $_SESSION['id'];
//     $nome = $_SESSION['nome'];

//     // Verificando no Banco de Dados
//     $sql = "SELECT * FROM admin where id = '$id' and nome = '$nome'";
//     $res = mysqli_query($conn,$sql);

//     $usuario = mysqli_fetch_array($res);
//     if ($usuario == null) {
//         session_unset();
//         session_destroy();
//         header('Location: ../../x039.php');
//     }
// } else { 
//     session_unset();
//     session_destroy();
//     header('Location: ../../x039.php');
// }

// $nome = $_POST['nome_autor'];
// $file = $_FILES['part'];

// if (isset($_FILES['part']) && $_FILES['part']['error'] === 0) {
//     $file = $_FILES['part'];

//     // Informações sobre o arquivo
//     $fileName = $file['name']; // Nome do arquivo
//     $fileTmp = $file['tmp_name']; // Local temporário do arquivo no servidor

//     // Define o diretório para mover o arquivo
//     $uploadDir = "autor/$nome";
//     $destination = "$uploadDir/" . basename($fileName);


//     // Criando a Pasta
//     if (!is_dir("../../".$uploadDir)) {
//         mkdir("../../".$uploadDir, 0777, true);
//     }

//     // Move o arquivo para o diretório desejado
//     if (move_uploaded_file($fileTmp, "../../$destination")) {

//         // Define o diretório para mover o arquivo
//         $uploadDir = "autor/$nome";
//         $destination = "$uploadDir/" . basename($fileName);

//         // Pegando o Tipo do Arquivo
//         $caminho = "../../$destination";
//         $tipo = mime_content_type($caminho);
//         // Saber qual é a extensão
//         $mime_map = [
//             'text/plain' => 'txt',
//             'text/html' => 'html',
//             'image/jpeg' => 'jpg',
//             'image/png' => 'png',
//             'application/pdf' => 'pdf',
//             'application/zip' => 'zip',
//             'audio/mpeg' => 'mp3',
//             'video/mp4' => 'mp4',
//             // Adicione mais mapeamentos conforme necessário
//         ];
        
//         $tipo = $mime_map[$tipo];
//         $path_foto = "$uploadDir/$nome.$tipo";
        
        
//         rename("../../$destination","../../$uploadDir/$nome.$tipo");
//         // Salva os dados no Banco de Dados
//         $sql = "INSERT INTO autor (nome, path_foto, path, foto_name) VALUES('$nome','$path_foto','$uploadDir','$nome.$tipo')";


//         mysqli_query($conn,$sql);
//         echo "Arquivo salvo na pasta: " . "$uploadDir <br>";
//         header("Location: criarAutor.php");
        
//     } else {
//         echo "Erro ao mover o arquivo.";
        
//     };
// } else {
//     echo "Nenhum arquivo enviado ou erro no envio.";
// }


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
