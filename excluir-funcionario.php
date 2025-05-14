<?php
include_once './include/logado.php';
include_once './include/conexao.php';

$id = $_GET['id'];
$sql = "DELETE FROM funcionarios WHERE FuncionarioID = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: lista-funcionarios.php");
    exit;
} else {
    echo "Erro ao excluir funcionário: " . $conn->error;
}
?>