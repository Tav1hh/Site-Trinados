<?php 
include '../../scripts/conexao.php';
$idmusica = $_GET['id'];

$sql = "SELECT * FROM música where id = $idmusica";
$resmusica = mysqli_query($conn, $sql);

while ($linha = mysqli_fetch_array($resmusica)) {
    $nome =  $linha['nome'];
    $iframe = $linha['iframe'];
    $instrumento = $linha['instrumento'];
    $idGenero = $linha['genero_fid'];
    $idautor = $linha['autor_fid'];
    $path_PDF = $linha['path_pdf'];
    $path_MSC = $linha['path_msc'];
    $path_PB = $linha['path_playback'];
};

$sql = "SELECT * from música Where genero_fid = $idGenero LIMIT 15";
$resGen = mysqli_query($conn,$sql);


$sql = "SELECT * from author where id = $idautor";
$res = mysqli_query($conn,$sql);
$autor = mysqli_fetch_array($res)

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <header>
        <h1><a href="../../index.php">Logo</a></h1>

        <form action="..//pesquisa/index.php" method="post">
            <input type="search" placeholder="Partituras..." name="psq">
            <button type="submit">Procurar</button>
        </form>

        <nav>
            <a href="../enviarPartitura/criarMusica.php">Enviar</a>
        </nav>

    </header>

    <main>
        <div class="imagem-principal">  
            <?=$iframe?>
        </div>

            <div class="menu">
                    <div class="conteudo">
                        <div>
                            <button class="perfil" onclick="javascript:location.href = '../autor/index.php?id=<?=$idautor?>   '"><img src="../../<?=$autor['path_foto']?>" alt=""></button>
                        </div>
                        <div class="dados">
                            <h1><?php echo "$nome"?></h1>
                            <p><?=$instrumento?></p>
                        </div>
                    </div>
                    <div class="controls">
                        <a href="<?="../../".$path_PDF?>" target="_blank">Partitura - PDF</a>
                        <a href="<?="../../".$path_MSC?>" target="_blank">Partitura - MSC</a>
                    </div>
                </div>

        <h2>Semelhantes</h2>

        <section class="musicas">

        <?php
        while ($linha = mysqli_fetch_array($resGen) ) {
            echo "
            <a href=\"index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>

        </section>




    </main>


</body>
</html>