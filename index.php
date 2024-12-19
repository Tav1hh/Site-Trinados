<?php 
include 'scripts/conexao.php';

// $sql = 'SELECT musica.nome as nome, musica.id as id, musica.path_png as path_png , instrumento.nome as instrumento from musica join instrumento on musica.IdInstrumento = instrumento.id where musica.idInstrumento = 1';
// $resFlauta = mysqli_query($conn, $sql);

// $sql = 'SELECT musica.nome as nome, musica.id as id, musica.path_png as path_png , instrumento.nome as instrumento from musica join instrumento on musica.IdInstrumento = instrumento.id where musica.idInstrumento = 2';
// $resClarinete = mysqli_query($conn,$sql);

// $sql = 'SELECT musica.nome as nome, musica.id as id, musica.path_png as path_png , instrumento.nome as instrumento from musica join instrumento on musica.IdInstrumento = instrumento.id where musica.idInstrumento = 3';
// $resTrompete = mysqli_query($conn,$sql);

// $sql = 'SELECT musica.nome as nome, musica.id as id, musica.path_png as path_png , instrumento.nome as instrumento from musica join instrumento on musica.IdInstrumento = instrumento.id where musica.idInstrumento = 4';
// $resSaxAlto = mysqli_query($conn,$sql);

// $sql = 'SELECT musica.nome as nome, musica.id as id, musica.path_png as path_png , instrumento.nome as instrumento from musica join instrumento on musica.IdInstrumento = instrumento.id where musica.idInstrumento = 5';
// $resSaxTenor = mysqli_query($conn,$sql);

// $sql = 'SELECT musica.nome as nome, musica.id as id, musica.path_png as path_png , instrumento.nome as instrumento from musica join instrumento on musica.IdInstrumento = instrumento.id where musica.idInstrumento = 6';
// $resTrombone = mysqli_query($conn,$sql);

if(!isset($_SESSION['home'])) {
    $sql = 'SELECT musica.nome as nome, musica.id as id, musica.path_png as path_png, instrumento.nome as instrumento, instrumento.id as instrumento_id FROM musica JOIN instrumento ON musica.IdInstrumento = instrumento.id';
    $result = mysqli_query($conn, $sql);
    
    $musicas = [];
    
    while ($row = mysqli_fetch_array($result)) {
        $instrumentoId = $row['instrumento_id'];
        $instrumentoNome = $row['instrumento'];
    
        // Inicializa o array do instrumento, se necessário
        if (!isset($musicas[$instrumentoId])) {
            $musicas[$instrumentoId] = [
                'instrumento' => $instrumentoNome,
                'musicas' => []
            ];
        }
    
        // Adiciona a música ao array do instrumento correspondente
        $musicas[$instrumentoId]['musicas'][] = [
            'id' => $row['id'],
            'nome' => $row['nome'],
            'path_png' => $row['path_png'],
        ];
    }
    $resFlauta = $musicas["1"];
    $resClarinete = $musicas["2"];
    $resTrompete = $musicas["3"];
    $resSaxAlto = $musicas["4"];
    $resSaxTenor = $musicas["5"];
    $resTrombone = $musicas["6"];
      
    $_SESSION['home'] = [
        $resFlauta,
        $resTrompete,
        $resClarinete,
        $resSaxAlto,
        $resSaxTenor,
        $resTrombone
    ];
} else {
    $resFlauta = $_SESSION['home'][0];
    $resClarinete = $_SESSION['home'][1];
    $resTrompete = $_SESSION['home'][2];
    $resSaxAlto = $_SESSION['home'][3];
    $resSaxTenor = $_SESSION['home'][4];
    $resTrombone = $_SESSION['home'][5];
}
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
        <h3>Flauta Transversal em C</h3>
        <div class="botoes">
            <div class="left"><button class="btn-left" onclick="javascript:document.querySelectorAll('.musicas')[0].scrollBy({left:-370, behavior:'smooth'})"></button></div>
            <div class="right"><button class="btn-right" onclick="javascript:document.querySelectorAll('.musicas')[0].scrollBy({left:370, behavior:'smooth'})"></button></div>
        </div>
        <section class="musicas carroselRight">
        <?php
        if ($resFlauta) {
            foreach ($resFlauta['musicas'] as $linha) {
                echo "
                <a href=\"templates/partitura/index.php?id=".$linha['id']." \">
                    <div class=\"card\">
                        <img src=\"".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
                        <p>".$linha['nome']."</p>
                        <p>".$resFlauta['instrumento']."</p>
                    </div>
                </a>
                ";
            }
        }
        ?>
        </section>
        <h3>Clarinete em B♭</h3>
        <div class="botoes">
            <div class="left"><button class="btn-left" onclick="javascript:document.querySelectorAll('.musicas')[1].scrollBy({left:-370, behavior:'smooth'})"></button></div>
            <div class="right"><button class="btn-right" onclick="javascript:document.querySelectorAll('.musicas')[1].scrollBy({left:370, behavior:'smooth'})"></button></div>
        </div>
        <section class="musicas carroselLeft">
        <?php
        if ($resClarinete) {
            foreach ($resClarinete['musicas'] as $linha) {
                echo "
                <a href=\"templates/partitura/index.php?id=".$linha['id']." \">
                    <div class=\"card\">
                        <img src=\"".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
                        <p>".$linha['nome']."</p>
                        <p>".$resClarinete['instrumento']."</p>
                    </div>
                </a>
                ";
            }
        }
        ?>
        </section>
        <h3>Trompete em B♭</h3>
        <div class="botoes">
            <div class="left"><button class="btn-left" onclick="javascript:document.querySelectorAll('.musicas')[2].scrollBy({left:-370, behavior:'smooth'})"></button></div>
            <div class="right"><button class="btn-right" onclick="javascript:document.querySelectorAll('.musicas')[2].scrollBy({left:370, behavior:'smooth'})"></button></div>
        </div>
        <section class="musicas carroselRight">
        <?php
        if ($resTrompete) {
            foreach ($resTrompete['musicas'] as $linha) {
                echo "
                <a href=\"templates/partitura/index.php?id=".$linha['id']." \">
                    <div class=\"card\">
                        <img src=\"".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
                        <p>".$linha['nome']."</p>
                        <p>".$resTrompete['instrumento']."</p>
                    </div>
                </a>
                ";
            }
        }
        ?>
        </section>
        <h3>Saxofone Alto em E♭</h3>
        <div class="botoes">
            <div class="left"><button class="btn-left" onclick="javascript:document.querySelectorAll('.musicas')[3].scrollBy({left:-370, behavior:'smooth'})"></button></div>
            <div class="right"><button class="btn-right" onclick="javascript:document.querySelectorAll('.musicas')[3].scrollBy({left:370, behavior:'smooth'})"></button></div>
        </div>
        <section class="musicas carroselLeft">
        <?php
        if ($resSaxAlto) {
            foreach ($resSaxAlto['musicas'] as $linha) {
                echo "
                <a href=\"templates/partitura/index.php?id=".$linha['id']." \">
                    <div class=\"card\">
                        <img src=\"".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
                        <p>".$linha['nome']."</p>
                        <p>".$resSaxAlto['instrumento']."</p>
                    </div>
                </a>
                ";
            }
        }
        ?>
        </section>
        <h3>Saxofone Tenor em B♭</h3>
        <div class="botoes">
            <div class="left"><button class="btn-left" onclick="javascript:document.querySelectorAll('.musicas')[4].scrollBy({left:-370, behavior:'smooth'})"></button></div>
            <div class="right"><button class="btn-right" onclick="javascript:document.querySelectorAll('.musicas')[4].scrollBy({left:370, behavior:'smooth'})"></button></div>
        </div>
        <section class="musicas carroselRight">
        <?php
        if ($resSaxTenor) {
            foreach ($resSaxTenor['musicas'] as $linha) {
                echo "
                <a href=\"templates/partitura/index.php?id=".$linha['id']." \">
                    <div class=\"card\">
                        <img src=\"".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
                        <p>".$linha['nome']."</p>
                        <p>".$resSaxTenor['instrumento']."</p>
                    </div>
                </a>
                ";
            }
        }
        ?>
        </section>
        <h3>Trombone em C</h3>
        <div class="botoes">
            <div class="left"><button class="btn-left" onclick="javascript:document.querySelectorAll('.musicas')[5].scrollBy({left:-370, behavior:'smooth'})"></button></div>
            <div class="right"><button class="btn-right" onclick="javascript:document.querySelectorAll('.musicas')[5].scrollBy({left:370, behavior:'smooth'})"></button></div>
        </div>
        <section class="musicas carroselLeft">
        <?php
        if ($resTrombone) {
            foreach ($resTrombone['musicas'] as $linha) {
                echo "
                <a href=\"templates/partitura/index.php?id=".$linha['id']." \">
                    <div class=\"card\">
                        <img src=\"".$linha['path_png']."\" alt=\"Partitura\" loading=\"lazy\">
                        <p>".$linha['nome']."</p>
                        <p>".$resTrombone['instrumento']."</p>
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