<?php

// 
require_once __DIR__ . "/../../conexao/conecta.php";

/* FILTROS */
$status = $_POST['status'];

/* COMPO DE BUSCA */
$nome = mysqli_real_escape_string($conexao, $_POST['pesquisa']);

// CODIGO SQL
$sql = "SELECT codigo_marca, nome, descricao, status, data_cadastro FROM marca WHERE 1=1";

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
        <th>Marcas</th>
        <th>Observação</th>
        <th>Status</th>
        <th>Data Cadastro</th>
        <th>Ações</th>
      </tr>
    </thead>

    <!-- CORPO DA TABELA: DADOS -->
    <tbody>

      <?php
      foreach ($query as $marca) {
        ?>

        <!-- LINHA DA TABELA -->
        <tr class="text-center">
          <td><?php echo $marca['codigo_marca'] ?></td>

          <td><?php echo $marca['nome'] ?></td>

          <td>
            <?php
            if ($marca['observacao'] != '') {
              echo $marca['observacao'];
            } else {
              echo '-';
            }
            ?>
          </td>

          <td>
            <?php
            if ($marca['status'] == 1) {
              echo '<span class="badge rounded-pill text-bg-success">Ativo</span>';
            } else {
              echo '<span class="badge rounded-pill text-bg-danger">Inativo</span>';
            }
            ?>
          </td>

          <td><?php echo date('d/m/Y', strtotime($marca['data_cadastro'])) ?></td>

          <td>
            <a href="Editar.php?codigo_marca=<?php echo $marca['codigo_marca'] ?>" class="btn btn-outline-success btn-sm" title="Editar"><i class="bi bi-pencil"></i></a>

           <!-- <a href="Excluir.php" class="btn btn-outline-danger btn-sm" title="Excluir">
                    <i class="bi bi-trash"></i>
                  </a> -->
                  <form action="Acoes.php" method="post" class="d-inline">
                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Excluir" name="deletar_marca" value="<?php echo $marca['codigo_marca']?>" onclick="return confirm('Tem certaza que deseja excluir?')">
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