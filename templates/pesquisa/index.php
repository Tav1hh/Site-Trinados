<?php 
include '../../scripts/conexao.php';

$psq = $_POST['psq'];

$sql = "SELECT * FROM música WHERE nome LIKE '%$psq%'";
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
        <h1>Logo</h1>
        <form action="index.php" method="post">
            <input type="search" placeholder="Partituras..." name="psq">
            <button type="submit">Procurar</button>
        </form>

        <nav>
            <a href="templates/enviarPartitura/criarMusica.php">Enviar</a>
        </nav>

    </header>

    <main>
        <!-- <div class="imagem-principal">  
            Imagens e Noticias da música
        </div> -->


        
        <h2 id="HipHop">HipHop</h2>
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