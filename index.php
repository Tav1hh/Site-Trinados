<?php 
include 'scripts/conexao.php';

$sql = 'SELECT * from música';
$res = mysqli_query($conn,$sql);
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

            </div>
            <h1>Trinados</h1>
            <div class="controls">
                <?php
                    if (isset($_SESSION['adm'])) {
                        echo "<button class=\"btn-adm mobile\" onclick=\"javascript:location.href = 'admin/Painel/index.php'\"></button>";
                    }
                ?>
            </div>
        </div>
        <section>
            <div class="desktop">
                <h1>Trinados</h1>
            </div>
            <form action="templates/pesquisa/index.php" method="post">
                <input type="search" name="psq" placeholder="Partitura..">
                <button type="submit">Enviar</button>
            </form>
            <div class="controls">
                <?php
                if (isset($_SESSION['adm'])) {
                    echo "<button class=\"btn-adm desktop\" onclick=\"javascript:location.href = 'admin/Painel/index.php'\"></button>";
                }
                ?>
            </div>
        </section>
    </header>
    <main>
        <div class="apresentacao">
            Curiosidades e Noticias da Música
        </div>
        
        <h2>Músicas</h2>
        <section class="musicas">
        <?php
        while ($linha = mysqli_fetch_array($res) ) {
            echo "
            <a href=\"templates/partitura/index.php?id=".$linha['id']." \">
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
    <footer>
        <p>Site Criado por &copy;<strong><a href="https://tav1hh.github.io/Site-PortfolioV2" target="_blank">Santiago</a></strong></p>
    </footer>
</body>
</html>