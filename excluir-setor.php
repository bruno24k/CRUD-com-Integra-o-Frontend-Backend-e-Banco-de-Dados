<?php
include_once './include/logado.php';
include_once './include/conexao.php';

if (isset($_GET['id'])) {
    $setorID = intval($_GET['id']);
    $sql = "DELETE FROM setor WHERE SetorID = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt->bind_param("i", $setorID);

    if ($stmt->execute()) {
        header("Location: lista-setor.php?msg=excluido");
        exit;
    } else {
        die("Erro ao excluir setor: " . $stmt->error);
    }
} else {
    die("ID do setor não fornecido.");
}
?>