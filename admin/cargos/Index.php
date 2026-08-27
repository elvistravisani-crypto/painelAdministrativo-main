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
        //Boas-vindas mostrando o usuário que esta logado
        include('../Log.php');

        // Mensagem de erro ou sucesso
        include('../Mensagem.php');
        ?>

        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4 class="m-0">Cargos</h4>

            <a href="inserir.php" class="btn btn-primary btn-sm">
              <i class="bi bi-plus"></i>

              Adicionar
            </a>
          </div>

          <!-- CODIGO SQL SO COM ID PARA NAO PESAR O SELECT PORQUE O SELECT QUE VALE PARA OS DADOS SERIA O DO ARQUIVO tabela.php -->
          <?php

          $sql_cargo = "SELECT codigo_cargo FROM cargo";

          $query_cargo = mysqli_query($conexao, $sql_cargo);

          if (mysqli_num_rows($query_cargo) > 0) {

          ?>

            <div class="card-body">
              <div class="row">
                <!-- FILTRO POR STATUS -->
                <div class="col-2">
                  <form action="">
                    <select name="status" id="status" class="form-control" onchange="buscar()">
                      <option value="">Status</option>
                      <option value="1">Ativo</option>
                      <option value="0">Inativo</option>
                    </select>
                  </form>
                </div>

                <!-- CAMPO DE BUSCA POR NOME DO CARGO -->
                <div class="col-4">
                  <form action="">
                    <input type="search" name="pesquisa" id="pesquisa" class="form-control" placeholder="Pesquise por cargo...">
                  </form>
                </div>
              </div>
            </div>

            <div class="card-body p-0">
              <!-- ONDE VAI APARECER A TABELA -->
              <div id="tabela"></div>
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
  <?php mysqli_close($conexao)?>
  <!-- JQUERY CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

  <!-- FILTROS -->
  <script>

    //FUNÇÃO PARA LISTAR OS CARGOS
    function listar(status, nome)
    {
        // PEGA O ELEMENTO QUE TEM O ID TABELA E COLOCA O RESULTADO DO AJAX DENTRO DELE
        $.ajax({
            url: 'tabela.php',
            method: "POST",
            data: {
                status: status,
                pesquisa: nome
            },
            success: function(resultado) {
                $('#tabela').html(resultado);
            }
        });

    }
    /* EXECUTAR AS FUNÇÕES AO CARREGAR A PÁGINA */
    $(document).ready(function(){
      listar(); /* CARREGAR A TABELA */

      /* FUNÇÃO PARA PESQUISAR PELO NOME */
      $('#pesquisa').keyup(function(){
        let pesquisa = $(this).val();

        listar('', pesquisa);
      })

    })

    /* FUNÇÃO PARA REALIZAR A BUSCA PELOS CARGOS */
    function buscar()
    {
      let status = $('#status').val();

      listar(status);
    }

  </script>

</body>

</html>