<?php
include_once 'conexao.php';
include_once 'navbar.php';


if(isset($_POST["botaoEnviar"])){
    if(!empty($_POST["Nome"]) && !empty($_POST["email"]) && !empty($_POST["senha"])){
       
        $nome = filter_input(INPUT_POST, 'Nome', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

        if ($nome && $email && $senha) {
            $dados = array(
                'Nome' => $nome,
                'email' => $email,
                'senha' => $senha
            );
            $resultado = cadastrarCliente($dados);

            if ($resultado) {
                $mensagem = "Cadastro realizado com sucesso!";
            } else {
                $mensagem = "Erro ao realizar o cadastro. Tente novamente.";
            }
        } else {
            $mensagem = "Dados inválidos!";
        }
    } else {
        $mensagem = "Por favor, preencha todos os campos.";
    }
}

function cadastrarCliente($dados) {
    try {
        $conexao = new Conexao();
        $conexao = $conexao->conexao();
        $senhaHash = password_hash($dados['senha'], PASSWORD_DEFAULT); // Criptografa a senha
        $stmt = $conexao->prepare('INSERT INTO cliente(Nome, email, senha) VALUES(:eNome, :eemail, :esenha);');

        $stmt->bindParam(':eNome', $dados['Nome']);
        $stmt->bindParam(':eemail', $dados['email']);
        $stmt->bindParam(':esenha', $senhaHash); // Usa a senha criptografada

        $resultado = $stmt->execute();
        $conexao = null; // Encerrar conexão
        return $resultado;
    } catch (PDOException $e) {
        error_log("Erro ao cadastrar cliente: " . $e->getMessage());
        return false;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Registro de Cliente</title>
</head>
<body>
    <main>
    <div class="containercd">
        <h1 class="center-align">Cadastro de Cliente</h1>
        <div id="cadastro" class="row">
            <form action="formcadastro.php" method="post" class="col s12">
                <div class="row">
                    <div class="input-field col s12">
                        <label for="Nome">Nome:</label>
                        <input type="text" name="Nome" id="Nome" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 center-align">
                        <input type="submit" name="botaoEnviar" id="btenviar" value="Cadastrar" >
                    </div>
                </div>
            </form>
        </div>
        <?php if (isset($mensagem)): ?>
            <div class="row">
                <div class="col s12">
                    <div class="card-panel teal lighten-2">
                        <span class="white-text"><?= $mensagem ?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    </main>


    <?php include_once 'footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   
</body>
</html>
