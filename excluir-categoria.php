<?php
include_once './include/logado.php';
include_once './include/conexao.php';

$id = $_GET['id'];
$sql = "DELETE FROM categorias WHERE CategoriaID = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: lista-categorias.php");
    exit;
} else {
    echo "Erro ao excluir categoria: " . $conn->error;
}
?>