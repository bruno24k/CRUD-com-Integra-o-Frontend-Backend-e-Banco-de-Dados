<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$id = $_GET['id'];
$sql = "SELECT * FROM funcionarios WHERE FuncionarioID = $id";
$resultado = $conn->query($sql);
$funcionario = $resultado->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $setor = $_POST['setor'];

    $sql = "UPDATE funcionarios SET Nome = '$nome', CargoID = '$cargo', SetorID = '$setor' WHERE FuncionarioID = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: lista-funcionarios.php");
        exit;
    } else {
        echo "Erro ao atualizar funcionário: " . $conn->error;
    }
}
?>
<main>
<div class="container">
    <h1>Editar Funcionário</h1>
    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $funcionario['Nome']; ?>" required>
        
        <label for="cargo">Cargo:</label>
        <input type="text" id="cargo" name="cargo" value="<?php echo $funcionario['CargoID']; ?>" required>
        
        <label for="setor">Setor:</label>
        <input type="text" id="setor" name="setor" value="<?php echo $funcionario['SetorID']; ?>" required>
        
        <button type="submit" class="btn btn-save">Salvar</button>
    </form>
</div>
</main>
<?php
include_once './include/footer.php';
?>