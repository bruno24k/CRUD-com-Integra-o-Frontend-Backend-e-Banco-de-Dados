<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

if (isset($_GET['id'])) {
    $producaoID = intval($_GET['id']);

    $sql = "SELECT * FROM producao WHERE ProducaoID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $producaoID);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $producao = $resultado->fetch_assoc();
    } else {
        echo "Produção não encontrada.";
        exit;
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produtoID = $_POST['ProdutoID'];
    $funcionarioID = $_POST['FuncionarioID'];
    $clienteID = $_POST['ClienteID'];
    $dataProducao = $_POST['DataProducao'];
    $dataEntrega = $_POST['DataEntrega'];

    $sql = "UPDATE producao 
            SET ProdutoID = ?, FuncionarioID = ?, ClienteID = ?, DataProducao = ?, DataEntrega = ? 
            WHERE ProducaoID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiissi", $produtoID, $funcionarioID, $clienteID, $dataProducao, $dataEntrega, $producaoID);

    if ($stmt->execute()) {
        header("Location: lista-producao.php?mensagem=Produção atualizada com sucesso!");
        exit;
    } else {
        echo "Erro ao atualizar produção: " . $stmt->error;
    }
    $stmt->close();
}
?>

<main>
<div class="container">
    <h1>Editar Produção</h1>
    <form action="editar-producao.php?id=<?php echo $producaoID; ?>" method="POST">
        <label for="ProdutoID">ID do Produto:</label>
        <input type="number" name="ProdutoID" value="<?php echo $producao['ProdutoID']; ?>" required><br>

        <label for="FuncionarioID">ID do Funcionário:</label>
        <input type="number" name="FuncionarioID" value="<?php echo $producao['FuncionarioID']; ?>" required><br>

        <label for="ClienteID">ID do Cliente:</label>
        <input type="number" name="ClienteID" value="<?php echo $producao['ClienteID']; ?>" required><br>

        <label for="DataProducao">Data de Produção:</label>
        <input type="date" name="DataProducao" value="<?php echo $producao['DataProducao']; ?>" required><br>

        <label for="DataEntrega">Data de Entrega:</label>
        <input type="date" name="DataEntrega" value="<?php echo $producao['DataEntrega']; ?>" required><br>

        <button type="submit" class="btn btn-edit">Atualizar</button>
    </form>
</div>
</main>

<?php include_once './include/footer.php'; ?>