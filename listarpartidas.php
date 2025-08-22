<?php
include "conexao.php";

$itens_pagina = 10;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina - 1) * $itens_pagina;
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';

$sql = "SELECT p.*, t1.nome as mandante, t2.nome as visitante
        FROM partidas p
        LEFT JOIN times t1 ON p.time_casa_id = t1.id
        LEFT JOIN times t2 ON p.time_fora_id = t2.id
        WHERE t1.nome LIKE '%$filtro%' OR t2.nome LIKE '%$filtro%'
        LIMIT $inicio, $itens_pagina";
$resultado = $conn->query($sql);
?>

<h1>Partidas</h1>
<form method="GET">
<input type="text" name="filtro" placeholder="Filtrar por time" value="<?php echo $filtro; ?>">
<button type="submit">Filtrar</button>
</form>
<a href="adicionarpartidas.php">Adicionar Partida</a>
<table border="1">
<tr><th>ID</th><th>Mandante</th><th>Visitante</th><th>Data</th><th>Placar</th><th>Ações</th></tr>
<?php while($linha = $resultado->fetch_assoc()){ ?>
<tr>
<td><?php echo $linha['id']; ?></td>
<td><?php echo $linha['mandante']; ?></td>
<td><?php echo $linha['visitante']; ?></td>
<td><?php echo $linha['data_jogo']; ?></td>
<td><?php echo $linha['gols_casa']." x ".$linha['gols_fora']; ?></td>
<td>
<a href="editarpartidas.php?id=<?php echo $linha['id']; ?>">Editar</a>
<a href="excluirpartidas.php?id=<?php echo $linha['id']; ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
</td>
</tr>
<?php } ?>
</table>