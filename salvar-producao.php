<?php
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produtoID = $_POST['ProdutoID'];
    $funcionarioID = $_POST['FuncionarioID'];
    $clienteID = $_POST['ClienteID'];
    $dataProducao = $_POST['DataProducao'];
    $dataEntrega = $_POST['DataEntrega'];

    // Insere os dados na tabela 'producao'
    $sql = "INSERT INTO producao (ProdutoID, FuncionarioID, ClienteID, DataProducao, DataEntrega) 
            VALUES ('$produtoID', '$funcionarioID', '$clienteID', '$dataProducao', '$dataEntrega')";

    if ($conn->query($sql) === TRUE) {
        header("Location: lista-producao.php?mensagem=Produção salva com sucesso!");
        exit;
    } else {
        echo "Erro ao salvar produção: " . $conn->error;
    }
}
?>
<main>
<div class="container">
    <h1>Salvar Produção</h1>
    <form action="salvar-producao.php" method="POST">
        <label for="ProdutoID">ID do Produto:</label>
        <input type="text" name="ProdutoID" required><br>

        <label for="FuncionarioID">ID do Funcionário:</label>
        <input type="text" name="FuncionarioID" required><br>

        <label for="ClienteID">ID do Cliente:</label>
        <input type="text" name="ClienteID" required><br>

        <label for="DataProducao">Data de Produção:</label>
        <input type="date" name="DataProducao" required><br>

        <label for="DataEntrega">Data de Entrega:</label>
        <input type="date" name="DataEntrega" required><br>

        <button type="submit" class="btn btn-add">Salvar</button>
    </form>
</div>
</main>
<?php
include_once './include/footer.php';
?>