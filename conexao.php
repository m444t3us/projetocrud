<?php
//atributos da conexao

$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'my_filmes';

//criar conexao

try {
    $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $error){   
    echo "Erro na conexao: " . $error->getMessage();
}

?>