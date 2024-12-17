<?php 
include '../../scripts/conexao.php';

//Testa se está logado
if (isset($_SESSION['id']) & isset($_SESSION['nome'])) {
    $id = $_SESSION['id'];
    $nome = $_SESSION['nome'];

    // Verificando no Banco de Dados
    $sql = "SELECT * FROM admin where id = '$id' and nome = '$nome'";
    $res = mysqli_query($conn,$sql);

    $usuario = mysqli_fetch_array($res);
    if ($usuario == null) {
        session_unset();
        session_destroy();
        header('Location: ../../x039.php');
    }
} else { 
    session_unset();
    session_destroy();
    header('Location: ../../x039.php');
}
// Pegando o Total de Partituras:
$sql = "Select nome from musica";
$res = mysqli_query($conn,$sql);
$totalPartituras = mysqli_num_rows($res);
// Pegando as Músicas
if (isset($_POST['psq'])) {
    $psq = $_POST['psq'];

    $sql = "SELECT musica.id, musica.nome, instrumento.nome As instrumento, genero.nome As genero from musica join instrumento on instrumento.id = musica.IdInstrumento join genero on genero.id = musica.genero_fid where musica.nome Like '%$psq%' or musica.id Like '%$psq%' or instrumento.nome Like '%$psq%' or genero.nome Like '%$psq%' limit 10";
    $resMusica = mysqli_query($conn, $sql);
} else {
    $sql = "SELECT musica.id, musica.nome, instrumento.nome As instrumento from musica join instrumento on instrumento.id = musica.IdInstrumento order by -upload_time limit 10 ";
    $resMusica = mysqli_query($conn, $sql);
}

// Pegando os Autores
if (isset($_POST['psq1'])) {
    $psq = $_POST['psq1'];
    
    $sql = "SELECT * FROM autor where nome Like '%$psq%' or id Like '%$psq%' limit 10";
    $resAutor = mysqli_query($conn, $sql);
} else {    
    $sql = "SELECT * FROM autor limit 10";
    $resAutor = mysqli_query($conn, $sql);
}

// Pegando os Generos
if (isset($_POST['psq2'])) {
    $psq = $_POST['psq2'];
    
    $sql = "SELECT * FROM genero where nome Like '%$psq%' or id Like '%$psq%' limit 10";
    $resGenero = mysqli_query($conn, $sql);
} else {    
    $sql = "SELECT * FROM genero limit 10";
    $resGenero = mysqli_query($conn, $sql);
}

// Pegando os Admins
if (isset($_POST['psq3'])) {
    $psq = $_POST['psq3'];
    
    $sql = "SELECT * FROM admin where nome Like '%$psq%' or id Like '%$psq%' limit 10";
    $resAdm = mysqli_query($conn, $sql);
} else {    
    $sql = "SELECT * FROM admin limit 10";
    $resAdm = mysqli_query($conn, $sql);
}

// Pegando os Generos
if (isset($_POST['psq4'])) {
    $psq = $_POST['psq4'];
    
    $sql = "SELECT * FROM instrumento where nome Like '%$psq%' or id Like '%$psq%' limit 10";
    $resInstrumento = mysqli_query($conn, $sql);
} else {    
    $sql = "SELECT * FROM instrumento";
    $resInstrumento = mysqli_query($conn, $sql);
}



?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav id="sidebar">
        <button onclick="togglebar()"></button>
        <h2>Painel</h2>
        <a href="index.php">Dashboard</a>
        <a href="../Partitura/criarMusica.php">Cadastrar Partitura</a>
        <a href="../Cadastro/cadastrar.php">Cadastrar Adm</a>
        <a href="../../">Home</a>
        <a href="../deslogar.php">Logout</a>
    </nav>
    <header>
        <button onclick="togglebar()"></button>
        <h1>Dashboard</h1>
    </header>
    <section>
        <div class="musicas">
            <h2><?=$totalPartituras/6?> Músicas</h2>
            <h2><?=$totalPartituras?> Partituras </h2>
        </div>
        <form action="#" method="post">
            <input type="search" name="psq" placeholder="Pesquise uma Música">
            <button type="submit"></button>
        </form>
        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Instrumento</th>
                    <th colspan="2">Função</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while ($linha = mysqli_fetch_array($resMusica)) {
                    echo "<tr>";
                    echo "<td>".$linha['id']."</td>";
                    echo "<td>".$linha['nome']."</td>";
                    echo "<td>".$linha['instrumento']."</td>";
                    echo "<td class='btn-func' onclick=\"javascript:location.href='../Editar/musica.php?id=".$linha['id']."  '\">Edit</td>";
                    echo "</td>";
                }
                ?>
            </tbody>

        </table>
        </section>
    <section>
        <h2>Autores</h2>
        <form action="#" method="post">
            <input type="search" name="psq1" placeholder="Pesquise um Autor">
            <button type="submit"></button>
        </form>
        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th colspan="2">Função</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while ($linha = mysqli_fetch_array($resAutor)) {
                    echo "<tr>";
                    echo "<td>".$linha['id']."</td>";
                    echo "<td>".$linha['nome']."</td>";
                    echo "<td class='btn-func' onclick=\"javascript:location.href='../Editar/autor.php?id=".$linha['id']."  '\">Edit</td>";
                    echo "</td>";
                }
                ?>
            </tbody>

        </table>
        </section>
    <section>
        <h2>Generos</h2>
        <form action="#" method="post">
            <input type="search" name="psq2" placeholder="Pesquise um Genero">
            <button type="submit"></button>
        </form>
        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th colspan="2">Função</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while ($linha = mysqli_fetch_array($resGenero)) {
                    echo "<tr>";
                    echo "<td>".$linha['id']."</td>";
                    echo "<td>".$linha['nome']."</td>";
                    echo "<td class='btn-func' onclick=\"javascript:location.href='../Editar/genero.php?nome=".$linha['nome']."&id=".$linha['id']."  '\">Edit</td>";
                    echo "</td>";
                }
                ?>
            </tbody>

        </table>
        </section>
        <section>
        <h2>Instrumentos</h2>
        <form action="#" method="post">
            <input type="search" name="psq2" placeholder="Pesquise um Instrumento">
            <button type="submit"></button>
        </form>
        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th colspan="2">Função</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while ($linha = mysqli_fetch_array($resInstrumento)) {
                    echo "<tr>";
                    echo "<td>".$linha['id']."</td>";
                    echo "<td>".$linha['nome']."</td>";
                    echo "<td class='btn-func' onclick=\"javascript:location.href='../Editar/instrumento.php?nome=".$linha['nome']."&id=".$linha['id']."  '\">Edit</td>";
                    echo "</td>";
                }
                ?>
            </tbody>

        </table>
        </section>
    <section>
        <h2>Administradores</h2>
        <form action="#" method="post">
            <input type="search" name="psq3" placeholder="Pesquise um Adm">
            <button type="submit"></button>
        </form>
        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th colspan="2">Função</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while ($linha = mysqli_fetch_array($resAdm)) {
                    echo "<tr>";
                    echo "<td>".$linha['id']."</td>";
                    echo "<td>".$linha['nome']."</td>";
                    echo "<td class='btn-func' onclick=\"javascript:location.href='../Editar/adm.php?nome=".$linha['nome']."&id=".$linha['id']."  '\">Edit</td>";
                    echo "</td>";
                }
                ?>
            </tbody>

        </table>
        </section>
        <footer>
            <p>Site Criado por &copy;<strong><a href="https://tav1hh.github.io/Site-PortfolioV2" target="_blank">Santiago</a></strong></p>
        </footer>
    <script>
        function togglebar() {
            const sidebar = document.getElementById('sidebar')
            sidebar.classList.toggle('activate');
        }
    </script>
</body>
</html>