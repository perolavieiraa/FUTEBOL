<?php
include "conexao.php";
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM partidas WHERE id=$id");
$partida = $res->fetch_assoc();
$times = $conn->query("SELECT * FROM times");

if(isset($_POST['salvar'])){
    $mandante = $_POST['mandante'];
    $visitante = $_POST['visitante'];
    $data = $_POST['data'];
    $gols_casa = $_POST['gols_casa'];
    $gols_fora = $_POST['gols_fora'];

    if($mandante==$visitante){
        echo "Mandante e visitante não podem ser iguais!";
    } else {
        $sql = "UPDATE partidas SET time_casa_id=$mandante,time_fora_id=$visitante,data_jogo='$data',gols_casa=$gols_casa,gols_fora=$gols_fora WHERE id=$id";
        if($conn->query($sql)){
            header("Location: listarpartidas.php");
        } else {
            echo "Erro: ".$conn->error;
        }
    }
}
?>

<h1>Editar Partida</h1>
<form method="POST">
Mandante: <select name="mandante"><?php 
while($t=$times->fetch_assoc()){ 
$sel = ($partida['time_casa_id']==$t['id'])?"selected":""; 
echo "<option value='{$t['id']}' $sel>{$t['nome']}</option>"; 
} ?></select><br>
Visitante: <select name="visitante"><?php 
$times2=$conn->query("SELECT * FROM times"); 
while($t=$times2->fetch_assoc()){ 
$sel = ($partida['time_fora_id']==$t['id'])?"selected":""; 
echo "<option value='{$t['id']}' $sel>{$t['nome']}</option>"; 
} ?></select><br>
Data: <input type="date" name="data" value="<?php echo $partida['data_jogo']; ?>"><br>
Gols Casa: <input type="number" name="gols_casa" min="0" value="<?php echo $partida['gols_casa']; ?>"><br>
Gols Fora: <input type="number" name="gols_fora" min="0" value="<?php echo $partida['gols_fora']; ?>"><br>
<button type="submit" name="salvar">Salvar</button>
</form>
<a href="listarpartidas.php">Voltar</a>