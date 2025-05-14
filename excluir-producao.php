<?php
include_once './include/logado.php';
include_once './include/conexao.php';

if (isset($_GET['id'])) {
    $producaoID = intval($_GET['id']);

    $sql = "DELETE FROM producao WHERE ProducaoID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $producaoID);

    if ($stmt->execute()) {
        header("Location: lista-producao.php?mensagem=Produção excluída com sucesso!");
        exit;
    } else {
        echo "Erro ao excluir produção: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "ID inválido.";
}
?>