<?php
include "conexao.php";
$id = $_GET['id'];
$sql = "DELETE FROM jogadores WHERE id=$id";
if($conn->query($sql)){
    header("Location: listarjogadores.php");
} else {
    echo "Erro: " . $conn->error;
}
?>