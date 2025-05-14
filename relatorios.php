<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$sql = "SELECT * FROM relatorio";
$resultado = $conn->query($sql);
?>
<main>
<div class="container">
<h1>Lista de Relatórios</h1>
<a href="./salvar-relatorio.php" class="btn btn-add">Incluir</a>
<table>
<thead>
<tr>
<th>ID</th>
<th>Título</th>
<th>Data</th>
<th>Responsável</th>
<th>Ações</th>
</tr>
</thead>
<tbody>
<?php
while ($dado = $resultado->fetch_assoc()){
?>
<tr>
<td><?php echo $dado['RelatorioID']; ?></td>
<td><?php echo $dado['Titulo']; ?></td>
<td><?php echo $dado['Data']; ?></td>
<td><?php echo $dado['Responsavel']; ?></td>
<td>
<a href="editar-relatorio.php?id=<?php echo $dado['RelatorioID']; ?>" class="btn btn-edit">Editar</a>
<a href="excluir-relatorio.php?id=<?php echo $dado['RelatorioID']; ?>" class="btn btn-delete">Excluir</a>
</td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
</main>

<?php
include_once './include/footer.php';
?>
