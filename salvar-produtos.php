<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Consulta para listar categorias (para o dropdown)
$sqlCategorias = "SELECT * FROM categorias";
$resultadoCategorias = $conn->query($sqlCategorias);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $categoriaID = $_POST['categoria'];

    $sql = "INSERT INTO produtos (Nome, Preco, CategoriaID) VALUES ('$nome', '$preco', '$categoriaID')";
    if ($conn->query($sql) === TRUE) {
        header("Location: lista-produtos.php");
        exit;
    } else {
        echo "Erro ao salvar produto: " . $conn->error;
    }
}
?>
<main>
<div class="container">
    <h1>Incluir Produto</h1>
    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="0.01" required>

        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria" required>
            <option value="">Selecione</option>
            <?php while ($categoria = $resultadoCategorias->fetch_assoc()) { ?>
                <option value="<?php echo $categoria['CategoriaID']; ?>"><?php echo $categoria['Nome']; ?></option>
            <?php } ?>
        </select>
        
        <button type="submit" class="btn btn-save">Salvar</button>
    </form>
</div>
</main>
<style>
    .btn-save {
        background-color: #28a745; /* Cor verde */
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-save:hover {
        background-color: #218838; /* Tom mais escuro de verde */
    }
</style>
<?php
include_once './include/footer.php';
?>