<?php
include_once './include/logado.php';
include_once './include/conexao.php';

$id = $_GET['id'];
$sql = "DELETE FROM produtos WHERE ProdutoID = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: lista-produtos.php");
    exit;
} else {
    echo "Erro ao excluir produto: " . $conn->error;
}
?>