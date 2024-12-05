<?php 
include '../../scripts/conexao.php';
$idmusica = $_GET['id'];

$sql = "Select música.nome as nome_musica,
 iframe, 
 música.path_pdf, 
 música.path_msc,
 música.autor_fid,
 instrumento.nome as instrumento, 
 idinstrumento,
 música.genero_fid,
 genero.nome as genero, 
 autor.nome as autor, 
 autor.path_foto as autor_foto 
 from música join instrumento on música.IdInstrumento = instrumento.id join autor on autor.id = música.autor_fid join genero on genero.id = música.genero_fid where música.id=$idmusica";
$res = mysqli_query($conn,$sql);
$resMusica = mysqli_fetch_array($res);

$sql = "SELECT 
 música.id,
 música.nome as nome_musica,
 música.path_png,
 instrumento.nome as instrumento
 from música
 join instrumento on instrumento.id = música.IdInstrumento
Where música.genero_fid = ".$resMusica['genero_fid']." and música.idinstrumento = ".$resMusica['idinstrumento'];
$resGen = mysqli_query($conn,$sql);


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
            <div class="desktop">
                <h1>Trinados</h1>
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
        <div class="apresentacao">
            <?php if ($resMusica['iframe'] == null) {
                echo "<p>Se Grave tocando, poste no instagram e marque @trinados03, A melhor interpretação aparece aqui!</p>";
            } else {
                    echo $resMusica['iframe'];} ?>
        </div>
        <div class="menu">
            <div class="conteudo">
                <div class="foto-perfil">
                    <button class="perfil" onclick="javascript:location.href = '../autor/index.php?id=<?=$resMusica['autor_fid']?>   '"><img src="../../<?=$resMusica['autor_foto']?>" alt="Foto do autor"></button>
                </div>
                <div class="dados">
                    <h1><a href="../autor/index.php?id=<?=$resMusica['autor_fid']?>"><?=$resMusica['autor']?></a></h1>
                    <h1><strong><?=$resMusica['nome_musica']?></strong></h1>
                    <p><?=$resMusica['instrumento']." - ".$resMusica['genero']?></p>
                </div>
            </div>
            <div class="controls">
                <a href="../../<?=$resMusica['path_pdf']?>" target="_blank">Partitura - PDF</a>
                <a href="../../<?=$resMusica['path_msc']?>" target="_blank">Partitura - MXL</a>
            </div>
        </div>
        
        <h2>Semelhantes</h2>
        <section class="musicas">
        <?php
        while ($linha = mysqli_fetch_array($resGen) ) {
            if ($linha['id'] != $idmusica) {

                echo "
                <a href=\"index.php?id=".$linha['id']." \">
                    <div class=\"card\">
                        <img src=\"../../".$linha['path_png']."\" alt=\"Partitura\">
                        <p>".$linha['nome_musica']."</p> 
                        <p>".$linha['instrumento']."</p>
                    </div>
                </a>
                ";
            }
        }
        ?>
        </section>
    </main>
    <footer>
        <p>Site Criado por &copy;<strong><a href="https://tav1hh.github.io/Site-PortfolioV2" target="_blank">Santiago</a></strong></p>
    </footer>
</body>
</html>