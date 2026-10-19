<?php

#  CONEXÃO COM O BANCO#

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

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
                include('../mensagem.php');

                if (isset($_GET['codigo_marca']) && $_GET['codigo_marca'] != '')
                    {

                    $codigo = (int) $_GET['codigo_marca'];

                    $sql = "SELECT * FROM marca WHERE codigo_marca = $codigo";
                    $query = mysqli_query($conexao, $sql);
                    $marca = mysqli_fetch_assoc($query);

                    if ($marca)
                        {

                ?>

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="m-0">Editar Marca</h4>

                        <a href="index.php" class="btn btn-primary btn-sm">
                            <i class="bi bi-arrow-left-short"></i>

                            Voltar
                        </a>
                    </div>

                    <div class="card-body">
                        <form action="acoes.php" method="post">
                            <div class="row">
                                <!-- Nome -->
                                <div class="col-5 mb-3">
                                    <label for="nome"><strong class="text-danger">*</strong>Nome: </label>
                                    <input type="text" name="nome" id="nome" class="form-control" maxlength="50" value="<?php echo $marca['nome'] ?>"
                                        required>
                                </div>

                                <!-- Descrição -->
                                <div class="col-5 mb-3">
                                    <label for="descricao">Descrição: </label>
                                    <input type="text" name="descricao" id="descricao" class="form-control"
                                        maxlength="60" value="<?php echo $marca['descricao'] ?>">
                                </div>

                                <!-- Status -->
                                <div class="col-2 mb-3">
                                    <label for="status"><strong class="text-danger">*</strong>Status: </label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="1" <?php if ($marca['status'] == '1') echo 'selected' ?>>Ativo</option>
                                        <option value="0" <?php if ($marca['status'] == '0') echo 'selected' ?>>Inativo</option>
                                    </select>
                                </div>


                                <input type="hidden" name="editar" value="editar_marca">
                                <input type="hidden" name="codigo_marca" value="<?php echo $codigo ?>">

                                <input type="submit" value="Atualizar" class="btn btn-primary mt-3 px-5">
                            </div>

                        </form>
                    </div>
                </div>
                <?php
                        }
                    else
                        {
                            echo 'Nenhuma marca encontrada!';
                        }
                    }
                    else
                        {
                            echo 'Nenhuma marca encontrada!';
                        }
                ?>

            </main>
        </div>
    </div>
    <!-- JQUERY CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>