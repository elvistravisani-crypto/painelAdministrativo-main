<?php 

  // conexao com o banco
  require_once __DIR__ . "../../../conexao/conecta.php";

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
  <link rel="stylesheet" href="../../custom/css/style.css">

  <!-- FAVICON -->
  <link rel="shortcut icon" href="../../assets/img/favicon.ico" type="image/x-icon">

  <!-- CSS -->
  <link rel="stylesheet" href="../../custom/css/style.css">


</head>

<body>
   
<!--<<<<<<<<<<<<<< INCLUDES >>>>>>>>>>>>> -->
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
<!--<<<<<<<<<<<<<< INCLUDES >>>>>>>>>>>>> -->


      <main class="ms-auto col-lg-10 px-md-4">
        <?php
        include('../Log.php');
        ?>

        <div class="card">

          <div class="card-header d-flex justify-content-between">
            <h4 class="m-0">Funcionários</h4>

            <a href="Inserir.php" class="btn btn-primary btn-sm">
              <i class="bi bi-plus"></i>

              Adicionar
            </a>

          </div>

          <!-- COLA O PHP DO SELECT AQUI -->

            <?php 
                // CODIGO SQL SO COM ID PARA NAO PESAR O SELECT PORQUE O SELECT QUE VALE PARA OS DADOS SERIA O DO ARQUIVO tabela.php
              $sql = "SELECT codigo_funcionario FROM funcionario";

              // A FUNÇÃO DO MYSQL_QUERY REALIZA A CONEXÃO COM O BANCO DE DADOS E EXECUTA O COMANDO SQL
              $query = mysqli_query($conexao, $sql);

              if(mysqli_num_rows($query) > 0)
                {
                
             
            ?>

          <div class="card-body">

            <div class="row pb-2">
              <!-- FILTRO POR STATUS -->
              <div class="col-2">
                <form action="">

                  <select name="sexo" id="sexo" class="form-control" onchange="buscar()">

                    <option value="">Sexo </option>
                    <option value="M">Masculino </option>
                    <option value="F">Feminino </option>
                    <option value="Não">Feminino </option>

                  </select>

                </form>

              </div>

               <div class="col-2">
                <form action="">

                  <select name="status" id="status" class="form-control"onchange="buscar()">

                    <option value="">Status </option>
                    <option value="1">Ativo </option>
                    <option value="0">Inativo </option>

                  </select>

                </form>

              </div>

                <div class="col-2">
                <form action="">

                  <select name="cargo" id="cargo" class="form-control"onchange="buscar()">

                    <option value="">Cargo </option>
                    <?php 

                      
                      $sql_cargo = "SELECT codigo_cargo, nome FROM cargo WHERE status = 1";

                      $query_cargo = mysqli_query($conexao, $sql_cargo);
                    
                      foreach($query_cargo as $cargo)
                        {
                          // CONCATENANDO O NOME COM VALOR
                         echo '<option value="'. $cargo['codigo_cargo'] .'">'.$cargo['nome'].'</option>';
                        }
                    ?>

                  </select>

                </form>

              </div>

                <div class="col-2">
                <form action="">

                  <select name="Cidade" id="Cidade" class="form-control"onchange="buscar()">

                    <option value="">Cidade </option>

                    <?php
                    
                    // TRAZER APENAS UMA VEZ A CIDADE
                    $sql = "SELECT DISTINCT cidade FROM funcionario";

                    $query_cidade = mysqli_query($conexao, $sql);

                    foreach($query_cidade as $cidade)
                      {
                        echo '<option value="'.$cidade['cidade'].'">'.$cidade['cidade'].'</option>';
                      }

                    ?>

                    

                  </select>

                </form>

              </div>

              <!-- BUSCA POR NOME -->
              <div class="col-4">

                <form action="">

                  <!-- TIPO SEARCH SO DE DA ENTER ELE ENTENDE QUE PRECISA FAZER UMA BUSCA, E NAO VAI PRECISAR DE UM BOTÃO -->
                  <input type="search" name="pesquisa" id="pesquisa" class="form-control" placeholder="Nome do Funcionário">
                </form>

              </div>

            </div>

          </div>

          <div class="card-body p-0">
           <!-- ONDE VAI APARECER A TABELA -->
            <div id="tabela"></div>

          </div>

            <?php 
                }
                else
                  {
              echo '<div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert">
                    Nenhum registro encontrado
                  </div>
                </div>';
                  }

            ?>

        </div>

      </main>

    </div>

  </div>

  <!-- fechar a conexão do banco -->
 <?php mysqli_close($conexao)?>

  <!-- JQUERY CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

  <!-- FILTROS -->
   <script>

      //FUNÇÃO PARA LISTAR OS FUNCIONARIOS
      function listar(sexo, status, cargo, cidade, nome)
      {   
          // PEGA O ELEMENTO QUE TEM O ID TABELA E COLOCA O RESULTADO DO AJAX DENTRO DELE
          $.ajax({
              url: 'tabela.php',
              method: "POST",
              data: {
                  sexo: sexo,
                  status: status,
                  cargo: cargo,
                  cidade: cidade,
                  pesquisa: nome
              },
              success: function(resultado) {
                  $('#tabela').html(resultado);
              }
          });

      } 

 $(document).ready(function(){
  listar();
 })

/* FUNÇÃO PARA REALIZAR A BUSCA PELOS FUNCIONÁRIOS */
      function buscar()
      {
        let sexo = $('#sexo').val();
        let status = $('#status').val();
        let cargo = $('#cargo').val();
        let cidade = $('#cidade').val();

        listar(sexo, status, cargo, cidade);


      }
      
   </script>

</body>

</html>