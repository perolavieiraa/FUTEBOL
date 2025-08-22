<?php
include "conexao.php";
$times = $conn->query("SELECT * FROM times");

if(isset($_POST['salvar'])){
    $mandante = $_POST['mandante'];
    $visitante = $_POST['visitante'];
    $data = $_POST['data'];
    $gols_casa = $_POST['gols_casa'];
    $gols_fora = $_POST['gols_fora'];

    if($mandante == $visitante){
        echo "Mandante e visitante não podem ser iguais!";
    } else {
        $sql = "INSERT INTO partidas (time_casa_id,time_fora_id,data_jogo,gols_casa,gols_fora) 
                VALUES ($mandante,$visitante,'$data',$gols_casa,$gols_fora)";
        if($conn->query($sql)){
            header("Location: listarpartidas.php");
        } else {
            echo "Erro: " . $conn->error;
        }
    }
}
?>

<h1>Adicionar Partida</h1>
<form method="POST">
Mandante: <select name="mandante"><?php while($t=$times->fetch_assoc()){ echo "<option value='{$t['id']}'>{$t['nome']}</option>"; } ?></select><br>
Visitante: <select name="visitante"><?php $times2 = $conn->query("SELECT * FROM times"); while($t=$times2->fetch_assoc()){ echo "<option value='{$t['id']}'>{$t['nome']}</option>"; } ?></select><br>
Data: <input type="date" name="data"><br>
Gols Casa: <input type="number" name="gols_casa" min="0"><br>
Gols Fora: <input type="number" name="gols_fora" min="0"><br>
<button type="submit" name="salvar">Salvar</button>
</form>
<a href="listarpartidas.php">Voltar</a>