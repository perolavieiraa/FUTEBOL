<?php
include "conexao.php";

$id = $_GET['id'];
$res = $conn->query("SELECT * FROM jogadores WHERE id=$id");
$jogador = $res->fetch_assoc();
$posicoes = ['GOL','ZAG','MEI','ATA'];
$times = $conn->query("SELECT * FROM times");

if(isset($_POST['salvar'])){
    $nome = $_POST['nome'];
    $posicao = $_POST['posicao'];
    $numero = $_POST['numero'];
    $time_id = $_POST['time_id'];

    if($nome=="" || !in_array($posicao,$posicoes) || $numero<1 || $numero>99 || $time_id==""){
        echo "Preencha todos os campos corretamente!";
    } else {
        $sql = "UPDATE jogadores SET nome='$nome', posicao='$posicao', numero_camisa=$numero, time_id=$time_id WHERE id=$id";
        if($conn->query($sql)){
            header("Location: listarjogadores.php");
        } else {
            echo "Erro: " . $conn->error;
        }
    }
}
?>

<h1>Editar Jogador</h1>
<form method="POST">
Nome: <input type="text" name="nome" value="<?php echo $jogador['nome']; ?>"><br>
Posição: <select name="posicao">
<?php foreach($posicoes as $p){ $sel = ($jogador['posicao']==$p)?"selected":""; echo "<option $sel>$p</option>"; } ?>
</select><br>
Nº Camisa: <input type="number" name="numero" min="1" max="99" value="<?php echo $jogador['numero_camisa']; ?>"><br>
Time: <select name="time_id">
<?php while($t = $times->fetch_assoc()){ $sel = ($jogador['time_id']==$t['id'])?"selected":""; echo "<option value='{$t['id']}' $sel>{$t['nome']}</option>"; } ?>
</select><br>
<button type="submit" name="salvar">Salvar</button>
</form>
<a href="listarjogadores.php">Voltar</a>