<?php
require_once __DIR__ . "/conexao/conecta.php";

// Nome da categoria cadastrada no painel
$nome_categoria = "Processadores";

// Marca escolhida no filtro (0 = todas)
$codigo_marca = intval($_GET['marca'] ?? 0);

// Marcas que possuem processadores ativos
$sql_marcas = "SELECT DISTINCT marca.codigo_marca, marca.nome
               FROM produto
               INNER JOIN categoria ON categoria.codigo_categoria = produto.codigo_categoria
               INNER JOIN marca ON marca.codigo_marca = produto.codigo_marca
               WHERE produto.status = 1
                 AND categoria.status = 1
                 AND categoria.nome = ?
               ORDER BY marca.nome";

$stmt_marcas = mysqli_prepare($conexao, $sql_marcas);
mysqli_stmt_bind_param($stmt_marcas, "s", $nome_categoria);
mysqli_stmt_execute($stmt_marcas);
$marcas = mysqli_stmt_get_result($stmt_marcas);

// Produtos
$sql = "SELECT produto.codigo_produto, produto.nome, produto.preco_produto,
               produto.ft_produto_1
        FROM produto
        INNER JOIN categoria ON categoria.codigo_categoria = produto.codigo_categoria
        WHERE produto.status = 1
          AND categoria.status = 1
          AND categoria.nome = ?";

if ($codigo_marca > 0) {
  $sql .= " AND produto.codigo_marca = ?";
}

$sql .= " ORDER BY produto.nome";

$stmt = mysqli_prepare($conexao, $sql);

if ($codigo_marca > 0) {
  mysqli_stmt_bind_param($stmt, "si", $nome_categoria, $codigo_marca);
} else {
  mysqli_stmt_bind_param($stmt, "s", $nome_categoria);
}

mysqli_stmt_execute($stmt);
$produtos = mysqli_stmt_get_result($stmt);
?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Capivaras Hardwares-cpu</title>
  <!-- Autor -->
  <meta name="author" content="Elvis Travisani" />
  <!-- Link do Bootstrap CSS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- CDN fontaWere Icones -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <!-- ADICIONAR FONTE AQUI -->
  <link
    href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
    rel="stylesheet" />
  <!-- Link do meu arquivo CSS -->
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <!-- Cabeçalho -->
  <?php require 'cabecalho.php'; ?>

  <main id="produtos-cpu">

    <div class="container">
      <div class="row align-items-start">
        <h2>CPU</h2>

        <!-- Filtro por marca -->
        <div class="col-12 mb-4 d-flex flex-wrap gap-2">
          <a href="cpu.php" class="btn btn-sm <?php echo $codigo_marca == 0 ? 'btn-light' : 'btn-outline-light'; ?>">
            Todas
          </a>

          <?php foreach ($marcas as $marca) { ?>
            <a href="cpu.php?marca=<?php echo $marca['codigo_marca']; ?>"
              class="btn btn-sm <?php echo $codigo_marca == $marca['codigo_marca'] ? 'btn-light' : 'btn-outline-light'; ?>">
              <?php echo htmlspecialchars($marca['nome']); ?>
            </a>
          <?php } ?>
        </div>

        <?php if (mysqli_num_rows($produtos) > 0) { ?>

          <?php foreach ($produtos as $produto) { ?>

            <div class="col-12 col-md-4 col-lg-3 mb-5">
              <div class="produto">

                <div class="imagem">
                  <?php if (!empty($produto['ft_produto_1'])) { ?>
                    <img src="imagens/<?php echo htmlspecialchars($produto['ft_produto_1']); ?>"
                      alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                  <?php } else { ?>
                    <img src="assets/img/placeholder.png" alt="Sem imagem">
                  <?php } ?>
                </div>

                <div class="nome">
                  <h4><?php echo htmlspecialchars($produto['nome']); ?></h4>
                </div>

                <div class="preco">
                  <p>R$ <?php echo number_format($produto['preco_produto'], 2, ',', '.'); ?></p>
                </div>

                <div class="botao-comprar">
                  <a href="compra.php?codigo_produto=<?php echo $produto['codigo_produto']; ?>">COMPRAR</a>
                </div>

              </div>
            </div>

          <?php } ?>

        <?php } else { ?>

          <p class="text-center">Nenhuma CPU disponível no momento.</p>

        <?php } ?>

      </div>
    </div>

  </main>

  <!-- Rodapé -->
  <?php require 'rodape.php'; ?>

  <!-- fechar a conexão do banco -->
  <?php mysqli_close($conexao); ?>

  <!-- my Js -->
  <script src="assets/Js/script.js"></script>
  <!-- JavaScript do Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>