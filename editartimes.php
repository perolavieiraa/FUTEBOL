<?php
include "conexao.php";
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM times WHERE id = $id");
$time = $res->fetch_assoc();

if(isset($_POST['salvar'])){
    $nome = $_POST['nome'];
    $cidade = $_POST['cidade'];

    if($nome == "" || $cidade == ""){
        echo "Preencha todos os campos!";
    } else {
        $sql = "UPDATE times SET nome='$nome', cidade='$cidade' WHERE id=$id";
        if($conn->query($sql)){
            header("Location: listartimes.php");
        } else {
            echo "Erro: " . $conn->error;
        }
    }
}
?>

<h1>Editar Time</h1>
<form method="POST">
Nome: <input type="text" name="nome" value="<?php echo $time['nome']; ?>"><br>
Cidade: <input type="text" name="cidade" value="<?php echo $time['cidade']; ?>"><br>
<button type="submit" name="salvar">Salvar</button>
</form>
<a href="listartimes.php">Voltar</a>