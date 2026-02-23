<?php include_once 'conexao.php'; 

 try {
        $sql = "SELECT * FROM filmes";
        $stm = $conexao->prepare(query: $sql);
        $stm->execute();
        //fetchall acontece aqui pra pegar TUDO dentro da tabela filmes
        $filmes = $stm->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $error){
        echo "Erro ao listar os filmes: " . $error->getMessage(); 
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>excluir</title>
</head>
<body>
    <h1> Excluir Filme </h1>
    <form action="processaExclusao.php" method="post">
        <label for="nome">Selecione o filme a ser excluído:</label><br>
        <select name="id" id="id" required>
            <?php 
            $contador = 1;
                foreach($filmes as $filme): ?>
                <option value="<?php echo $filme['id']; ?>">
                    <?php echo "[[ " . $contador . " ]] " . $filme['nome']; ?>
                </option>
            <?php 
            $contador++;
        endforeach; ?>
        </select>
        <br><br>
        <button type="submit">Excluir Filme</button>
    </form> 
    <button type="button" onclick="location.href='index.php'">Voltar</button>
    <?php 

    if(isset($_GET['mensagem'])){
        echo"<p>" . $_GET['mensagem'] . "<p>";
    }
    ?>
</body>
</html>