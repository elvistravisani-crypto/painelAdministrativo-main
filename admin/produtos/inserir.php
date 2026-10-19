<?php

# CONEXÃO COM O BANCO#

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
                include('../mensagem.php');
                ?>

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="m-0">Novo Produto</h4>

                        <a href="Index.php" class="btn btn-primary btn-sm">
                            <i class="bi bi-arrow-left-short"></i>

                            Voltar
                        </a>
                    </div>

                    <div class="card-body">
                        <form action="acoes.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <!-- Nome -->
                                <div class="col-6 mb-3">
                                    <label for="nome"><strong class="text-danger">*</strong>Nome: </label>
                                    <input type="text" name="nome" id="nome" class="form-control" maxlength="50"
                                        required>
                                </div>

                                <!-- Categoria -->
                                <div class="col-3 mb-3">
                                    <label for="codigo_categoria">Categoria: </label>
                                    <select name="codigo_categoria" id="codigo_categoria" class="form-control" required>
                                        <option value="">Selecione</option>
                                        <?php

                                        $sql_categoria = "SELECT codigo_categoria, nome FROM categoria WHERE status = 1";

                                        $query_categoria = mysqli_query($conexao, $sql_categoria);

                                        foreach ($query_categoria as $categoria) {
                                            echo '<option value="' . $categoria['codigo_categoria'] . '">' . $categoria['nome'] . '</option>';
                                        }

                                        ?>
                                    </select>
                                </div>

                                <!-- Marca -->
                                <div class="col-3 mb-3">
                                    <label for="codigo_marca">Marca: </label>
                                    <select name="codigo_marca" id="codigo_marca" class="form-control" required>
                                        <option value="">Selecione</option>
                                        <?php

                                        $sql_marca = "SELECT codigo_marca, nome FROM marca WHERE status = 1";

                                        $query_marca = mysqli_query($conexao, $sql_marca);

                                        foreach ($query_marca as $marca) {
                                            echo '<option value="' . $marca['codigo_marca'] . '">' . $marca['nome'] . '</option>';
                                        }

                                        ?>
                                    </select>
                                </div>

                                <!-- Valor faturamento -->
                                <div class="col-3 mb-3">
                                    <label for="valor_faturamento"><strong class="text-danger">*</strong>Valor Faturamento: </label>
                                    <input type="text" name="valor_faturamento" id="valor_faturamento" class="form-control" data-mask="00000,00" data-mask-reverse="true" required>
                                </div>

                                <!-- Preço produto -->
                                <div class="col-3 mb-3">
                                    <label for="preco_produto"><strong class="text-danger">*</strong>Preço Produto: </label>
                                    <input type="text" name="preco_produto" id="preco_produto" class="form-control" data-mask="00000,00" data-mask-reverse="true" required>
                                </div>

                                <!-- Valor lucro -->
                                <div class="col-3 mb-3">
                                    <label for="valor_lucro">Valor Lucro: </label>
                                    <input type="text" name="valor_lucro" id="valor_lucro" class="form-control" data-mask="00000,00" data-mask-reverse="true">
                                </div>

                                <!-- Valor desconto -->
                                <div class="col-3 mb-3">
                                    <label for="valor_desconto">Valor Desconto: </label>
                                    <input type="text" name="valor_desconto" id="valor_desconto" class="form-control" data-mask="00000,00" data-mask-reverse="true">
                                </div>

                                <!-- Status -->
                                <div class="col-3 mb-3">
                                    <label for="status"><strong class="text-danger">*</strong>Status: </label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="1">Ativo</option>
                                        <option value="0">Inativo</option>
                                    </select>
                                </div>

                                <!-- Descrição -->
                                <div class="col-9 mb-3">
                                    <label for="descricao">Descrição: </label>
                                    <input type="text" name="descricao" id="descricao" class="form-control" maxlength="150">
                                </div>

                                <!-- Foto 1 -->
                                <div class="col-4 mb-3">
                                    <label for="ft_produto_1" class="form-label small">Foto do Produto 1</label>
                                    <input type="file" name="ft_produto_1" id="ft_produto_1" class="form-control" accept="image/*">
                                </div>

                                <!-- Foto 2 -->
                                <div class="col-4 mb-3">
                                    <label for="ft_produto_2" class="form-label small">Foto do Produto 2</label>
                                    <input type="file" name="ft_produto_2" id="ft_produto_2" class="form-control" accept="image/*">
                                </div>

                                <!-- Foto 3 -->
                                <div class="col-4 mb-3">
                                    <label for="ft_produto_3" class="form-label small">Foto do Produto 3</label>
                                    <input type="file" name="ft_produto_3" id="ft_produto_3" class="form-control" accept="image/*">
                                </div>

                                <input type="hidden" name="cadastrar" value="cadastrar_produto">

                                <input type="submit" value="Cadastrar" class="btn btn-primary mt-3 px-5">
                            </div>

                        </form>
                    </div>
                </div>
        </div>
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
    <!-- JQUERY MASK -->
    <script src="../../custom/js/jquery.mask.min.js"></script>
</body>

</html>