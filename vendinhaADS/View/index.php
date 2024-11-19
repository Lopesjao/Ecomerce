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
    <script src="main.js"></script>
    <style>
        /* CSS personalizado para o efeito de movimentação */
        .card {
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-10px);
        }

      
        .custom-button {
            background-color: white;
            /* Cor personalizada */
            color: white;
            width: 100%;
            height: 50%;
            /* Cor do texto */
        }

        .btn img {
            vertical-align: middle;
            margin-right: 8px;
            width: 50%; /* Ajuste o tamanho da imagem conforme necessário */
        }
    </style>
    <title>Computer Parts E-commerce</title>
</head>

<body>
    <header>
        <?php include_once 'navbar.php'; ?>
    </header>

    <main class="container">
        <section class="section">
            <div class="row mt-4">
                <div class="col s12">
                    <h1 class="center-align">Bem-vindo ao JM-Eletronicos!</h1>
                    <p class="flow-text center-align">Encontre as melhores peças para seu computador aqui.</p>

                </div>
            </div>

        

            <div class="row">
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
                    echo "<div class='col s12 m6 l3'>";
                    echo "<div class='card small-card hoverable'>"; // Adicionada a classe hoverable do Materialize
                    echo "<div class='card-image'>";
                    echo "<img src='images/" . htmlspecialchars($row['imagem']) . "' alt='" . htmlspecialchars($row['nome']) . "' class='responsive-img small-img'>";
                    echo "</div>";
                    echo "<div class='card-content'>";
                    echo "<span class='card-title'>" . htmlspecialchars($row['nome']) . "</span>";
                    echo "<p>Preço: R$" . htmlspecialchars($row['preco']) . "</p>";
                    echo "<p>Descrição: " . htmlspecialchars($row['descricao']) . "</p>";
                    echo "</div>";
                    echo "<div class='card-action'>";
                    echo "<form action='carrinho.php' method='POST'>";
                    echo "<input type='hidden' name='produto_id' value='" . htmlspecialchars($row['id']) . "'>";
                    echo "<button type='submit' class='btn custom-button'>";
                    echo "<img src='images/carrinho.png' alt='Carrinho'>";
                    echo "</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }

                // Fechando conexão
                mysqli_close($conn);
                ?>
            </div>
        </section>
       
     
    </main>


    <div id="modal2" class="modal" style="width:50%">
    <div class="modal-content">
      <h4>Desenvolvido por João Lopes</h4>
      <p>ADS 18</p>
      </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
    </div>
  </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
    });
</script>


    <?php include_once 'footer.php'; ?>
  

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>
