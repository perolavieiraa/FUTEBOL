<?php
include "conexao.php";

$itens_pagina = 10;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina - 1) * $itens_pagina;
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';

$sql = "SELECT jogadores.*, times.nome as time_nome 
        FROM jogadores 
        LEFT JOIN times ON jogadores.time_id = times.id
        WHERE jogadores.nome LIKE '%$filtro%' 
        LIMIT $inicio, $itens_pagina";
$resultado = $conn->query($sql);
?>

<h1>Jogadores</h1>
<form method="GET">
<input type="text" name="filtro" placeholder="Buscar por nome" value="<?php echo $filtro; ?>">
<button type="submit">Filtrar</button>
</form>
<a href="adicionarjogadores.php">Adicionar Jogador</a>
<table border="1">
<tr><th>ID</th><th>Nome</th><th>Posição</th><th>Nº Camisa</th><th>Time</th><th>Ações</th></tr>
<?php while($linha = $resultado->fetch_assoc()) { ?>
<tr>
<td><?php echo $linha['id']; ?></td>
<td><?php echo $linha['nome']; ?></td>
<td><?php echo $linha['posicao']; ?></td>
<td><?php echo $linha['numero_camisa']; ?></td>
<td><?php echo $linha['time_nome']; ?></td>
<td>
<a href="editarjogadores.php?id=<?php echo $linha['id']; ?>">Editar</a>
<a href="excluirjogadores.php?id=<?php echo $linha['id']; ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
</td>
</tr>
<?php } ?>
</table>