<?php
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Consulta SQL para listar as categorias
$sql = "SELECT * FROM categorias";
$resultado = $conn->query($sql);
?>
<main>
<div class="container">
    <h1>Lista de Categorias</h1>
    <a href="./salvar-categorias.php" class="btn btn-add">Incluir</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($resultado->num_rows > 0) {
            while ($dado = $resultado->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $dado['CategoriaID']; ?></td>
            <td><?php echo $dado['Nome']; ?></td>
            <td>
                <a href="editar-categoria.php?id=<?php echo $dado['CategoriaID']; ?>" class="btn btn-edit">Editar</a>
                <a href="excluir-categoria.php?id=<?php echo $dado['CategoriaID']; ?>" class="btn btn-delete">Excluir</a>
            </td>
        </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='3'>Nenhuma categoria encontrada.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</main>
<?php
include_once './include/footer.php';
?>