<?php 
include '../../scripts/conexao.php';
$id = $_GET['id'];

$sql = "SELECT * FROM autor where id=". $id;
$res = mysqli_query($conn,$sql);
$linha = mysqli_fetch_array($res);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Autor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav id="sidebar">
        <button onclick="togglebar()"></button>
        <h2>Painel</h2>
        <a href="../Painel/index.php">Dashboard</a>
        <a href="../Partitura/criarMusica.php">Cadastrar Partitura</a>
        <a href="../Cadastro/cadastrar.php">Cadastrar Adm</a>
        <a href="../../">Home</a>
        <a href="../deslogar.php">Logout</a>
    </nav>
    <header>
        <button onclick="togglebar()"></button>
        <h1>Editar Autor</h1>
    </header>
    <main>
        <form action="Edit/editar-autor.php?id=<?=$id?>" method="post" enctype="multipart/form-data">
            <section class="classificacoes">
                <div>
                    <label for="inome_autor">Nome:</label>
                    <input type="text" name="nome_autor" id="inome_autor" placeholder="Nome do autor" value="<?=$linha['nome']?>">
                </div>
            </section>
            <section class="arquivos">
                <div>
                    <label for="ipart1" id="ilabel1" onclick = 'addEventListener("change", selecionou("ipart1","ilabel1"))'>Foto 1:1 - PNG</label>
                    <input type="file" name="part" id="ipart1">
                </div>
            </section>
            <p>Muito Cuidado ao editar as informações</p>
            <div class="btns">
                <input type="button" value="Excluir" class="btn-excluir" onclick="javascript:location.href='../Painel/index.php'">
                <input type="submit" value="Confirmar">
            </div>
        </form>
    </main>
    <footer>
        <p>Site Criado por &copy;<strong><a href="https://tav1hh.github.io/Site-PortfolioV2" target="_blank">Santiago</a></strong></p>
    </footer>
    <script>
        function selecionou(ipart,ilabel) {

            const fileInput = document.getElementById(ipart);
            const fileLabel = document.getElementById(ilabel);

            fileInput.addEventListener('change', () => {
                if (fileInput.files.length > 0) {
                    fileLabel.style.backgroundColor = 'green';
                    fileLabel.textContent = `Arquivo selecionado: ${fileInput.files[0].name}`;
                } else {
                    fileLabel.style.backgroundColor = '#333';
                    fileLabel.textContent = 'Escolher arquivo';
                }
            })
            }
        function togglebar() {
            const sidebar = document.getElementById('sidebar')
            sidebar.classList.toggle('activate');
        }
    </script>
</body>
</html>