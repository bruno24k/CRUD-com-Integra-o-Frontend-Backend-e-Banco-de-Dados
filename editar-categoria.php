<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$id = $_GET['id'];
$sql = "SELECT * FROM categorias WHERE CategoriaID = $id";
$resultado = $conn->query($sql);
$categoria = $resultado->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];

    $sql = "UPDATE categorias SET Nome = '$nome' WHERE CategoriaID = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: lista-categorias.php");
        exit;
    } else {
        echo "Erro ao atualizar categoria: " . $conn->error;
    }
}
?>
<main>
<div class="container">
    <h1>Editar Categoria</h1>
    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $categoria['Nome']; ?>" required>
        
        <button type="submit" class="btn btn-save">Salvar</button>
    </form>
</div>
</main>
<?php
include_once './include/footer.php';
?>