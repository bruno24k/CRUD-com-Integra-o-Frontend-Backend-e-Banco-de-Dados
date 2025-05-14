<?php
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Consulta SQL para listar os setores (nome da tabela corrigido para 'setores')
$sql = "SELECT * FROM setores";
$resultado = $conn->query($sql);

// Verifica se a consulta foi executada com sucesso
if (!$resultado) {
    die("Erro na consulta SQL: " . $conn->error);
}
?>
<main>
<div class="container">
<h1>Lista de Setores</h1>
<a href="./salvar-setores.php" class="btn btn-add">Incluir</a>
<table>
<thead>
<tr>
<th>ID</th>
<th>Nome</th>
<th>Andar</th>
<th>Cor</th>
<th>Ações</th>
</tr>
</thead>
<tbody>
<?php
// Verifica se há resultados na consulta
if ($resultado->num_rows > 0) {
    while ($dado = $resultado->fetch_assoc()) {
        ?>
<tr>
<td><?php echo $dado['SetorID']; ?></td>
<td><?php echo $dado['Nome']; ?></td>
<td><?php echo $dado['Andar']; ?></td>
<td><?php echo $dado['Cor']; ?></td>
<td>
<a href="editar-setor.php?id=<?php echo $dado['SetorID']; ?>" class="btn btn-edit">Editar</a>
<a href="excluir-setor.php?id=<?php echo $dado['SetorID']; ?>" class="btn btn-delete">Excluir</a>
</td>
</tr>
<?php
    }
} else {
    // Caso não haja registros, exibe uma mensagem
    echo "<tr><td colspan='5'>Nenhum setor encontrado.</td></tr>";
}
?>
</tbody>
</table>
</div>
</main>

<?php
include_once './include/footer.php';
?>