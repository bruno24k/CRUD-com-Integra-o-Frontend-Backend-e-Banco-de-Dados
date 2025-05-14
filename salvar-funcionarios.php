<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $setor = $_POST['setor'];

    $sql = "INSERT INTO funcionarios (Nome, CargoID, SetorID) VALUES ('$nome', '$cargo', '$setor')";
    if ($conn->query($sql) === TRUE) {
        header("Location: lista-funcionarios.php");
        exit;
    } else {
        echo "Erro ao salvar funcionário: " . $conn->error;
    }
}
?>
<style>
    .btn-save {
        background-color: green;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-save:hover {
        background-color: darkgreen;
    }
</style>
<main>
<div class="container">
    <h1>Incluir Funcionário</h1>
    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        
        <label for="cargo">Cargo:</label>
        <input type="text" id="cargo" name="cargo" required>
        
        <label for="setor">Setor:</label>
        <input type="text" id="setor" name="setor" required>
        
        <button type="submit" class="btn btn-save">Salvar</button>
    </form>
</div>
</main>
<?php
include_once './include/footer.php';
?>