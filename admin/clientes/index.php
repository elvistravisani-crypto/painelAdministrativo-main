<?php
/* CONEXÃO COM O BANCO DE DADOS */
require_once __DIR__ . "/../../conexao/conecta.php";
# INICIANDO A SESSÃO #
  if (!isset($_SESSION))
    {
      session_start();
    }

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>PAINEL ADMINISTRATIVO</title>

  <!-- BOOTSTRAP CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <!-- BOOTSTRAP ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <!-- CUSTOMIZAÇÃO DO TEMPLATE -->
  <link rel="stylesheet" href="../../assets/css/dashboard.min.css">
  <link rel="stylesheet" href="../../assets/css/styles.min.css">

  <!-- FAVICON -->
  <link rel="shortcut icon" href="../../assets/img/favicon.ico" type="image/x-icon">


</head>

<body>

  <?php
  #Início TOPO
  include('../Topo.php');
  #Final TOPO
  ?>

  <div class="container-fluid">
    <div class="row">
      <?php
      #Início MENU
      include('../Navegacao.php');
      #Final MENU
      ?>

      <main class="ms-auto col-lg-10 px-md-4">
        <?php
        include('../Log.php');
        ?>

        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4 class="m-0">Clientes</h4>

            <a href="inserir.php" class="btn btn-primary btn-sm">
              <i class="bi bi-plus"></i>

              Adicionar
            </a>
          </div>

          <?php

          $sql = "SELECT codigo_cliente, nome, email, telefone, status, data_nascimento FROM cliente";

          $query = mysqli_query($conexao, $sql);

          if (mysqli_num_rows($query) > 0) {

          ?>

            <div class="card-body">
              <div class="row">
                <!-- FILTRO POR STATUS -->
                <div class="col-2">
                  <form action="">
                    <select name="status" id="status" class="form-control">
                      <option value="">Status</option>
                      <option value="1">Ativo</option>
                      <option value="0">Inativo</option>
                    </select>
                  </form>
                </div>

                <!-- CAMPO DE BUSCA POR NOME -->
                <div class="col-4">
                  <form action="">
                    <input type="search" name="pesquisa" id="pesquisa" class="form-control" placeholder="Pesquise por nome...">
                  </form>
                </div>
              </div>
            </div>

            <div class="card-body">
              <!-- Tabela -->
              <table class="table">
                <!-- Cabeçalho da Tabela -->
                <thead class="table-dark">
                  <!-- Table Row: Linha da Tabela -->
                  <tr>
                    <!-- Table Head: Título da Coluna -->
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Status</th>
                    <th>Data nascimento</th>
                    <th>Ações</th>
                  </tr>
                </thead>

                <!-- Corpo da Tabela -->
                <tbody>
                  <?php foreach ($query as $cliente) { ?>

                    <!-- Linha da Tabela -->
                    <tr>
                      <!-- Table Data: Dados da Tabela -->
                      <td><?php echo $cliente['codigo_cliente'] ?></td>

                      <td><?php echo $cliente['nome'] ?></td>

                      <td><?php echo $cliente['email'] ?></td>

                      <td><?php echo $cliente['telefone'] ?></td>

                      <!-- Status -->
                      <td>
                        <?php
                        if ($cliente['status'] == 1) {
                          echo '<span class="badge rounded-pill text-bg-success">Ativo</span>';
                        } else {
                          echo '<span class="badge rounded-pill text-bg-danger">Inativo</span>';
                        }
                        ?>
                      </td>

                      <!-- data -->
                      <td>
                        <?php echo date('d/m/Y', strtotime($cliente['data_nascimento'])) ?>
                      </td>

                      <td>
                        <a href="Editar.php" class="btn btn-outline-success btn-sm" title="Editar">
                          <i class="bi bi-pencil"></i>
                        </a>

                        <a href="Excluir.php" class="btn btn-outline-danger btn-sm" title="Excluir">
                          <i class="bi bi-trash"></i>
                        </a>
                      </td>
                    </tr>

                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php
          } else {
              echo '<div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert">
                    Nenhum registro encontrado
                  </div>';
          }
          ?>

        </div>
      </main>
    </div>
  </div>

  <!-- FECHANDO A CONEXÃO COM O BANCO DE DADOS -->
  <?php mysqli_close($conexao) ?>
  <!-- JQUERY CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>