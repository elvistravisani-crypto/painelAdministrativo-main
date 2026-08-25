<?php

// O dir e para meio que retornar onde o arquivo esta dentro, require once ele tenta a conexão apenas uma vez
require_once __DIR__ . "/../../conexao/conecta.php";

/* FILTROS */
$sexo = $_POST['sexo'];
$status = $_POST['status'];
$cargo = $_POST['cargo'];
$cidade = $_POST['cidade'];

/* COMPO DE BUSCA */
$nome = mysqli_real_escape_string($conexao, $_POST['pesquisa']);

// CODIGO SQL
$sql = "SELECT funcionario.codigo_funcionario, funcionario.foto,funcionario.nome, funcionario.nome_social, cargo.nome 'cargo', funcionario.data_cadastro, funcionario.status
FROM funcionario 
INNER JOIN cargo ON cargo.codigo_cargo = funcionario.codigo_cargo WHERE 1=1";
/* FILTRO POR SEXO */
if (!empty($sexo)) {
  $sql .= " AND funcionario.sexo = '$sexo'";
}
/* FILTRO POR STATUS */
if ($status != '') {
  $sql .= " AND funcionario.status = $status";
}
/* FILTRO POR CARGO */
if ($cargo != '') {
  $sql .= " AND funcionario.codigo_cargo = $cargo";
}
/* FILTRO POR CIDADE */
if (!empty($cidade)) {
  $sql .= " AND funcionario.cidade = '$cidade'";
}

if (!empty($nome)) {
  $sql .= " AND (IF(funcionario.nome_social != '', funcionario.nome_social, funcionario.nome)) LIKE '%$nome%'";
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
        <th>Foto</th>
        <th>Nome</th>
        <th>Nome Social</th>
        <th>Cargo</th>
        <th>Data Cadastro</th>
        <th>Status</th>
        <th>Ações</th>
      </tr>

    </thead>
    <!-- CORPO DA TABELA: DADOS -->
    <tbody>

      <?php
      foreach ($query as $funcionario) {


        ?>

        <!-- LINHA DA TABELA -->
        <tr class="text-center  ">
          <!-- TABLE DATA: DADOS DA TABELA -->
          <td><?php echo $funcionario['codigo_funcionario'] ?></td>

          <td>
            <?php

            if ($funcionario['foto'] != '') {
              echo '<img src="../../imagens/' . $funcionario['foto'] . '" alt="' . $funcionario['nome'] . '" class="img-funcionario">';
            } else {
              echo '<img src="../../assets/img/placeholder-funcionario.png" alt="' . $funcionario['nome'] . '" class="img-funcionario">';
            }
            ?>
          </td>

          <td><?php echo $funcionario['nome'] ?></td>

          <!-- FAZER UM IF ELSE CASO TENHA NOME SOCIAL -->
          <td>
            <?php
            if ($funcionario['nome_social'] != '') {
              echo $funcionario['nome_social'];
            } else {
              echo '-';
            }
            ?>
          </td>

          <!-- APELIDO PRO NOME CARGO -->
          <td><?php echo $funcionario['cargo'] ?></td>
          <td><?php echo date('d/m/Y', strtotime($funcionario['data_cadastro'])) ?></td>
          <td><?php
          if ($funcionario['status'] == 1) {
            echo '<span class="badge rounded-pill text-bg-success">Ativo</span>';
          } else {
            echo '<span class="badge rounded-pill text-bg-danger">Inativo</span>';
          }
          ?>
          </td>
          <td>

            <a href="editar.php?codigo_funcionario=<?php echo $funcionario['codigo_funcionario']?>" class="btn btn-outline-success btn-sm" title="Editar"><i class="bi bi-pencil"></i></a>

            <a href="excluir.php" class="btn btn-outline-danger btn-sm" title="Excluir"><i class="bi bi-trash"></i></a>

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