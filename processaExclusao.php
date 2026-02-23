<?php
include_once 'conexao.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];

        $sql = "DELETE FROM filmes WHERE id = :id";
        $stm = $conexao->prepare($sql);
        $stm->bindParam(':id', $id);

        $sucesso = $stm->execute();

        if ($sucesso === true) {
            header("Location: exclusao.php?mensagem=Filme excluído com sucesso.");
            exit();
        } else {
            header("Location: exclusao.php?mensagem=Erro ao excluir o filme.");
            exit();
        }
       

    } else {
        header("Location: exclusao.php?mensagem=Método inválido.");
        exit();
    }
} catch (PDOException $error) {
    echo "Erro ao processar exclusão: " . $error->getMessage();
    exit();
}
?>