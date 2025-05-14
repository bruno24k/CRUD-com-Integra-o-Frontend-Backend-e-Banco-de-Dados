<?php
// Inclui os arquivos necessários
include_once './include/logado.php'; // Verifica se o usuário está logado
include_once './include/conexao.php'; // Conexão com o banco de dados
include_once './include/header.php'; // Cabeçalho da página

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha

    // Insere os dados no banco de dados
    $sql = "INSERT INTO usuarios (Nome, Email, Senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        // Redireciona para a lista de usuários após salvar
        header("Location: lista-usuarios.php");
        exit;
    } else {
        echo "<p>Erro ao salvar o usuário: " . $stmt->error . "</p>";
    }
}
?>

<main>
<div class="container">
    <h1>Incluir Usuário</h1>
    <form method="POST" action="salvar-usuarios.php">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>
        <button type="submit" class="btn btn-save" style="background-color: green; color: white;">Salvar</button>
        <a href="lista-usuarios.php" class="btn btn-cancel">Cancelar</a>
    </form>
</div>
</main>

<?php
include_once './include/footer.php'; // Rodapé da página
?>