<?php

include_once 'conexao.php';


// verifica se é metodo post
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //verifica a existencia dos campos
    if(isset($_POST['nome']) && isset($_POST['diretor']) && isset($_POST['ano_lancamento']) && isset($_POST['duracao'])){
        //verifica se os campos estão vazios, se está vai dar msg de erro
        if(empty($_POST['nome']) || empty($_POST['diretor']) || empty($_POST['ano_lancamento']) || empty($_POST['duracao'])){
            $mensagem = "Por favor, preencha todos os campos.";
            header("Location: cadastro.php?mensagem=" . urlencode($mensagem));
        } else {
            //atribuindo valores
            $nome = $_POST['nome'];
            $diretor = $_POST['diretor'];
            $ano_lancamento = $_POST['ano_lancamento'];
            $duracao = $_POST['duracao'];

            try { 
                //preparando a instrução sql para ser executada em sequencia
                $sql = "INSERT INTO filmes (nome, diretor, ano_lancamento, duracao) VALUES (:nome, :diretor, :ano_lancamento, :duracao)";
                $stm = $conexao->prepare(query: $sql);
                //o stm vai ligar os parametros com os valores
                $stm->bindParam(':nome', $nome);
                $stm->bindParam(':diretor', $diretor);
                $stm->bindParam(':ano_lancamento', $ano_lancamento);
                $stm->bindParam(':duracao', $duracao);
                
                //somente aqui vai executar de verdade
                $stm->execute();
                $mensagem = "Filme cadastrado com sucesso!";
                header("Location: cadastro.php?mensagem=" . urlencode($mensagem));
            } catch (PDOException $error){
                $mensagem = "Erro ao cadastrar o filme: " . $error->getMessage();
                header("Location: cadastro.php?mensagem=" . urlencode($mensagem));
         }   
    } 
}
}

?>