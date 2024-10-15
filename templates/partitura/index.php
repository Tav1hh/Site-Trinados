<?php 
include '../../scripts/conexao.php';
$idmusica = $_GET['id'];

$sql = "SELECT * FROM música where id = $idmusica";
$res = mysqli_query($conn, $sql);
$Partitura = mysqli_fetch_array($res);


$sql = "SELECT * from música Where genero_fid = ".$Partitura['genero_fid'];
$resGen = mysqli_query($conn,$sql);

$sql = "SELECT * from genero Where id = ".$Partitura['genero_fid'];
$res = mysqli_query($conn, $sql);
$Genero = mysqli_fetch_array($res);


$sql = "SELECT * from autor where id = ".$Partitura['autor_fid'];
$res = mysqli_query($conn,$sql);
$autor = mysqli_fetch_array($res)

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
                <button class="btn-back mobile" onclick="javascript:location.href = '../../'"></button>
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
            <form action="../pesquisa/index.php" method="post">
                <input type="search" name="psq" placeholder="Partitura..">
                <button type="submit">Enviar</button>
            </form>
            <div class="controls">
                <button class="btn-back desktop" onclick="javascript:location.href = '../../'"></button>
                <?php
                if (isset($_SESSION['adm'])) {
                    echo "<button class=\"btn-adm desktop\" onclick=\"javascript:location.href = '../../admin/Painel/index.php'\"></button>";
                }
                ?>
            </div>
        </section>
    </header>
    <main>
        <div class="apresentacao">
            <?=$Partitura['iframe']?>
        </div>
        <div class="menu">
            <div class="conteudo">
                <div class="foto-perfil">
                    <button class="perfil" onclick="javascript:location.href = '../autor/index.php?id=<?=$Partitura['autor_fid']?>   '"><img src="../../<?=$autor['path_foto']?>" alt="Foto do autor"></button>
                </div>
                <div class="dados">
                    <h1><?=$autor['nome']?></h1>
                    <h1><strong><?=$Partitura['nome']?></strong></h1>
                    <p><?=$Partitura['instrumento']." - ".$Genero['nome']?></p>
                </div>
            </div>
            <div class="controls">
                <a href="../../<?=$Partitura['path_pdf']?>" target="_blank">Partitura - PDF</a>
                <a href="../../<?=$Partitura['path_msc']?>" target="_blank">Partitura - MSC</a>
            </div>
        </div>
        
        <h2>Semelhantes</h2>
        <section class="musicas">
        <?php
        while ($linha = mysqli_fetch_array($resGen) ) {
            echo "
            <a href=\"index.php?id=".$linha['id']." \">
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