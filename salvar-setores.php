<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $nome = trim($_POST['Nome']);
    $andar = trim($_POST['Andar']);
    $cor = trim($_POST['Cor']);

    // Verifica se os campos estão preenchidos
    if (empty($nome) || empty($andar) || empty($cor)) {
        echo "Todos os campos (Nome, Andar e Cor) são obrigatórios.";
        exit;
    }

    // Prepara a consulta SQL para inserir os dados
    $sql = "INSERT INTO setores (nome, andar, cor) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $nome, $andar, $cor);

        // Executa a consulta
        if ($stmt->execute()) {
            header("Location: lista-setores.php?mensagem=Setor salvo com sucesso!");
            exit;
        } else {
            echo "Erro ao salvar setor: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta: " . $conn->error;
    }
}
?>

<main>
<div class="container">
    <h1>Salvar Setor</h1>
    <form action="salvar-setores.php" method="POST">
        <label for="Nome">Nome do Setor:</label>
        <input type="text" name="Nome" required><br>

        <label for="Andar">Andar:</label>
        <input type="text" name="Andar" required><br>

        <label for="Cor">Cor:</label>
        <input type="text" name="Cor" required><br>

        <button type="submit" class="btn btn-add">Salvar</button>
    </form>
</div>
</main>

<?php include_once './include/footer.php'; ?>