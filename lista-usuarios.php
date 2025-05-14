<?php
include_once './include/logado.php'; // Verifica se o usuário está logado
include_once './include/conexao.php'; // Conexão com o banco de dados
include_once './include/header.php'; // Cabeçalho da página

// Consulta para buscar todos os usuários
$sql = "SELECT UsuarioID, Nome, Email FROM usuarios";
$resultado = $conn->query($sql);
?>
<main>
<div class="container">
    <h1>Lista de Usuários</h1>
    <a href="./salvar-usuario.php" class="btn btn-add">Incluir</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Exibe os dados dos usuários na tabela
        while ($dado = $resultado->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $dado['UsuarioID']; ?></td>
                <td><?php echo $dado['Nome']; ?></td>
                <td><?php echo $dado['Email']; ?></td>
                <td>
                    <a href="editar-usuario.php?id=<?php echo $dado['UsuarioID']; ?>" class="btn btn-edit">Editar</a>
                    <a href="excluir-usuario.php?id=<?php echo $dado['UsuarioID']; ?>" class="btn btn-delete">Excluir</a>
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
include_once './include/footer.php'; // Rodapé da página
?>