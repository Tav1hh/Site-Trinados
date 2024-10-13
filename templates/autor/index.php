<?php 
include '../../scripts/conexao.php';
$idautor = $_GET['id'];

$sql = "SELECT * from author Where id = $idautor";
$res = mysqli_query($conn,$sql);
$autor = mysqli_fetch_array($res);

$sql = "SELECT * from música Where autor_fid = $idautor";
$resMusica = mysqli_query($conn,$sql);

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
        <div>
            <h1>Logo</h1>
        </div>
        <form action="../pesquisa/index.php" method="post">
            <input type="search" name="psq" placeholder="Partitura..">
            <button type="submit">Enviar</button>
        </form>
        <div class="controls">
            <button class="btn-back" onclick="javascript:location.href = '../../'"></button>
            <?php 
            if (isset($_SESSION['adm'])) {
                echo "<button class=\"btn-adm\" onclick=\"javascript:location.href = '../../admin/painel/index.php'\"></button>";
            }
            ?>
        </div>
    </header>
    <main>
        <div class="conteudo">
            <img src="../../<?=$autor['path_foto']?>" alt="">
            <p><?=$autor['nome']?></p>
        </div>

        <h2>Músicas</h2>
        <section class="musicas">
        <?php
        while ($linha = mysqli_fetch_array($resMusica) ) {
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