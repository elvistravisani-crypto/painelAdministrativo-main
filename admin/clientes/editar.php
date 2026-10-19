<?php

#  CONEXÃO COM O BANCO#

require_once __DIR__ . "/../../conexao/conecta.php";
# VERIFICANDO SE EXISTE  USUÁRIO LOGADO PARA PERMITIR ACESSO #
include_once __DIR__ . "/../usuario_comum.php";




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

                if (isset($_GET['codigo_cliente']) && $_GET['codigo_cliente'] != '')
                    {

                    $codigo = $_GET['codigo_cliente'];

                    $sql = "SELECT * FROM cliente WHERE codigo_cliente = $codigo";
                    $query = mysqli_query($conexao, $sql);
                    $cliente = mysqli_fetch_assoc($query);

                
                ?>

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="m-0">Editar Cliente</h4>

                        <a href="Index.php" class="btn btn-primary btn-sm">
                            <i class="bi bi-arrow-left-short"></i>

                            Voltar
                        </a>
                    </div>

                    <div class="card-body">
                        <form action="acoes.php" method="post">
                            <div class="row">
                                <!-- Nome -->
                                <div class="col-6 mb-3">
                                    <label for="nome"><strong class="text-danger">*</strong>Nome: </label>
                                    <input type="text" name="nome" id="nome" class="form-control" maxlength="50" value="<?php echo $cliente['nome'] ?>"
                                        required>
                                </div>

                                <!-- Nome Social -->
                                <div class="col-6 mb-3">
                                    <label for="nome_social">Nome Social: </label>
                                    <input type="text" name="nome_social" id="nome_social" class="form-control"
                                        maxlength="60" value="<?php echo $cliente['nome_social'] ?>" >
                                </div>

                                <!-- Cpf -->
                                <div class="col-3 mb-3">
                                    <label for="cpf"><strong class="text-danger">*</strong>Cpf</label>
                                    <input type="text" name="cpf" id="cpf" class="form-control" maxlength="14" data-mask="000.000.000-00" value="<?php echo $cliente['cpf'] ?>" required>
                                </div>

                                <!-- Data de nascimento -->
                                <div class="col-3 mb-3">
                                    <label for="data_nascimento"><strong class="text-danger">*</strong>Data de
                                        nascimento</label>
                                    <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="<?php echo $cliente['data_nascimento'] ?>"
                                        required>
                                </div>

                                <!-- Sexo -->
                                <div class="col-3 mb-3">
                                    <label for="sexo"><strong class="text-danger">*</strong>Sexo: </label>
                                    <select name="sexo" id="sexo" class="form-control" required>
                                        <option value="M" <?php if ($cliente['sexo'] == 'M') echo 'selected' ?>>Masculino</option>
                                        <option value="F" <?php if ($cliente['sexo'] == 'F') echo 'selected' ?>>Feminino</option>
                                        <option value="N" <?php if ($cliente['sexo'] == 'N') echo 'selected' ?>>Não informado</option>
                                    </select>
                                </div>

                                <!-- Telefone celular -->
                                <div class="col-3 mb-3">
                                    <label for="telefone_celular">Telefone celular: </label>
                                    <input type="text" name="telefone_celular" id="telefone_celular"
                                        class="form-control" maxlength="14" data-mask="(00)00000-0000" value="<?php echo $cliente['telefone'] ?>">
                                </div>
                                

                                <!-- Email -->
                                <div class="col-6 mb-3">
                                    <label for="email"><strong class="text-danger">*</strong>Email: </label>
                                    <input type="email" name="email" id="email" class="form-control" maxlength="50" value="<?php echo $cliente['email'] ?>"
                                        required>
                                </div>

                                <!-- Senha -->
                                <div class="col-4 mb-3">
                                    <label for="senha"><strong class="text-danger">*</strong>Senha: </label>
                                    <input type="password" name="senha" id="senha" class="form-control" maxlength="8" value="<?php echo $cliente['senha'] ?>"
                                        required>
                                </div>

                                <!-- Status -->
                                <div class="col-2 mb-3">
                                    <label for="status"><strong class="text-danger">*</strong>Status: </label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="1"<?php if ($cliente['status'] == '1') echo 'selected' ?> >Ativo</option>
                                        <option value="0"<?php if ($cliente['status'] == '0') echo 'selected' ?> >Inativo</option>
                                    </select>
                                </div>

                                 <!-- Cep -->
                                <div class="col-3 mb-3">
                                    <label for="cep"><strong class="text-danger">*</strong>Cep: </label>
                                    <input type="text" name="cep" id="cep" class="form-control" maxlength="9" data-mask="00000-000" value="<?php echo $cliente['cep'] ?>" required>
                                </div>

                                <!-- Endereço -->
                                <div class="col-5 mb-3">
                                    <label for="endereco"><strong class="text-danger">*</strong>Endereço: </label>
                                    <input type="text" name="endereco" id="endereco" class="form-control" maxlength="70" value="<?php echo $cliente['endereco'] ?>"
                                        required>
                                </div>

                                <!-- Número -->
                                <div class="col-1 mb-3">
                                    <label for="numero"><strong class="text-danger">*</strong>Número: </label>
                                    <input type="number" name="numero" id="numero" class="form-control" value="<?php echo $cliente['numero'] ?>" required>
                                </div>

                                <!-- Complemento -->
                                <div class="col-3 mb-3">
                                    <label for="complemento">Complemento: </label>
                                    <input type="text" name="complemento" id="complemento" class="form-control"
                                        maxlength="40" value="<?php echo $cliente['complemento'] ?>">
                                </div>

                                <!-- Bairro -->
                                <div class="col-3 mb-3">
                                    <label for="bairro"><strong class="text-danger">*</strong>Bairro: </label>
                                    <input type="text" name="bairro" id="bairro" class="form-control" maxlength="30" value="<?php echo $cliente['bairro'] ?>"
                                        required>
                                </div>

                                <!-- Cidade -->
                                <div class="col-4 mb-3">
                                    <label for="cidade"><strong class="text-danger">*</strong>Cidade: </label>
                                    <input type="text" name="cidade" id="cidade" class="form-control" maxlength="40" value="<?php echo $cliente['cidade'] ?>"
                                        required>
                                </div>

                                <!-- Estado -->
                                <div class="col-1 mb-3">
                                    <label for="estado"><strong class="text-danger">*</strong>UF: </label>
                                    <select name="estado" id="estado" class="form-control" required>
                                        <option value="SP" <?php if($cliente['estado'] == 'SP') echo 'selected' ?>> SP</option>
                                        <option value="AL" <?php if($cliente['estado'] == 'AL') echo 'selected' ?>> AL</option>
                                        <option value="AP" <?php if($cliente['estado'] == 'AP') echo 'selected' ?>> AP</option>
                                        <option value="AM" <?php if($cliente['estado'] == 'AM') echo 'selected' ?>> AM</option>
                                        <option value="BA" <?php if($cliente['estado'] == 'BA') echo 'selected' ?>> BA</option>
                                        <option value="CE" <?php if($cliente['estado'] == 'CE') echo 'selected' ?>> CE</option>
                                        <option value="DF" <?php if($cliente['estado'] == 'DF') echo 'selected' ?>> DF</option>
                                        <option value="ES" <?php if($cliente['estado'] == 'ES') echo 'selected' ?>> ES</option>
                                        <option value="GO" <?php if($cliente['estado'] == 'GO') echo 'selected' ?>> GO</option>
                                        <option value="MA" <?php if($cliente['estado'] == 'MA') echo 'selected' ?>> MA</option>
                                        <option value="MT" <?php if($cliente['estado'] == 'MT') echo 'selected' ?>> MT</option>
                                        <option value="MS" <?php if($cliente['estado'] == 'MS') echo 'selected' ?>> MS</option>
                                        <option value="MG" <?php if($cliente['estado'] == 'MG') echo 'selected' ?>> MG</option>
                                        <option value="PA" <?php if($cliente['estado'] == 'PA') echo 'selected' ?>> PA</option>
                                        <option value="PB" <?php if($cliente['estado'] == 'PB') echo 'selected' ?>> PB</option>
                                        <option value="PR" <?php if($cliente['estado'] == 'PR') echo 'selected' ?>> PR</option>
                                        <option value="PE" <?php if($cliente['estado'] == 'PE') echo 'selected' ?>> PE</option>
                                        <option value="PI" <?php if($cliente['estado'] == 'PI') echo 'selected' ?>> PI</option>
                                        <option value="RJ" <?php if($cliente['estado'] == 'RJ') echo 'selected' ?>> RJ</option>
                                        <option value="RN" <?php if($cliente['estado'] == 'RN') echo 'selected' ?>> RN</option>
                                        <option value="RS" <?php if($cliente['estado'] == 'RS') echo 'selected' ?>> RS</option>
                                        <option value="RO" <?php if($cliente['estado'] == 'RO') echo 'selected' ?>> RO</option>
                                        <option value="RR" <?php if($cliente['estado'] == 'RR') echo 'selected' ?>> RR</option>
                                        <option value="SC" <?php if($cliente['estado'] == 'SC') echo 'selected' ?>> SC</option>
                                        <option value="AC" <?php if($cliente['estado'] == 'AC') echo 'selected' ?>> AC</option>
                                        <option value="SE" <?php if($cliente['estado'] == 'SE') echo 'selected' ?>> SE</option>
                                        <option value="TO" <?php if($cliente['estado'] == 'TO') echo 'selected' ?>> TO</option>
                                    </select>
                                </div>

                        

                                <input type="hidden" name="editar" value="editar_cliente">
                                <input type="hidden" name="codigo_cliente" value="<?php echo $codigo ?>">

                                <input type="submit" value="Atualizar" class="btn btn-primary mt-3 px-5">
                            </div>

                        </form>
                    </div>
                </div>
                <?php 
                    }
                    else
                        {
                            echo 'Nenhum cliente encontrado!';
                        }
                ?>

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
     <!-- busca cep -->
    <script src="../../custom/js/via-cep.js"></script>
</body>

</html>