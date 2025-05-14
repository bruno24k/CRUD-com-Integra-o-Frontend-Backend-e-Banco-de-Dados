<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$id = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE ProdutoID = $id";
$resultado = $conn->query($sql);
$produto = $resultado->fetch_assoc();

// Consulta para listar categorias (para o dropdown)
$sqlCategorias = "SELECT * FROM categorias";
$resultadoCategorias = $conn->query($sqlCategorias);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $categoriaID = $_POST['categoria'];

    $sql = "UPDATE produtos SET Nome = '$nome', Preco = '$preco', CategoriaID = '$categoriaID' WHERE ProdutoID = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: lista-produtos.php");
        exit;
    } else {
        echo "Erro ao atualizar produto: " . $conn->error;
    }
}
?>
<main>
<div class="container">
    <h1>Editar Produto</h1>
    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $produto['Nome']; ?>" required>

        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="0.01" value="<?php echo $produto['Preco']; ?>" required>

        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria" required>
            <?php while ($categoria = $resultadoCategorias->fetch_assoc()) { ?>
                <option value="<?php echo $categoria['CategoriaID']; ?>" <?php echo ($categoria['CategoriaID'] == $produto['CategoriaID']) ? 'selected' : ''; ?>>
                    <?php echo $categoria['Nome']; ?>
                </option>
            <?php } ?>
        </select>
        
        <button type="submit" class="btn btn-save">Salvar</button>
    </form>
</div>
</main>
<style>
    .btn-save {
        background-color: #28a745; 
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-save:hover {
        background-color: #218838; 
    }
</style>
<?php
include_once './include/footer.php';
?>