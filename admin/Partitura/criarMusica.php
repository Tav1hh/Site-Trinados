<?php 
include '../../scripts/conexao.php';

// Pega os dados do DB
$sql = "SELECT * from genero";
$resGen = mysqli_query($conn,$sql);

$sql = "SELECT * from author";
$resAuthor = mysqli_query($conn,$sql);

$sql = "SELECT * from instrumento";
$resinstrumento = mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Author</title>
    <link rel="stylesheet" href="enviar.css">
</head>
<body>
    <nav id="sidebar">
        <button onclick="togglebar()"></button>
        <h2>Painel</h2>
        <a href="index.php">Dashboard</a>
        <a href="../Partitura/criarMusica.php">Cadastrar Partitura</a>
        <a href="../Cadastro/cadastrar.html">Cadastrar Adm</a>
        <a href="../../">Home</a>
        <a href="../deslogar.php">Logout</a>
    </nav>
    <section class="menu">
        <button onclick="togglebar()"></button>
        <a href="criarGenero.html">Genero</a>
        <a href="criarAuthor.html">Author</a>
        <a href="criarMusica.php">Música</a>
    </section>
    <header>
        <h1>Envie uma Música</h1>
    </header>
    <main>
            <form action="musica.php" method="post" enctype="multipart/form-data">
                <section class="classificacoes">
                    <div>
                        <label for="inome_musica">Nome:</label>
                        <input type="text" name="nome_musica" id="inomemusica" placeholder="Nome da Música">
                    </div>
                    <div>
                        <label for="Iauthor">Author:</label>
                        <select name="author" id="Iauthor">
                        <?php 
                            while ($linha = mysqli_fetch_array($resAuthor)) {
                                echo "<option value='".$linha['id']."'>".$linha['nome']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div>
                        <label for="Igen">Genero:</label>
                        <select name="gen" id="Igen">
                            <?php 
                            while ($linha = mysqli_fetch_array($resGen)) {
                                echo "<option value='".$linha['id']."'>".$linha['nome']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="instrumento">Instrumento:</label>
                        <select name="instrumento" id="Instrumento">
                            <?php 
                               while ($linha = mysqli_fetch_array($resinstrumento)) {
                                echo "<option value='".$linha['id']."'>".$linha['nome']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div>
                        <label for="iframe">Iframe:</label>
                        <input type="text" name="iframe" id="iframe" placeholder="Video para incorporar">
                    </div>
                </section>

                <section class="arquivos">
                    <div>
                        <label for="ipart2" id="ilabel2" onclick="addEventListener('change',selecionou('ipart2','ilabel2'))">Capa - PNG</label>
                        <input type="file" name="part2" id="ipart2">
                    </div>

                    <div>
                        <label for="ipart1" id="ilabel1" onclick="addEventListener('change',selecionou('ipart1','ilabel1'))">Partitura - PDF</label>
                        <input type="file" name="part1" id="ipart1">
                    </div>


                    <div>
                        <label for="ipart3" id="ilabel3" onclick="addEventListener('change',selecionou('ipart3','ilabel3'))">Partitura - MSC</label>
                        <input type="file" name="part3" id="ipart3">
                    </div>
                </section>

                <div class="btns">
                    <input type="submit">
                </div>

            </form>

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