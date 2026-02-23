<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>cadastro</title>
</head>
<body>
    <h1> home > cadastro</h1>
    <form action="processaCadastro.php" method="POST">
        <label for="nome">Nome</label>
        <br>
        <input type="text" id="nome" name="nome" required>
        <br>
        <label for="diretor">Diretor do Filme</label>
        <br>    
        <input type="text" id="diretor" name="diretor" required>
        <br>
        <label for="ano_lancamento">data lançamento (aaaa-mm-dd)</label>
        <br>
        <input type="text" id="ano_lancamento" name="ano_lancamento" required>
        <br>
        <label for="duracao">Duração (minutos)</label>
        <br>
        <input type="number" id="duracao" name="duracao" required>
        <br>
        <a>Voltar para Home</a> <br> <br>
        <button type="button" onclick="location.href='index.php'">Voltar</button>
        <br> <br>
        <button type="submit">Cadastrar Filme</button>
        
<?php
    if(isset($_GET['mensagem'])){
        echo"<p>" . $_GET['mensagem'] . "<p>";
    }
?>
</form>
</body>
</html>