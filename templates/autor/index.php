<?php 
include '../../scripts/conexao.php';
$idautor = $_GET['id'];

$sql = "SELECT * from autor Where id = $idautor";
$res = mysqli_query($conn,$sql);
$autor = mysqli_fetch_array($res);

$sql = "SELECT 
    música.nome AS nome, 
    música.id,
    música.path_png AS path_png, 
    instrumento.nome AS instrumento
FROM música
JOIN instrumento ON instrumento.id = música.idinstrumento
WHERE música.autor_fid = $idautor And música.idinstrumento = 1";
$resSaxTenor = mysqli_query($conn,$sql);

$sql = "SELECT 
    música.nome AS nome, 
    música.id,
    música.path_png AS path_png, 
    instrumento.nome AS instrumento
FROM música
JOIN instrumento ON instrumento.id = música.idinstrumento
WHERE música.autor_fid = $idautor And música.idinstrumento = 3";
$resClarinete = mysqli_query($conn,$sql);

$sql = "SELECT 
    música.nome AS nome, 
    música.id,
    música.path_png AS path_png, 
    instrumento.nome AS instrumento
FROM música
JOIN instrumento ON instrumento.id = música.idinstrumento
WHERE música.autor_fid = $idautor And música.idinstrumento = 7";
$resTrompete = mysqli_query($conn,$sql);

$sql = "SELECT 
    música.nome AS nome, 
    música.id,
    música.path_png AS path_png, 
    instrumento.nome AS instrumento
FROM música
JOIN instrumento ON instrumento.id = música.idinstrumento
WHERE música.autor_fid = $idautor And música.idinstrumento = 8";
$resTrombone = mysqli_query($conn,$sql);

$sql = "SELECT 
    música.nome AS nome, 
    música.id,
    música.path_png AS path_png, 
    instrumento.nome AS instrumento
FROM música
JOIN instrumento ON instrumento.id = música.idinstrumento
WHERE música.autor_fid = $idautor And música.idinstrumento = 9";
$resFlauta = mysqli_query($conn,$sql);

$sql = "SELECT 
    música.nome AS nome, 
    música.id,
    música.path_png AS path_png, 
    instrumento.nome AS instrumento
FROM música
JOIN instrumento ON instrumento.id = música.idinstrumento
WHERE música.autor_fid = $idautor And música.idinstrumento = 11";
$resSaxAlto = mysqli_query($conn,$sql);

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
                <button class="btn-back mobile" onclick="javascript:location.href ='/Trinados'"></button>
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
            <form action="../pesquisa/index.php" method="post">
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
        <div class="conteudo">
            <img src="../../<?=$autor['path_foto']?>" alt="">
            <p><?=$autor['nome']?></p>
        </div>

        <h2>Músicas</h2>
        <h3>Flauta Transversal em C</h3>
        <section class="musicas">
        <?php
        while ($linha = mysqli_fetch_array($resFlauta) ) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
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
        <h3>Clarinete em B♭</h3>
        <section class="musicas">
        <?php
        while ($linha = mysqli_fetch_array($resClarinete) ) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
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
        <h3>Trompete em B♭</h3>
        <section class="musicas">
        <?php
        while ($linha = mysqli_fetch_array($resTrompete) ) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
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
        <h3>Saxofone Alto em E♭</h3>
        <section class="musicas">
        <?php
        while ($linha = mysqli_fetch_array($resSaxAlto) ) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
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
        <h3>Saxofone Tenor em B♭</h3>
        <section class="musicas">
        <?php
        while ($linha = mysqli_fetch_array($resSaxTenor) ) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
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
        <h3>Trombone em C</h3>
        <section class="musicas">
        <?php
        while ($linha = mysqli_fetch_array($resTrombone) ) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
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
    <footer>
        <p>Site Criado por &copy;<strong><a href="https://tav1hh.github.io/Site-PortfolioV2" target="_blank">Santiago</a></strong></p>
    </footer>
</body>
</html>