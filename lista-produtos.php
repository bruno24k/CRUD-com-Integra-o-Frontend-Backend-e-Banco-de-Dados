<?php
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Consulta SQL para listar os produtos
$sql = "SELECT * FROM produtos";
$resultado = $conn->query($sql);
?>
<main>
<div class="container">
    <h1>Lista de Produtos</h1>
    <a href="./salvar-produtos.php" class="btn btn-add">Incluir</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($resultado->num_rows > 0) {
            while ($dado = $resultado->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $dado['ProdutoID']; ?></td>
            <td><?php echo $dado['Nome']; ?></td>
            <td><?php echo $dado['Preco']; ?></td>
            <td><?php echo $dado['CategoriaID']; ?></td>
            <td>
                <a href="editar-produto.php?id=<?php echo $dado['ProdutoID']; ?>" class="btn btn-edit">Editar</a>
                <a href="excluir-produto.php?id=<?php echo $dado['ProdutoID']; ?>" class="btn btn-delete">Excluir</a>
            </td>
        </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum produto encontrado.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</main>
<?php
include_once './include/footer.php';
?>