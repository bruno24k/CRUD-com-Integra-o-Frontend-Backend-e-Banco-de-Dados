<?php
include_once './include/logado.php'; // Verifica se o usuário está logado
include_once './include/conexao.php'; // Conexão com o banco de dados
include_once './include/header.php'; // Cabeçalho da página

// Verifica se o ID do usuário foi passado via GET
if (isset($_GET['id'])) {
    $usuarioID = intval($_GET['id']);

    // Consulta para buscar os dados do usuário pelo ID
    $sql = "SELECT * FROM usuarios WHERE UsuarioID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuarioID);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verifica se o usuário existe
    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
    } else {
        echo "<p>Usuário não encontrado.</p>";
        exit;
    }
} else {
    echo "<p>ID do usuário não fornecido.</p>";
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Atualiza os dados do usuário no banco de dados
    $sql = "UPDATE usuarios SET Email = ?, Senha = ? WHERE UsuarioID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $email, $senha, $usuarioID);

    if ($stmt->execute()) {
        echo "<p>Usuário atualizado com sucesso!</p>";
        header("Location: lista-usuarios.php");
        exit;
    } else {
        echo "<p>Erro ao atualizar o usuário.</p>";
    }
}
?>

<main>
<div class="container">
    <h1>Editar Usuário</h1>
    <form method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['Email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" value="<?php echo htmlspecialchars($usuario['Senha']); ?>" required>
        </div>
        <button type="submit" class="btn btn-save" style="background-color: green; color: white;">Salvar</button>
        <a href="lista-usuarios.php" class="btn btn-cancel">Cancelar</a>
    </form>
</div>
</main>

<?php
include_once './include/footer.php'; // Rodapé da página
?>