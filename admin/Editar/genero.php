<?php 
$nome = $_GET['nome'];
$id = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Genero</title>
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
        <h1>Editar Genero</h1>
    </header>
    <main>
        <form action="Edit/editar-genero.php?id=<?=$id?>" method="post">
            <section class="classificacoes">
                <div>
                    <label for="igen">Nome:</label>
                    <input type="text" name="nome" id="igen" placeholder="Nome do Genero" value="<?=$nome?>">
                </div>
                <p>Muito Cuidado ao editar as informações</p>

            </section>
            <div class="btns">
                <input type="button" value="Voltar" onclick="javascript:location.href='../Painel'">
                <input type="button" value="Excluir" class="btn-excluir" onclick='javascript:location.href="Edit/excluir.php?id=<?=$id?>&func=1"'>
                <input type="submit" value="Confirmar">
            </div>
        </form>
    </main>
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