<?php
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';

// Verifica se uma ação foi passada
if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];

    // Excluir cargo
    if ($acao === 'excluir' && isset($_GET['id'])) {
        $cargoID = intval($_GET['id']);
        $sql = "DELETE FROM cargos WHERE CargoID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $cargoID);

        if ($stmt->execute()) {
            header("Location: lista-cargos.php?msg=excluido");
            exit;
        } else {
            die("Erro ao excluir cargo: " . $conn->error);
        }
    }
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $tetoSalarial = $_POST['teto_salarial'];
    $id = intval($_POST['id']);

    if ($id > 0) {
        // Atualiza os campos (edição)
        $sql = "UPDATE cargos SET Nome = ?, TetoSalarial = ? WHERE CargoID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdi", $nome, $tetoSalarial, $id);

        if ($stmt->execute()) {
            header("Location: lista-cargos.php?msg=editado");
            exit;
        } else {
            die("Erro ao editar cargo: " . $conn->error);
        }
    } else {
        // Insere um novo cargo (inclusão)
        $sql = "INSERT INTO cargos (Nome, TetoSalarial) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sd", $nome, $tetoSalarial);

        if ($stmt->execute()) {
            header("Location: lista-cargos.php?msg=incluido");
            exit;
        } else {
            die("Erro ao incluir cargo: " . $conn->error);
        }
    }
}

// Verifica se é uma edição para carregar os dados
$cargo = null;
if (isset($_GET['id']) && !isset($_GET['acao'])) {
    $cargoID = intval($_GET['id']);
    $sql = "SELECT * FROM cargos WHERE CargoID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cargoID);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $cargo = $resultado->fetch_assoc();
    } else {
        die("Cargo não encontrado.");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $cargo ? "Editar Cargo" : "Incluir Cargo"; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        form button {
            width: 100%;
            padding: 10px;
            background-color: #28a745; /* Cor verde */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        form button:hover {
            background-color: #218838;
        }

        .btn-cancel {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #555;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-cancel:hover {
            color: #000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $cargo ? "Editar Cargo" : "Incluir Cargo"; ?></h1>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $cargo['CargoID'] ?? ''; ?>">

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $cargo['Nome'] ?? ''; ?>" required>

            <label for="teto_salarial">Teto Salarial:</label>
            <input type="number" id="teto_salarial" name="teto_salarial" value="<?php echo $cargo['TetoSalarial'] ?? ''; ?>" step="0.01" required>

            <button type="submit">Salvar</button>
            <a href="lista-cargos.php" class="btn-cancel">Cancelar</a>
        </form>
    </div>
</body>
</html>     