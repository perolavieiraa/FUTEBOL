<?php
include "conexao.php";

if(isset($_POST['salvar'])){
    $nome = $_POST['nome'];
    $cidade = $_POST['cidade'];

    if($nome == "" || $cidade == ""){
        echo "Preencha todos os campos!";
    } else {
        $sql = "INSERT INTO times (nome, cidade) VALUES ('$nome', '$cidade')";
        if($conn->query($sql)){
            header("Location: listartimes.php");
        } else {
            echo "Erro: " . $conn->error;
        }
    }
}
?>

<h1>Adicionar Time</h1>
<form method="POST">
Nome: <input type="text" name="nome"><br>
Cidade: <input type="text" name="cidade"><br>
<button type="submit" name="salvar">Salvar</button>
</form>
<a href="listartimes.php">Voltar</a>