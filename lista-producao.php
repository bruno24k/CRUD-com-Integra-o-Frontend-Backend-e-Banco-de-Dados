<?php
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Consulta SQL para buscar os dados da tabela 'producao'
$sql = "SELECT ProducaoID, ProdutoID, FuncionarioID, ClienteID, DataProducao, DataEntrega FROM producao";
$resultado = $conn->query($sql);
?>

<main>
<div class="container">
    <h1>Lista de Produções</h1>
    <a href="salvar-producao.php" class="btn btn-add">Adicionar Produção</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID Produção</th>
                <th>ID Produto</th>
                <th>ID Funcionário</th>
                <th>ID Cliente</th>
                <th>Data Produção</th>
                <th>Data Entrega</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado && $resultado->num_rows > 0) {
                while ($dado = $resultado->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $dado['ProducaoID']; ?></td>
                <td><?php echo $dado['ProdutoID']; ?></td>
                <td><?php echo $dado['FuncionarioID']; ?></td>
                <td><?php echo $dado['ClienteID']; ?></td>
                <td><?php echo $dado['DataProducao']; ?></td>
                <td><?php echo $dado['DataEntrega']; ?></td>
                <td>
                    <a href="editar-producao.php?id=<?php echo $dado['ProducaoID']; ?>" class="btn btn-edit">Editar</a>
                    <a href="excluir-producao.php?id=<?php echo $dado['ProducaoID']; ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir esta produção?');">Excluir</a>
                </td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='7'>Nenhuma produção encontrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</main>

<?php
include_once './include/footer.php';
?>