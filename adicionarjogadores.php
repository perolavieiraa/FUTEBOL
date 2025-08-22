<?php
include "conexao.php";

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
        $sql = "INSERT INTO jogadores (nome,posicao,numero_camisa,time_id) 
                VALUES ('$nome','$posicao',$numero,$time_id)";
        if($conn->query($sql)){
            header("Location: listarjogadores.php");
        } else {
            echo "Erro: " . $conn->error;
        }
    }
}
?>

<h1>Adicionar Jogador</h1>
<form method="POST">
Nome: <input type="text" name="nome"><br>
Posição: <select name="posicao">
<?php foreach($posicoes as $p){ echo "<option>$p</option>"; } ?>
</select><br>
Nº Camisa: <input type="number" name="numero" min="1" max="99"><br>
Time: <select name="time_id">
<?php while($t = $times->fetch_assoc()){ echo "<option value='{$t['id']}'>{$t['nome']}</option>"; } ?>
</select><br>
<button type="submit" name="salvar">Salvar</button>
</form>
<a href="listarjogadores.php">Voltar</a>