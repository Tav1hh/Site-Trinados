<?php 
include '../../scripts/conexao.php';

// Pegando as Músicas
if (isset($_POST['psq'])) {
    $psq = $_POST['psq'];

    $sql = "SELECT * FROM música where nome Like '%$psq%' or id Like '%$psq%' or instrumento Like '%$psq%' limit 10";
    $resMusica = mysqli_query($conn, $sql);
} else {
    $sql = "SELECT * FROM música";
    $resMusica = mysqli_query($conn, $sql);
}

// Pegando os Autores
if (isset($_POST['psq1'])) {
    $psq = $_POST['psq1'];
    
    $sql = "SELECT * FROM author where nome Like '%$psq%' or id Like '%$psq%' limit 10";
    $resAutor = mysqli_query($conn, $sql);
} else {    
    $sql = "SELECT * FROM author";
    $resAutor = mysqli_query($conn, $sql);
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
        <a href="../Partitura/criarMusica.php">Nova Partitura</a>
        <a href="">Sair</a>
    </nav>
    <header>
        <button onclick="togglebar()"></button>
        <h1>Dashboard</h1>
    </header>
    <section>
        <h2>Músicas</h2>
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
                    echo "<td class='btn-func'>Edit</td>";
                    echo "<td class='btn-func'>Del</td>";
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
                    echo "<td class='btn-func'>Edit</td>";
                    echo "<td class='btn-func'>Del</td>";
                    echo "</td>";
                }
                ?>
            </tbody>

        </table>
        </section>
    <script>
        function togglebar() {
            const sidebar = document.getElementById('sidebar')
            sidebar.classList.toggle('activate');
        }
    </script>
</body>
</html>