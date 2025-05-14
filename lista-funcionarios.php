<?php
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Consulta SQL para listar os funcionários
$sql = "SELECT * FROM funcionarios";
$resultado = $conn->query($sql);
?>
<main>
<div class="container">
    <h1>Lista de Funcionários</h1>
    <a href="./salvar-funcionarios.php" class="btn btn-add">Incluir</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cargo</th>
                <th>Setor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($resultado->num_rows > 0) {
            while ($dado = $resultado->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $dado['FuncionarioID']; ?></td>
            <td><?php echo $dado['Nome']; ?></td>
            <td><?php echo $dado['CargoID']; ?></td>
            <td><?php echo $dado['SetorID']; ?></td>
            <td>
                <!-- Corrigido o link para editar funcionário -->
                <a href="editar-funcionario.php?id=<?php echo $dado['FuncionarioID']; ?>" class="btn btn-edit">Editar</a>
                <a href="excluir-funcionario.php?id=<?php echo $dado['FuncionarioID']; ?>" class="btn btn-delete">Excluir</a>
            </td>
        </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum funcionário encontrado.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</main>
<?php
include_once './include/footer.php';
?>