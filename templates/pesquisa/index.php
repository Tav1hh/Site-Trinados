<?php
include '../../scripts/conexao.php';
$psq = $_POST['psq'];

$sql = "SELECT * FROM autor WHERE nome LIKE '%$psq%'";
$resAutor = mysqli_query($conn,$sql);

$sql = "SELECT 
    música.nome AS nome_musica, 
    música.id,
    música.path_png, 
    instrumento.nome AS instrumento, 
    genero.nome AS genero
FROM música
JOIN genero ON genero.id = música.genero_fid
JOIN instrumento ON instrumento.id = música.Idinstrumento
WHERE música.Idinstrumento = 1
  AND (
       música.nome LIKE '%$psq%' 
       OR instrumento.nome LIKE '%$psq%' 
       OR genero.nome LIKE '%$psq%'
  )
LIMIT 20";
$resSaxTenor = mysqli_query($conn, $sql);

$sql = "SELECT 
    música.nome AS nome_musica, 
    música.id,
    música.path_png, 
    instrumento.nome AS instrumento, 
    genero.nome AS genero
FROM música
JOIN genero ON genero.id = música.genero_fid
JOIN instrumento ON instrumento.id = música.Idinstrumento
WHERE música.Idinstrumento = 3
  AND (
       música.nome LIKE '%$psq%' 
       OR instrumento.nome LIKE '%$psq%' 
       OR genero.nome LIKE '%$psq%'
  )
LIMIT 20";
$resClarinete = mysqli_query($conn, $sql);

$sql = "SELECT 
    música.nome AS nome_musica, 
    música.id,
    música.path_png, 
    instrumento.nome AS instrumento, 
    genero.nome AS genero
FROM música
JOIN genero ON genero.id = música.genero_fid
JOIN instrumento ON instrumento.id = música.Idinstrumento
WHERE música.Idinstrumento = 7
  AND (
       música.nome LIKE '%$psq%' 
       OR instrumento.nome LIKE '%$psq%' 
       OR genero.nome LIKE '%$psq%'
  )
LIMIT 20";
$resTrompete = mysqli_query($conn, $sql);

$sql = "SELECT 
    música.nome AS nome_musica, 
    música.id,
    música.path_png, 
    instrumento.nome AS instrumento, 
    genero.nome AS genero
FROM música
JOIN genero ON genero.id = música.genero_fid
JOIN instrumento ON instrumento.id = música.Idinstrumento
WHERE música.Idinstrumento = 8
  AND (
       música.nome LIKE '%$psq%' 
       OR instrumento.nome LIKE '%$psq%' 
       OR genero.nome LIKE '%$psq%'
  )
LIMIT 20";
$resTrombone = mysqli_query($conn, $sql);

$sql = "SELECT 
    música.nome AS nome_musica, 
    música.id,
    música.path_png, 
    instrumento.nome AS instrumento, 
    genero.nome AS genero
FROM música
JOIN genero ON genero.id = música.genero_fid
JOIN instrumento ON instrumento.id = música.Idinstrumento
WHERE música.Idinstrumento = 9
  AND (
       música.nome LIKE '%$psq%' 
       OR instrumento.nome LIKE '%$psq%' 
       OR genero.nome LIKE '%$psq%'
  )
LIMIT 20";
$resFlauta = mysqli_query($conn, $sql);

$sql = "SELECT 
    música.nome AS nome_musica, 
    música.id,
    música.path_png, 
    instrumento.nome AS instrumento, 
    genero.nome AS genero
FROM música
JOIN genero ON genero.id = música.genero_fid
JOIN instrumento ON instrumento.id = música.Idinstrumento
WHERE música.Idinstrumento = 11
  AND (
       música.nome LIKE '%$psq%' 
       OR instrumento.nome LIKE '%$psq%' 
       OR genero.nome LIKE '%$psq%'
  )
LIMIT 20";
$resSaxAlto= mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trinados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="cabecalho mobile">
            <div class="controls">
                <button class="btn-back mobile" onclick="javascript:location.href = '/Trinados'"></button>
            </div>
            <h1>Trinados</h1>
            <div class="controls">
                <?php
                    if (isset($_SESSION['adm'])) {
                        echo "<button class=\"btn-adm mobile\" onclick=\"javascript:location.href = '../../admin/Painel/index.php'\"></button>";
                    }
                ?>
            </div>
        </div>
        <section>
            <div>
                <h1 class="desktop">Trinados</h1>
            </div>
            <form action="#" method="post">
                <input type="search" name="psq" placeholder="Partitura..">
                <button type="submit">Enviar</button>
            </form>
            <div class="controls">
                <button class="btn-back desktop" onclick="javascript:location.href = '/Trinados'"></button>
                <?php
                if (isset($_SESSION['adm'])) {
                    echo "<button class=\"btn-adm desktop\" onclick=\"javascript:location.href = '../../admin/Painel/index.php'\"></button>";
                }
                ?>
            </div>
        </section>
    </header>
    <main>

        <h2>Resultados da Busca:</h2>
        <section class="autores">
        <?php
        while ($linha = mysqli_fetch_array($resAutor) ) {
            echo "
            <a href=\"../autor/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"../../".$linha['path_foto']."\" alt=\"Autor\">
                    <p>".$linha['nome']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>
        <h2>Músicas</h2>
        <h3>Flauta Transversal em C</h3>
        <section class="musicas">
        <?php
        while ($linha = mysqli_fetch_array($resFlauta) ) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome_musica']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>
        <h3>Clarinete em B♭</h3>
        <section class="musicas">
        <?php
        while ($linha = mysqli_fetch_array($resClarinete) ) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome_musica']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>
        <h3>Trompete em B♭</h3>
        <section class="musicas">
        <?php
        while ($linha = mysqli_fetch_array($resTrompete) ) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome_musica']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>
        <h3>Saxofone Alto em E♭</h3>
        <section class="musicas">
        <?php
        while ($linha = mysqli_fetch_array($resSaxAlto) ) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome_musica']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>
        <h3>Saxofone Tenor em B♭</h3>
        <section class="musicas">
        <?php
        while ($linha = mysqli_fetch_array($resSaxTenor) ) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome_musica']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>
        <h3>Trombone em C</h3>
        <section class="musicas">
        <?php
        while ($linha = mysqli_fetch_array($resTrombone) ) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\">
                    <p>".$linha['nome_musica']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>
    </main>
    <footer>
        <p>Site Criado por &copy;<strong><a href="https://tav1hh.github.io/Site-PortfolioV2" target="_blank">Santiago</a></strong></p>
    </footer>
</body>
</html>