<?php
session_start();

// Inicializar o carrinho se ele não estiver inicializado
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Adicionar produto ao carrinho
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['produto_id'])) {
    $produto_id = intval($_POST['produto_id']);
    if (!in_array($produto_id, $_SESSION['carrinho'])) {
        $_SESSION['carrinho'][] = $produto_id;
    }
}

// Conectando ao banco de dados
$conn = mysqli_connect("localhost", "root", "", "bdlojinha");

// Verificando conexão
if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

// Selecionar produtos no carrinho
$produtos_no_carrinho = [];
if (!empty($_SESSION['carrinho'])) {
    $ids = implode(',', $_SESSION['carrinho']);
    $sql = "SELECT * FROM produto WHERE id IN ($ids)";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $produtos_no_carrinho[] = $row;
    }
}

// Selecionar todos os produtos para exibir
$sql = "SELECT * FROM produto";
$result = mysqli_query($conn, $sql);
$produtos_todos = [];
while ($row = mysqli_fetch_assoc($result)) {
    $produtos_todos[] = $row;
}

// Fechando conexão
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php include_once 'navbar.php'; ?>
    </header>

    <main class="container">
        <h1 class="center-align">Carrinho de Compras</h1>
        <div class="row">
            <?php if (empty($produtos_no_carrinho)) : ?>
                <p class="flow-text center-align">Seu carrinho está vazio.</p>
            <?php else : ?>
                <?php foreach ($produtos_no_carrinho as $produto) : ?>
                    <div class='col s12 m6 l3'>
                        <div class='card small-card hoverable'>
                            <div class='card-image'>
                                <img src='images/<?php echo htmlspecialchars($produto['imagem']); ?>' alt='<?php echo htmlspecialchars($produto['nome']); ?>' class='responsive-img small-img'>
                            </div>
                            <div class='card-content'>
                                <span class='card-title'><?php echo htmlspecialchars($produto['nome']); ?></span>
                                <p>Preço: R$<?php echo htmlspecialchars($produto['preco']); ?></p>
                                <p>Descrição: <?php echo htmlspecialchars($produto['descricao']); ?></p>
                            </div>
                            <div class='card-action'>
                                <!-- Opcional: Adicionar botão para remover do carrinho -->
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <h2 class="center-align">Produtos</h2>
        <div class="row">
            <?php foreach ($produtos_todos as $produto) : ?>
                <div class='col s12 m6 l3'>
                    <div class='card small-card hoverable'>
                        <div class='card-image'>
                            <img src='images/<?php echo htmlspecialchars($produto['imagem']); ?>' alt='<?php echo htmlspecialchars($produto['nome']); ?>' class='responsive-img small-img'>
                        </div>
                        <div class='card-content'>
                            <span class='card-title'><?php echo htmlspecialchars($produto['nome']); ?></span>
                            <p>Preço: R$<?php echo htmlspecialchars($produto['preco']); ?></p>
                            <p>Descrição: <?php echo htmlspecialchars($produto['descricao']); ?></p>
                        </div>
                        <div class='card-action'>
                            <form action='carrinho.php' method='POST'>
                                <input type='hidden' name='produto_id' value='<?php echo htmlspecialchars($produto['id']); ?>'>
                                <button type='submit' class='btn waves-effect waves-light'>Adicionar ao Carrinho</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include_once 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.carousel');
            var instances = M.Carousel.init(elems, {
                fullWidth: true,
                indicators: true
            });
        });
    </script>
</body>
</html>
