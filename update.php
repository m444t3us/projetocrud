<?php include_once 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>atualizar</title>
</head>
<body>
        <h1> home > atualização </h1>
    <form action="processaUpdate..php" method="post">
        <label for="id">Selecione o filme a ser atualizado:</label><br>
        <select name="id" id="id" required>
            <?php foreach($conexao->query("SELECT id, nome, diretor, ano_lancamento, duracao FROM filmes") as $filme): ?>
                <option value="<?php echo $filme['id']; ?>">
                    <?php echo $filme['id'] . "  || nome:" . $filme['nome'] . " || diretor:" . $filme['diretor'] . " || lançamento:" . $filme['ano_lancamento'] . " || duração" . $filme['duracao']; ?>
                </option>
            <?php 
        endforeach; ?>
        </select>
        <br><br>
        <label for="nome">Novo nome do filme:</label><br>
        <input type="text" id="nome" name="nome" ><br>
        <label for="diretor">Novo diretor do filme:</label><br>
        <input type="text" id="diretor" name="diretor" ><br>
        <label for="ano_lancamento">Nova data de lançamento (aaaa-mm-dd):</label><br>
        <input type="text" id="ano_lancamento" name="ano_lancamento" ><br>
        <label for="duracao">Nova duração (minutos):</label><br>
        <input type="number" id="duracao" name="duracao" ><br><br>
        <button type="submit">Atualizar Filme</button>

    </form>
    <button type="button" onclick="location.href='index.php'">Voltar</button>
        

</body>
</html>