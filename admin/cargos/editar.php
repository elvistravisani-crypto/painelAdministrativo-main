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
          include('../mensagem.php'); /* adicionar mensagem */
          //VERIFICANDO SE CHEGOU CODIGO DO CARGO NA URL
          if (isset($_GET['codigo_cargo']) && $_GET['codigo_cargo'] != '')

            {

          $codigo = $_GET['codigo_cargo'];

          $sql = "SELECT * FROM cargo WHERE codigo_cargo = $codigo";
          $query = mysqli_query($conexao, $sql);
          $cargo = mysqli_fetch_assoc($query);
        ?>

        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4 class="m-0">Editar Cargo</h4>

            <a href="Index.php" class="btn btn-primary btn-sm">
              <i class="bi bi-arrow-left-short"></i>

              Voltar
            </a>
          </div>

          <div class="card-body">
            <form action="acoes.php" method="post">
              <div class="row">
                <div class="col-6">
                  <label for="cargo"><strong class="text-danger">*</strong>Cargo: </label>
                  <input type="text" name="cargo" id="cargo" class="form-control" maxlength="40" value="<?php echo $cargo['nome'] ?>" required>
                </div>

                <div class="col-6">
                  <label for="status">Status: </label>
                  <select name="status" id="status" class="form-control" >
                    <option value="1" <?php if ($cargo['status'] == '1') echo 'selected'?>>Ativo</option>
                    <option value="0" <?php if ($cargo['status'] == '0') echo 'selected'?>>Inativo</option>
                  </select>
                </div>

                <div class="col-12 mt-2">
                  <label for="observacao">Observação: </label>
                  <textarea name="observacao" id="observacao" class="form-control" maxlength="100"><?php echo $cargo['observacao']?></textarea>

                  <input type="hidden" name="editar" value="editar_cargo">
                  <input type="hidden" name="codigo_cargo" value="<?php echo $codigo ?>">

                  <input type="submit" value="Atualizar" class="btn btn-primary mt-3 px-5">
                </div>
              </div>
            </form>
          </div>
        </div>

        <?php 
           }
           else
            {
              echo 'Nenhum cargo encontrado';
            }
        ?>
      </main>
    </div>
  </div>
  
  <!-- JQUERY CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>