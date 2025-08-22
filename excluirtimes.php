<?php
include "conexao.php";
$id = $_GET['id'];

$sql = "SELECT * FROM jogadores WHERE time_id=$id";
$res = $conn->query($sql);
if($res->num_rows > 0){
    echo "Não é possível excluir este time, há jogadores vinculados.";
} else {
    $sql = "DELETE FROM times WHERE id=$id";
    if($conn->query($sql)){
        header("Location: listartimes.php");
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>