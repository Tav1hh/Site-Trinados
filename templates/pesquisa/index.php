<?php 
include '../../scripts/conexao.php';
$psq = $_POST['psq'];

$sql = "SELECT * FROM música WHERE nome LIKE '%$psq%' or instrumento LIKE '%$psq%'";
$resMusica = mysqli_query($conn,$sql);

$sql = "SELECT * FROM author WHERE nome LIKE '%$psq%'";
$resAutor = mysqli_query($conn,$sql);
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
        <form action="#" method="post">
            <input type="search" name="psq" placeholder="Partitura..">
            <button type="submit">Enviar</button>
        </form>
        <div class="controls">
            <button class="btn-back" onclick="javascript:location.href = '../../'"></button>
            <?php 
            if (isset($_SESSION['adm'])) {
                echo "<button class=\"btn-adm\" onclick=\"javascript:location.href = '../../admin/Painel.index.php'\"></button>";
            }
            ?>
        </div>
    </header>
    <main>

        <h2>Resultados da Busca:</h2>
        <section class="autores">
        <?php
        while ($linha = mysqli_fetch_array($resAutor) ) {
            echo "
            <a href=\"../autor/index.php?id=".$linha['id']." \">
                <div class=\"card\">
                    <img src=\"../../".$linha['path_foto']."\" alt=\"Partitura\">
                    <p>".$linha['nome']."</p>
                </div>
            </a>
            ";
        }
        ?>
        </section>

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