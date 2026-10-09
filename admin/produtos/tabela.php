<?php

require_once __DIR__ . "/../../conexao/conecta.php";

$status = isset($_POST['status']) ? $_POST['status'] : '';
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
$marca = isset($_POST['marca']) ? $_POST['marca'] : '';

$nome = isset($_POST['pesquisa']) ? mysqli_real_escape_string($conexao, $_POST['pesquisa']) : '';

$sql = "SELECT produto.codigo_produto, produto.ft_produto_1, produto.nome, categoria.nome AS categoria, marca.nome AS marca, produto.preco_produto, produto.data_cadastro, produto.status 
FROM produto 
INNER JOIN categoria ON categoria.codigo_categoria = produto.codigo_categoria 
INNER JOIN marca ON marca.codigo_marca = produto.codigo_marca WHERE 1=1";

if ($status != '') {
  $sql .= " AND produto.status = $status";
}

if (!empty($categoria)) {
  $sql .= " AND produto.codigo_categoria = $categoria";
}

if (!empty($marca)) {
  $sql .= " AND produto.codigo_marca = $marca";
}

if (!empty($nome)) {
  $sql .= " AND produto.nome LIKE '%$nome%'";
}

$query = mysqli_query($conexao, $sql);

if (mysqli_num_rows($query) > 0) {
  ?>

  <table class="table">

    <thead class="table-dark">
      <tr class="text-center">
        <th>ID</th>
        <th>Foto</th>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Marca</th>
        <th>Preço</th>
        <th>Data Cadastro</th>
        <th>Status</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>

      <?php
      foreach ($query as $produto) {
        ?>

        <tr class="text-center">
          <td><?php echo $produto['codigo_produto'] ?></td>

          <td>
            <?php
            if ($produto['ft_produto_1'] != '') {
              echo '<img src="../../imagens/' . $produto['ft_produto_1'] . '" alt="' . $produto['nome'] . '" class="img-funcionario" style="width: 200px; height: 200px; object-fit: cover; border-radius: 4px;">';
            } else {
              echo '<img src="../../assets/img/placeholder.png" alt="' . $produto['nome'] . '" class="img-funcionario" style="width: 200px; height: 200px; object-fit: cover; border-radius: 4px;">';
            }
            ?>
          </td>

          <td><?php echo $produto['nome'] ?></td>

          <td><?php echo $produto['categoria'] ?></td>

          <td><?php echo $produto['marca'] ?></td>

          <td>R$ <?php echo number_format($produto['preco_produto'], 2, ',', '.') ?></td>

          <td><?php echo date('d/m/Y', strtotime($produto['data_cadastro'])) ?></td>

          <td>
            <?php
            if ($produto['status'] == 1) {
              echo '<span class="badge rounded-pill text-bg-success">Ativo</span>';
            } else {
              echo '<span class="badge rounded-pill text-bg-danger">Inativo</span>';
            }
            ?>
          </td>
          <td>

            <a href="editar.php?codigo_produto=<?php echo $produto['codigo_produto'] ?>" class="btn btn-outline-success btn-sm" title="Editar"><i class="bi bi-pencil"></i></a>

            <form action="Acoes.php" method="post" class="d-inline">
              <button type="submit" class="btn btn-outline-danger btn-sm" title="Excluir" name="deletar_produto" value="<?php echo $produto['codigo_produto'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">
                <i class="bi bi-trash"></i>
              </button>
            </form>

          </td>
        </tr>

        <?php
      }
      ?>

    </tbody>

  </table>

  <?php
} else {
  echo '<div class="alert alert-warning d-flex align-items-center justify-content-center" role="alert">
          Nenhum registro encontrado
        </div>';
}

?>