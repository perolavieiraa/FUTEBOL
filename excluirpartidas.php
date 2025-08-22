<?php
include "conexao.php";
$id = $_GET['id'];
$sql = "DELETE FROM partidas WHERE id=$id";
if($conn->query($sql)){
    header("Location: listarpartidas.php");
} else {
    echo "Erro: " . $conn->error;
}
?>