<?php

// O dir e para meio que retornar onde o arquivo esta dentro, require once ele tenta a conexão apenas uma vez
require_once __DIR__ . "/../../conexao/conecta.php";

/* FILTROS */
$status = $_POST['status'];

/* COMPO DE BUSCA */
$nome = mysqli_real_escape_string($conexao, $_POST['pesquisa']);

// CODIGO SQL
$sql = "SELECT codigo_cargo, nome, observacao, status, data_cadastro FROM cargo WHERE 1=1";

/* FILTRO POR STATUS */
if ($status != '') {
  $sql .= " AND status = $status";
}

/* FILTRO POR NOME */
if (!empty($nome)) {
  $sql .= " AND nome LIKE '%$nome%'";
}

// A FUNÇÃO DO MYSQL_QUERY REALIZA A CONEXÃO COM O BANCO DE DADOS E EXECUTA O COMANDO SQL
$query = mysqli_query($conexao, $sql);

if (mysqli_num_rows($query) > 0) {

  ?>

  <!-- PARA ATUALIZAR APENAS UMA PARTE DO SITE QUE NO CASO SERIA A TABELA CRIA UM NIOVO ARQUIVO E COLA A TABLE INTEIRA AQUI -->

  <table class="table">

    <!-- CABEÇALHO DA TABELA -->
    <thead class="table-dark">
      <tr class="text-center">
        <th>ID</th>
        <th>Cargo</th>
        <th>Observação</th>
        <th>Status</th>
        <th>Data Cadastro</th>
        <th>Ações</th>
      </tr>
    </thead>

    <!-- CORPO DA TABELA: DADOS -->
    <tbody>

      <?php
      foreach ($query as $cargo) {
        ?>

        <!-- LINHA DA TABELA -->
        <tr class="text-center">
          <td><?php echo $cargo['codigo_cargo'] ?></td>

          <td><?php echo $cargo['nome'] ?></td>

          <td>
            <?php
            if ($cargo['observacao'] != '') {
              echo $cargo['observacao'];
            } else {
              echo '-';
            }
            ?>
          </td>

          <td>
            <?php
            if ($cargo['status'] == 1) {
              echo '<span class="badge rounded-pill text-bg-success">Ativo</span>';
            } else {
              echo '<span class="badge rounded-pill text-bg-danger">Inativo</span>';
            }
            ?>
          </td>

          <td><?php echo date('d/m/Y', strtotime($cargo['data_cadastro'])) ?></td>

          <td>
            <a href="Editar.php?codigo_cargo=<?php echo $cargo['codigo_cargo'] ?>" class="btn btn-outline-success btn-sm" title="Editar"><i class="bi bi-pencil"></i></a>

            <a href="Excluir.php" class="btn btn-outline-danger btn-sm" title="Excluir"><i class="bi bi-trash"></i></a>
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