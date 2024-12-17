<?php 
include '../../scripts/conexao.php';
$idautor = $_GET['id'];

$sql = "SELECT * from autor Where id = $idautor";
$res = mysqli_query($conn,$sql);
$autor = mysqli_fetch_array($res);

$sql = "SELECT musica.nome AS nome, musica.id, musica.path_png AS path_png, instrumento.nome AS instrumento from musica JOIN instrumento ON instrumento.id = musica.idinstrumento WHERE musica.autor_fid = $idautor And musica.idinstrumento = 1";
$resFlauta = mysqli_query($conn,$sql);

$sql = "SELECT musica.nome AS nome, musica.id, musica.path_png AS path_png, instrumento.nome AS instrumento from musica JOIN instrumento ON instrumento.id = musica.idinstrumento WHERE musica.autor_fid = $idautor And musica.idinstrumento = 2";
$resClarinete = mysqli_query($conn,$sql);

$sql = "SELECT musica.nome AS nome, musica.id, musica.path_png AS path_png, instrumento.nome AS instrumento from musica JOIN instrumento ON instrumento.id = musica.idinstrumento WHERE musica.autor_fid = $idautor And musica.idinstrumento = 3";
$resTrompete = mysqli_query($conn,$sql);

$sql = "SELECT musica.nome AS nome, musica.id, musica.path_png AS path_png, instrumento.nome AS instrumento from musica JOIN instrumento ON instrumento.id = musica.idinstrumento WHERE musica.autor_fid = $idautor And musica.idinstrumento = 4";
$resSaxAlto = mysqli_query($conn,$sql);

$sql = "SELECT musica.nome AS nome, musica.id, musica.path_png AS path_png, instrumento.nome AS instrumento from musica JOIN instrumento ON instrumento.id = musica.idinstrumento WHERE musica.autor_fid = $idautor And musica.idinstrumento = 5";
$resSaxTenor = mysqli_query($conn,$sql);

$sql = "SELECT musica.nome AS nome, musica.id, musica.path_png AS path_png, instrumento.nome AS instrumento from musica JOIN instrumento ON instrumento.id = musica.idinstrumento WHERE musica.autor_fid = $idautor And musica.idinstrumento = 6";
$resTrombone = mysqli_query($conn,$sql);


// // Verifica se os dados já estão armazenados em sessão
// if (isset($_SESSION['autor_'])) {
//     // Recupera os dados do cache
//     $autor = $_SESSION['autor_'];
//     $resFlauta = $_SESSION['flauta_'];
//     $resClarinete = $_SESSION['clarinete_'];
//     $resTrompete = $_SESSION['trompete_'];
//     $resSaxAlto = $_SESSION['saxalto_'];
//     $resSaxTenor = $_SESSION['saxtenor_'];
//     $resTrombone = $_SESSION['trombone_'];
// } else {
//     // Realiza as consultas ao banco de dados
//     $idautor = $_GET['id'];
    
//     $sql = "SELECT * from autor Where id = $idautor";
//     $res = mysqli_query($conn, $sql);
//     $autor = mysqli_fetch_array($res);
//     // Salva os dados na sessão para cache
//     $_SESSION['autor_'] = $autor;
    
//     $sql = "SELECT musica.nome AS nome, musica.id, musica.path_png AS path_png, instrumento.nome AS instrumento from musica JOIN instrumento ON instrumento.id = musica.idinstrumento WHERE musica.autor_fid = $idautor And musica.idinstrumento = 1";
//     $resFlauta = mysqli_query($conn, $sql);
//     $_SESSION['flauta_'] = $resFlauta;

//     $sql = "SELECT musica.nome AS nome, musica.id, musica.path_png AS path_png, instrumento.nome AS instrumento from musica JOIN instrumento ON instrumento.id = musica.idinstrumento WHERE musica.autor_fid = $idautor And musica.idinstrumento = 2";
//     $resClarinete = mysqli_query($conn, $sql);
//     $_SESSION['clarinete_'] = $resClarinete;

//     $sql = "SELECT musica.nome AS nome, musica.id, musica.path_png AS path_png, instrumento.nome AS instrumento from musica JOIN instrumento ON instrumento.id = musica.idinstrumento WHERE musica.autor_fid = $idautor And musica.idinstrumento = 3";
//     $resTrompete = mysqli_query($conn, $sql);
//     $_SESSION['trompete_'] = $resTrompete;

//     $sql = "SELECT musica.nome AS nome, musica.id, musica.path_png AS path_png, instrumento.nome AS instrumento from musica JOIN instrumento ON instrumento.id = musica.idinstrumento WHERE musica.autor_fid = $idautor And musica.idinstrumento = 4";
//     $resSaxAlto = mysqli_query($conn, $sql);
//     $_SESSION['saxalto_'] = $resSaxAlto;

//     $sql = "SELECT musica.nome AS nome, musica.id, musica.path_png AS path_png, instrumento.nome AS instrumento from musica JOIN instrumento ON instrumento.id = musica.idinstrumento WHERE musica.autor_fid = $idautor And musica.idinstrumento = 5";
//     $resSaxTenor = mysqli_query($conn, $sql);
//     $_SESSION['saxtenor_'] = $resSaxTenor;

//     $sql = "SELECT musica.nome AS nome, musica.id, musica.path_png AS path_png, instrumento.nome AS instrumento from musica JOIN instrumento ON instrumento.id = musica.idinstrumento WHERE musica.autor_fid = $idautor And musica.idinstrumento = 6";
//     $resTrombone = mysqli_query($conn, $sql);
//     $_SESSION['trombone_'] = $resTrombone;

// }
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
            <img src="../../<?=$autor['path_foto']?>" alt="autor" loading="lazy">
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
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
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
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
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
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
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
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
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
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
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
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
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