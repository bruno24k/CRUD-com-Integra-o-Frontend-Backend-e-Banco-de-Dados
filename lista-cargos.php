<?php 
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Executa a consulta SQL
$sql = "SELECT * FROM cargos";
$resultado = $conn->query($sql);

// Verifica se a consulta foi bem-sucedida
if (!$resultado) {
    die("Erro na consulta: " . $conn->error);
}
?>
 
<main>
  <div class="container">
    <h1>Lista de Cargos</h1>
    <a href="./salvar-cargos.php" class="btn btn-add">Incluir</a>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Teto Salarial</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($dado = $resultado->fetch_assoc()): ?>
          <tr>
            <td><?php echo $dado['CargoID']; ?></td>
            <td><?php echo $dado['Nome']; ?></td>
            <td><?php echo $dado['TetoSalarial']; ?></td>
            <td>
              <a href="salvar-cargos.php?id=<?php echo $dado['CargoID']; ?>" class="btn btn-edit">Editar</a>
              <a href="salvar-cargos.php?id=<?php echo $dado['CargoID']; ?>" class="btn btn-delete">Excluir</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</main>

<?php include_once './include/footer.php'; ?>
