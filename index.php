<?php 
include 'scripts/conexao.php';

$sql = 'SELECT * from música Where genero_fid = 1 LIMIT 15';
$resMPB = mysqli_query($conn,$sql);

$sql = 'SELECT * from música Where genero_fid = 2 LIMIT 15';
$resSertanejo = mysqli_query($conn,$sql);

$sql = 'SELECT * from música Where genero_fid = 3 LIMIT 15';
$resSamba = mysqli_query($conn,$sql);

$sql = 'SELECT * from música Where genero_fid = 4 LIMIT 15';
$resBossaNova = mysqli_query($conn,$sql);

$sql = 'SELECT * from música Where genero_fid = 5 LIMIT 15';
$resRock = mysqli_query($conn,$sql);

$sql = 'SELECT * from música Where genero_fid = 6 LIMIT 15';
$resPop = mysqli_query($conn,$sql);

$sql = 'SELECT * from música Where genero_fid = 7 LIMIT 15';
$resJazz = mysqli_query($conn,$sql);

$sql = 'SELECT * from música Where genero_fid = 8 LIMIT 15';
$resBlues = mysqli_query($conn,$sql);

$sql = 'SELECT * from música Where genero_fid = 9 LIMIT 15';
$resRaggae = mysqli_query($conn,$sql);

$sql = 'SELECT * from música Where genero_fid = 10 LIMIT 15';
$resForro = mysqli_query($conn,$sql);

$sql = 'SELECT * from música Where genero_fid = 11 LIMIT 15';
$resClassica = mysqli_query($conn,$sql);

$sql = 'SELECT * from música Where genero_fid = 12 LIMIT 15';
$resGospel = mysqli_query($conn,$sql);

$sql = 'SELECT * from música Where genero_fid = 13 LIMIT 15';
$resHipHop = mysqli_query($conn,$sql);

$sql = 'SELECT * from música Where genero_fid = 14 LIMIT 15';
$resInfantil = mysqli_query($conn,$sql);

$sql = 'SELECT * from música Where genero_fid = 15 LIMIT 15';
$resCinema = mysqli_query($conn,$sql);

$sql = 'SELECT * from música Where genero_fid = 16 LIMIT 15';
$resTheme = mysqli_query($conn,$sql);


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
        <form action="templates/pesquisa/index.php" method="post">
            <input type="search" placeholder="Partituras..." name="psq">
            <button type="submit">Procurar</button>
        </form>

        <nav>
            <!-- <button>
                <img src="imagens/account.png" alt="conta">
            </button> -->
            <a href="templates/enviarPartitura/criarMusica.php">Enviar</a>
        </nav>

    </header>
    <!-- <nav class="menu">
        <a href="#Jazz">Jazz</a>
        <a href="#Classico">Classico</a>
        <a href="#MPB">MPB</a>
        <a href="#Sertanejo">Sertanejo</a>
        <a href="#Religioso">Religioso</a>
        <a href="#Samba" class="mobile">Samba</a>
    </nav> -->

    <main>
        <div class="imagem-principal">  
            Imagens e Noticias da música
        </div>


        
        <h2 id="HipHop">HipHop</h2>
        <section class="musicas">

        <?php
        while ($linha = mysqli_fetch_array($resHipHop) ) {
             
            echo "
            <a href=\"templates/parts/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>
        
        <h2 id="Sertanejo">Sertanejo</h2>
        <section class="musicas">

        <?php
        while ($linha = mysqli_fetch_array($resSertanejo) ) {
             
            echo "
            <a href=\"templates/parts/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>

        <h2 id="Samba">Samba</h2>
        <section class="musicas">

        <?php
        while ($linha = mysqli_fetch_array($resSamba) ) {
             
            echo "
            <a href=\"templates/parts/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>

        <h2 id="BossaNova">Bossa Nova</h2>
        <section class="musicas">

        <?php
        while ($linha = mysqli_fetch_array($resBossaNova) ) {
             
            echo "
            <a href=\"templates/parts/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>

        <h2 id="Rock">Rock</h2>
        <section class="musicas">

        <?php
        while ($linha = mysqli_fetch_array($resRock) ) {
             
            echo "
            <a href=\"templates/parts/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>

        <h2 id="Pop">Pop</h2>
        <section class="musicas">

        <?php
        while ($linha = mysqli_fetch_array($resPop) ) {
             
            echo "
            <a href=\"templates/parts/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>

        <h2 id="Jazz">Jazz</h2>
        <section class="musicas">

        <?php
        while ($linha = mysqli_fetch_array($resJazz) ) {
             
            echo "
            <a href=\"templates/parts/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>

        <h2 id="Blues">Blues</h2>
        <section class="musicas">

        <?php
        while ($linha = mysqli_fetch_array($resBlues) ) {
             
            echo "
            <a href=\"templates/parts/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>

        <h2 id="Raggae">Raggae</h2>
        <section class="musicas">

        <?php
        while ($linha = mysqli_fetch_array($resRaggae) ) {
             
            echo "
            <a href=\"templates/parts/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>

        <h2 id="Forro">Forró</h2>
        <section class="musicas">

        <?php
        while ($linha = mysqli_fetch_array($resForro) ) {
             
            echo "
            <a href=\"templates/parts/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>

        <h2 id="Classica">Música Clásica</h2>
        <section class="musicas">

        <?php
        while ($linha = mysqli_fetch_array($resClassica) ) {
             
            echo "
            <a href=\"templates/parts/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>

        <h2 id="Gospel">Gospel</h2>
        <section class="musicas">

        <?php
        while ($linha = mysqli_fetch_array($resGospel) ) {
             
            echo "
            <a href=\"templates/parts/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>

        <h2 id="MPB">MPB</h2>
        <section class="musicas">

        <?php
        while ($linha = mysqli_fetch_array($resMPB) ) {
             
            echo "
            <a href=\"templates/parts/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>

        <h2 id="Infantil">Infantil</h2>
        <section class="musicas">

        <?php
        while ($linha = mysqli_fetch_array($resInfantil) ) {
             
            echo "
            <a href=\"templates/parts/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>

        <h2 id="Cinema">Cinema</h2>
        <section class="musicas">

        <?php
        while ($linha = mysqli_fetch_array($resCinema) ) {
             
            echo "
            <a href=\"templates/parts/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>

        <h2 id="Theme">Theme</h2>
        <section class="musicas">

        <?php
        while ($linha = mysqli_fetch_array($resTheme) ) {
             
            echo "
            <a href=\"templates/parts/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"".$linha['path_png']."\" alt=\"Partitura\">
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