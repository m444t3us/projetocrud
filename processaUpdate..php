<?php 
include_once 'conexao.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        header("Location: update.php?mensagem=" . urlencode("ID do filme não fornecido."));
        exit();
    }
    
    $id = $_POST['id'];

    try {
        // 1. BUSCAR O REGISTRO ATUAL DO BANCO DE DADOS
        $sql_select = "SELECT nome, diretor, ano_lancamento, duracao FROM filmes WHERE id = :id";
        $stm_select = $conexao->prepare($sql_select);
        $stm_select->bindParam(':id', $id, PDO::PARAM_INT);
        $stm_select->execute();
        $filme_atual = $stm_select->fetch(PDO::FETCH_ASSOC);

        if (!$filme_atual) {
            header("Location: update.php?mensagem=" . urlencode("Filme não encontrado."));
            exit();
        }

        // 2. APLICAR A LÓGICA IF/ELSE PARA CADA CAMPO
        
        // Campo 'nome'
        if (isset($_POST['nome']) && !empty(trim($_POST['nome']))) {
            $novo_nome = trim($_POST['nome']);
        } else {
            // Se o campo do formulário estiver vazio, use o valor atual do banco
            $novo_nome = $filme_atual['nome'];
        }

        // Campo 'diretor'
        if (isset($_POST['diretor']) && !empty(trim($_POST['diretor']))) {
            $novo_diretor = trim($_POST['diretor']);
        } else {
            $novo_diretor = $filme_atual['diretor'];
        }
        
        // Campo 'ano_lancamento'
        if (isset($_POST['ano_lancamento']) && !empty(trim($_POST['ano_lancamento']))) {
            $novo_ano_lancamento = trim($_POST['ano_lancamento']);
        } else {
            $novo_ano_lancamento = $filme_atual['ano_lancamento'];
        }

        // Campo 'duracao'
        if (isset($_POST['duracao']) && !empty(trim($_POST['duracao']))) {
            $nova_duracao = trim($_POST['duracao']);
        } else {
            $nova_duracao = $filme_atual['duracao'];
        }


        // 3. EXECUTAR O UPDATE COMPLETO COM OS VALORES DETERMINADOS
        $sql_update = "UPDATE filmes SET 
                nome = :nome,
                diretor = :diretor,
                ano_lancamento = :ano_lancamento,
                duracao = :duracao
                WHERE id = :id";

        $stm_update = $conexao->prepare($sql_update);
        
        // Faz o bind dos valores (novos ou antigos)
        $stm_update->bindParam(':nome', $novo_nome);
        $stm_update->bindParam(':diretor', $novo_diretor);
        $stm_update->bindParam(':ano_lancamento', $novo_ano_lancamento);
        // Usamos PDO::PARAM_INT para a duração e o id
        $stm_update->bindParam(':duracao', $nova_duracao, PDO::PARAM_INT);
        $stm_update->bindParam(':id', $id, PDO::PARAM_INT);
        
        $stm_update->execute();
        
        $mensagem = "Filme atualizado com sucesso!";
        header("Location: update.php?mensagem=" . urlencode($mensagem));
        exit();
        
    } catch (PDOException $error) {
        $mensagem = "Erro ao atualizar o filme: " . $error->getMessage();
        header("Location: update.php?mensagem=" . urlencode($mensagem));
        exit();
    }
} else {
    header("Location: update.php?mensagem=" . urlencode("Método de requisição inválido."));
    exit();
}
?>