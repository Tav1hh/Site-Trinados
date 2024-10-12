<?php 
include '../../scripts/conexao.php';
$idautor = $_GET['id'];

$sql = "SELECT * from author Where id = $idautor";
$autor = mysqli_query($conn,$sql);
$autor = mysqli_fetch_array($autor);

$sql = "SELECT * from música Where autor_fid = $idautor";
$resMusica = mysqli_query($conn,$sql);

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
        <form>
            <input type="search" placeholder="Partituras...">
            <button type="submit">Procurar</button>
        </form>
        <nav>
            <a href="../enviarPartitura/criarMusica.php">Enviar</a>
        </nav>
    </header>
    <main>

        <div class="conteudo">
            <div>
                <button class="perfil"><img src="../../<?=$autor['path_foto']?>" alt=""></button>
            </div>
            <div class="dados">
                <h1><?=$autor['nome']?></h1>
            </div>
            
        </div>



        <h2>Suas Músicas</h2>
        <section class="musicas">
        <?php
        while ($linha = mysqli_fetch_array($resMusica) ) {
            echo "
            <a href=\"../parts/index.php?id=".$linha['id']." \">
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