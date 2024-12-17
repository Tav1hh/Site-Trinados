<?php
include '../../scripts/conexao.php';
$psq = $_POST['psq'];

$sql = "SELECT * FROM autor WHERE nome LIKE '%$psq%'";
$resAutor = mysqli_query($conn,$sql);

$sql = "SELECT musica.nome AS nome_musica, musica.id, musica.path_png, instrumento.nome AS instrumento, genero.nome AS genero from musica JOIN genero ON genero.id = musica.genero_fid JOIN instrumento ON instrumento.id = musica.Idinstrumento WHERE musica.Idinstrumento = 1 AND (musica.nome LIKE '%$psq%' OR instrumento.nome LIKE '%$psq%' OR genero.nome LIKE '%$psq%') LIMIT 20";
$resFlauta = mysqli_query($conn, $sql);

$sql = "SELECT musica.nome AS nome_musica, musica.id, musica.path_png, instrumento.nome AS instrumento, genero.nome AS genero from musica JOIN genero ON genero.id = musica.genero_fid JOIN instrumento ON instrumento.id = musica.Idinstrumento WHERE musica.Idinstrumento = 2 AND (musica.nome LIKE '%$psq%' OR instrumento.nome LIKE '%$psq%' OR genero.nome LIKE '%$psq%') LIMIT 20";
$resClarinete = mysqli_query($conn, $sql);

$sql = "SELECT musica.nome AS nome_musica, musica.id, musica.path_png, instrumento.nome AS instrumento, genero.nome AS genero from musica JOIN genero ON genero.id = musica.genero_fid JOIN instrumento ON instrumento.id = musica.Idinstrumento WHERE musica.Idinstrumento = 3 AND (musica.nome LIKE '%$psq%' OR instrumento.nome LIKE '%$psq%' OR genero.nome LIKE '%$psq%') LIMIT 20";
$resTrompete = mysqli_query($conn, $sql);

$sql = "SELECT musica.nome AS nome_musica, musica.id, musica.path_png, instrumento.nome AS instrumento, genero.nome AS genero from musica JOIN genero ON genero.id = musica.genero_fid JOIN instrumento ON instrumento.id = musica.Idinstrumento WHERE musica.Idinstrumento = 4 AND (musica.nome LIKE '%$psq%' OR instrumento.nome LIKE '%$psq%' OR genero.nome LIKE '%$psq%') LIMIT 20";
$resSaxAlto= mysqli_query($conn, $sql);

$sql = "SELECT musica.nome AS nome_musica, musica.id, musica.path_png, instrumento.nome AS instrumento, genero.nome AS genero from musica JOIN genero ON genero.id = musica.genero_fid JOIN instrumento ON instrumento.id = musica.Idinstrumento WHERE musica.Idinstrumento = 5 AND (musica.nome LIKE '%$psq%' OR instrumento.nome LIKE '%$psq%' OR genero.nome LIKE '%$psq%') LIMIT 20";
$resSaxTenor = mysqli_query($conn, $sql);

$sql = "SELECT musica.nome AS nome_musica, musica.id, musica.path_png, instrumento.nome AS instrumento, genero.nome AS genero from musica JOIN genero ON genero.id = musica.genero_fid JOIN instrumento ON instrumento.id = musica.Idinstrumento WHERE musica.Idinstrumento = 6 AND (musica.nome LIKE '%$psq%' OR instrumento.nome LIKE '%$psq%' OR genero.nome LIKE '%$psq%') LIMIT 20";
$resTrombone = mysqli_query($conn, $sql);


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
            <form action="#" method="post">
                <input type="search" name="psq" placeholder="Partitura..">
                <button type="submit">Enviar</button>
            </form>
            <div class="controls">
                <button class="btn-back desktop" onclick="javascript:location.href ='/Trinados'"></button>
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
        <?php
            if (mysqli_num_rows($resAutor) > 0) {
                print "<h2>Autores</h2>";
                print "<section class=\"autores\">";

                while ($linha = mysqli_fetch_array($resAutor)) {
                    echo "
                    <a href=\"../autor/index.php?id=".$linha['id']."\">
                        <div class=\"card\">
                            <img src=\"../../".$linha['path_foto']."\" alt=\"Autor\" loading=\"lazy\">
                            <p>".$linha['nome']."</p>
                        </div>
                    </a>
                    ";
                }
                print "</section>";
            }

// Músicas
if (mysqli_num_rows($resFlauta) > 0 or mysqli_num_rows($resClarinete) > 0 or mysqli_num_rows($resTrompete) > 0 or mysqli_num_rows($resSaxAlto) > 0 or mysqli_num_rows($resSaxTenor) > 0 or mysqli_num_rows($resTrombone) > 0) {
    print "<h2>Músicas</h2>";
    if (mysqli_num_rows($resFlauta) > 0) {
        print "<h3>Flauta Transversal em C</h3>";
        print "<section class=\"musicas\">";
        
        while ($linha = mysqli_fetch_array($resFlauta)) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
                    <p>".$linha['nome_musica']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        print "</section>";
    }

    if (mysqli_num_rows($resClarinete) > 0) {
        print "<h3>Clarinete em B♭</h3>";
        print "<section class=\"musicas\">";
        
        while ($linha = mysqli_fetch_array($resClarinete)) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
                    <p>".$linha['nome_musica']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        print "</section>";
    }
            
    if (mysqli_num_rows($resTrompete) > 0) {
        print "<h3>Trompete em B♭</h3>";
        print "<section class=\"musicas\">";
        
        while ($linha = mysqli_fetch_array($resTrompete)) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
                    <p>".$linha['nome_musica']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        print "</section>";
    }

    if (mysqli_num_rows($resSaxAlto) > 0) {
        print "<h3>Saxofone Alto em E♭</h3>";
        print "<section class=\"musicas\">";
        
        while ($linha = mysqli_fetch_array($resSaxAlto)) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
                    <p>".$linha['nome_musica']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        print "</section>";
    }

    if (mysqli_num_rows($resSaxTenor) > 0) {
        print "<h3>Saxofone Tenor em B♭</h3>";
        print "<section class=\"musicas\">";
        
        while ($linha = mysqli_fetch_array($resSaxTenor)) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
                    <p>".$linha['nome_musica']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        print "</section>";
    }

    if (mysqli_num_rows($resTrombone) > 0) {
        print "<h3>Trombone em C</h3>";
        print "<section class=\"musicas\">";
        
        while ($linha = mysqli_fetch_array($resTrombone)) {
            echo "
            <a href=\"../partitura/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
                    <p>".$linha['nome_musica']."</p>
                    <p>".$linha['instrumento']."</p>
                </div>
            </a>
            ";
        }
        print "</section>";
    }
} else {
    print "<h3>Nenhuma Música ou Autor Encontrado..<h3>";
}
?>

    </main>
    <footer>
        <p>Site Criado por &copy;<strong><a href="https://tav1hh.github.io/Site-PortfolioV2" target="_blank">Santiago</a></strong></p>
    </footer>
</body>
</html>