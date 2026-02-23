<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>listagem</title>
</head>
<body>
    <h1> home > listagem</h1>

    <?php

    //chama a conexão que foi estabelecida em conexao.php
    include_once 'conexao.php';

    try {
        //mesma ideia do processacadastro onde primeiro tu chama oq quer fazer, 
        //prepara o campo para ser executado e chama o execute pra fazer oq foi pedido
        $sql = "SELECT * FROM filmes";
        $stm = $conexao->prepare(query: $sql);
        $stm->execute();
        //fetchall acontece aqui pra pegar TUDO dentro da tabela filmes
        $filmes = $stm->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $error){
        echo "Erro ao listar os filmes: " . $error->getMessage();
    }

    echo '<h2>Lista de Filmes Cadastrados</h2>';
    $contador = 1;
    if($filmes && count($filmes) > 0){
        foreach($filmes as $filme){
            echo '<p>'  .$contador . ' - ' . $filme['nome'] . ' | Diretor: ' . $filme['diretor'] . ' | Ano de Lançamento: ' . $filme['ano_lancamento'] . ' | Duração: ' . $filme['duracao'] . ' minutos</p>';
            $contador++;
        }
    } else { // <-- Correct position for the 'else' block.
        echo '<p>Nenhum filme cadastrado.</p>';
    }
    ?>
    <a href="index.php">
        <button type="button">Voltar para Home</button>
    </a>
</body>
</html>