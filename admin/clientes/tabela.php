<?php

// O dir e para meio que retornar onde o arquivo esta dentro, require once ele tenta a conexão apenas uma vez
require_once __DIR__ . "/../../conexao/conecta.php";

/* FILTROS */
$sexo = $_POST['sexo'];
$status = $_POST['status'];
$cidade = $_POST['cidade'];

/* COMPO DE BUSCA */
$nome = mysqli_real_escape_string($conexao, $_POST['pesquisa']);

// CODIGO SQL
$sql = "SELECT cliente.codigo_cliente, cliente.nome, cliente.nome_social, cliente.cidade, cliente.data_cadastro, cliente.status
FROM cliente 
WHERE 1=1";
/* FILTRO POR SEXO */
if (!empty($sexo)) {
  $sql .= " AND cliente.sexo = '$sexo'";
}
/* FILTRO POR STATUS */
if ($status != '') {
  $sql .= " AND cliente.status = $status";
}
/* FILTRO POR CIDADE */
if (!empty($cidade)) {
  $sql .= " AND cliente.cidade = '$cidade'";
}

if (!empty($nome)) {
  $sql .= " AND (IF(cliente.nome_social != '', cliente.nome_social, cliente.nome)) LIKE '%$nome%'";
}


// A FUNÇÃO DO MYSQL_QUERY REALIZA A CONEXÃO COM O BANCO DE DADOS E EXECUTA O COMANDO SQL
$query = mysqli_query($conexao, $sql);

if (mysqli_num_rows($query) > 0) {


  ?>


  <!-- PARA ATUALIZAR APENAS UMA PARTE DO SITE QUE NO CASO SERIA A TABELA CRIA UM NIOVO ARQUIVO E COLA A TABLE INTEIRA AQUI -->

  <table class="table">

    <!-- CABEÇALHO DA TABELA -->
    <thead class="table-dark">
      <!-- TABLE ROW: LINHA DA TABELA -->
      <tr class="text-center">
        <!-- TABLE HEAD: TITULO DA COLUNA -->
        <th>ID</th>
        <th>Nome</th>
        <th>Nome Social</th>
        <th>Cidade</th>
        <th>Data Cadastro</th>
        <th>Status</th>
        <th>Ações</th>
      </tr>

    </thead>
    <!-- CORPO DA TABELA: DADOS -->
    <tbody>

      <?php
      foreach ($query as $cliente) {


        ?>

        <!-- LINHA DA TABELA -->
        <tr class="text-center  ">
          <!-- TABLE DATA: DADOS DA TABELA -->
          <td><?php echo $cliente['codigo_cliente'] ?></td>

          <td><?php echo $cliente['nome'] ?></td>

          <!-- FAZER UM IF ELSE CASO TENHA NOME SOCIAL -->
          <td>
            <?php
            if ($cliente['nome_social'] != '') {
              echo $cliente['nome_social'];
            } else {
              echo '-';
            }
            ?>
          </td>

          <td><?php echo $cliente['cidade'] ?></td>
          <td><?php echo date('d/m/Y', strtotime($cliente['data_cadastro'])) ?></td>
          <td><?php
          if ($cliente['status'] == 1) {
            echo '<span class="badge rounded-pill text-bg-success">Ativo</span>';
          } else {
            echo '<span class="badge rounded-pill text-bg-danger">Inativo</span>';
          }
          ?>
          </td>
          <td>

            <a href="editar.php?codigo_cliente=<?php echo $cliente['codigo_cliente']?>" class="btn btn-outline-success btn-sm" title="Editar"><i class="bi bi-pencil"></i></a>

          <!--   <a href="excluir.php" class="btn btn-outline-danger btn-sm" title="Excluir"><i class="bi bi-trash"></i></a> -->

           <form action="Acoes.php" method="post" class="d-inline">
                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Excluir" name="deletar_cliente" value="<?php echo $cliente['codigo_cliente']?>" onclick="return confirm('Tem certaza que deseja excluir?')">
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