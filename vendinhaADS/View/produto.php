<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="E-commerce de peças de computadores">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Computer Parts E-commerce</title>
</head>
<body>
    <header>
        <?php include_once 'navbar.php'; ?>
    </header>

    <main class="container">
        <section class="section">
         
   
            <?php
            // Conectando ao banco de dados
            $conn = mysqli_connect("localhost", "root", "", "bdlojinha");

            // Verificando conexão
            if (!$conn) {
                die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
            }

            // Selecionando produtos
            $sql = "SELECT * FROM produto";
            $result = mysqli_query($conn, $sql);

            // Exibindo produtos
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='col s12 m6 l3 '>";
                echo "<div class='card small-card'>";
                echo "<div class='card-image'>";
                echo "<img src='images/". $row['imagem']. "' alt='". $row['nome']. "' class='responsive-img small-img'>";
                echo "</div>";
                echo "<div class='card-content'>";
                echo "<span class='card-title'>". $row['nome']. "</span>";
                echo "<p>Preço: R$". $row['preco']. "</p>";
                echo "<p>Descrição: ". $row['descricao']. "</p>";
                echo "</div>";
                echo "<div class='card-action'>";
                echo "<a href='produto.php?id=". $row['id']. "'>Ver mais</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }

            // Fechando conexão
            mysqli_close($conn);
            ?>
        </section>
    </main>

    <?php include_once 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
