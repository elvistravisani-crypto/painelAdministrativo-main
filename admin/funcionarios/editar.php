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

                if (isset($_GET['codigo_funcionario']) && $_GET['codigo_funcionario'] != '')
                    {

                    $codigo = $_GET['codigo_funcionario'];

                    $sql = "SELECT * FROM funcionario WHERE codigo_funcionario = $codigo";
                    $query = mysqli_query($conexao, $sql);
                    $funcionario = mysqli_fetch_assoc($query);

                
                ?>

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="m-0">Editar Funcionário</h4>

                        <a href="Index.php" class="btn btn-primary btn-sm">
                            <i class="bi bi-arrow-left-short"></i>

                            Voltar
                        </a>
                    </div>

                    <div class="card-body">
                        <form action="acoes.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <!-- Nome -->
                                <div class="col-5 mb-3">
                                    <label for="nome"><strong class="text-danger">*</strong>Nome: </label>
                                    <input type="text" name="nome" id="nome" class="form-control" maxlength="40" value="<?php echo $funcionario['nome'] ?>"
                                        required>
                                </div>
                                <!-- Nome Social -->
                                <div class="col-5 mb-3">
                                    <label for="nome_social">Nome Social: </label>
                                    <input type="text" name="nome_social" id="nome_social" class="form-control"
                                        maxlength="40" value="<?php echo $funcionario['nome_social'] ?>" >
                                </div>
                                <!-- Foto -->
                                <div class="col-md-2 mb-3 text-center">
                                    <!-- espaço para a foto -->
                                    <div class="foto_fun border rounded bg-light d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 100px; height: 100px;">
                                        <?php if ($funcionario['foto'] != '') { ?>
                                            <img src="../../imagens/<?php echo $funcionario['foto'] ?>" class="img-fluid rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                        <?php } else { ?>
                                            <i class="bi bi-person-fill text-secondary fs-1"></i>
                                        <?php } ?>
                                    </div>

                                    <!--  -->
                                    <label for="foto_funcionario" class="form-label small">Foto do Funcionário</label>
                                    <input type="file" name="foto_funcionario" id="foto_funcionario" class="form-control form-control" accept="image/*">
                                </div>
                                <!-- Data de nascimento -->
                                <div class="col-2 mb-3">
                                    <label for="data_nascimento"><strong class="text-danger">*</strong>Data de
                                        nascimento</label>
                                    <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="<?php echo $funcionario['data_nascimento'] ?>"
                                        required>
                                </div>
                                <!-- Sexo -->
                                <div class="col-1 mb-3">
                                    <label for="sexo"><strong class="text-danger">*</strong>Sexo: </label>
                                    <select name="sexo" id="sexo" class="form-control" required>
                                        <option value="M" <?php if ($funcionario['sexo'] == 'M') echo 'selected' ?>>Masculino</option>
                                        <option value="F" <?php if ($funcionario['sexo'] == 'F') echo 'selected' ?>>Feminino</option>
                                        <option value="N" <?php if ($funcionario['sexo'] == 'N') echo 'selected' ?>>Não informado</option>
                                    </select>
                                </div>
                                <!-- Estado civil -->
                                <div class="col-2 mb-3">
                                    <label for="estado_civil">Estado civil: </label>
                                    <select name="estado_civil" id="estado_civil" class="form-control">
                                        <option value="Casado(a)" <?php if ($funcionario['estado_civil'] == 'Casado(a)') echo 'selected' ?>>Casado(a)</option>
                                        <option value="Solteiro(a)" <?php if ($funcionario['estado_civil'] == 'Solteiro(a)') echo 'selected' ?>>Solteiro(a)</option>
                                        <option value="Divorciado(a)" <?php if ($funcionario['estado_civil'] == 'Divorciado(a)') echo 'selected' ?>>Divorciado(a)</option>
                                        <option value="Viuvo(a)" <?php if ($funcionario['estado_civil'] == 'Viuvo(a)') echo 'selected' ?>>Viuvo(a)</option>
                                        <option value="Separado(a)" <?php if ($funcionario['estado_civil'] == 'Separado(a)') echo 'selected' ?>>Separado(a)</option>
                                    </select>
                                </div>
                                <!-- Cpf -->
                                <div class="col-3 mb-3">
                                    <label for="cpf"><strong class="text-danger">*</strong>Cpf</label>
                                    <input type="text" name="cpf" id="cpf" class="form-control" maxlength="14" data-mask="000.000.000-00" value="<?php echo $funcionario['cpf'] ?>" required>
                                </div>

                                <!-- Rg -->
                                <div class="col-3 mb-3">
                                    <label for="rg">Rg</label>
                                    <input type="text" name="rg" id="rg" class="form-control" maxlength="12" data-mask="00.000.000-A" value="<?php echo $funcionario['rg'] ?>">
                                </div>
                                <!-- Telefone residencial -->
                                <div class="col-3 mb-3">
                                    <label for="telefone_residencial">Telefone residencial: </label>
                                    <input type="text" name="telefone_residencial" id="telefone_residencial"
                                        class="form-control" maxlength="13" data-mask="(00)0000-0000" value="<?php echo $funcionario['telefone_residencial'] ?>">
                                </div>

                                <!-- Telefone celular -->
                                <div class="col-3 mb-3">
                                    <label for="telefone_celular">Telefone celular: </label>
                                    <input type="text" name="telefone_celular" id="telefone_celular"
                                        class="form-control" maxlength="14" data-mask="(00)00000-0000" value="<?php echo $funcionario['telefone_celular'] ?>">
                                </div>
                                
                                <!-- Salário -->
                                <div class="col-2 mb-3">
                                    <label for="salario">Salário: </label>
                                    <input type="text" name="salario" id="salario" class="form-control" data-mask="00000,00" data-mask-reverse="true" value="<?php echo $funcionario['salario'] ?>">
                                </div>

                                <!-- Email -->
                                <div class="col-4 mb-3">
                                    <label for="email"><strong class="text-danger">*</strong>Email: </label>
                                    <input type="email" name="email" id="email" class="form-control" maxlength="50" value="<?php echo $funcionario['email'] ?>"
                                        required>
                                </div>

                                <!-- Usuário -->
                                <div class="col-3 mb-3">
                                    <label for="usuario"><strong class="text-danger">*</strong>Usuário: </label>
                                    <input type="text" name="usuario" id="usuario" class="form-control" maxlength="15" value="<?php echo $funcionario['usuario'] ?>"
                                        required>
                                </div>

                                <!-- Senha -->
                                <div class="col-3 mb-3">
                                    <label for="senha"><strong class="text-danger">*</strong>Senha: </label>
                                    <input type="password" name="senha" id="senha" class="form-control" maxlength="8" value="<?php echo $funcionario['senha'] ?>"
                                        required>
                                </div>

                                <!-- Tipo de acesso -->
                                <div class="col-2 mb-3">
                                    <label for="tipo_acesso"><strong class="text-danger">*</strong>Tipo de acesso:
                                    </label>
                                    <select name="tipo_acesso" id="tipo_acesso" class="form-control" required>
                                        <option value="1" <?php if ($funcionario['tipo_acesso'] == '1') echo 'selected' ?>>Administrador</option>
                                        <option value="0" <?php if ($funcionario['tipo_acesso'] == '0') echo 'selected' ?>>Comum</option>
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="col-2 mb-3">
                                    <label for="status"><strong class="text-danger">*</strong>Status: </label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="1"<?php if ($funcionario['status'] == '1') echo 'selected' ?> >Ativo</option>
                                        <option value="0"<?php if ($funcionario['status'] == '0') echo 'selected' ?> >Inativo</option>
                                    </select>
                                </div>

                                <!-- Cargo -->
                                <div class="col-3 mb-3">
                                    <label for="codigo_cargo">Cargo: </label>
                                    <select name="codigo_cargo" id="codigo_cargo" class="form-control" required>
                                        <option value="">Selecione</option>
                                        <?php

                                        $sql_cargo = "SELECT codigo_cargo, nome FROM cargo WHERE status = 1";

                                        $quere_cargo = mysqli_query($conexao, $sql_cargo);

                                        foreach ($quere_cargo as $cargo) {
                                            ?>

                                            <option value="<?php echo $cargo['codigo_cargo'] ?>" <?php if ($funcionario['codigo_cargo'] == $cargo['codigo_cargo']) echo 'selected'?>><?php echo $cargo['nome'] ?> </option>

                                            <?php
                                        }

                                        ?>




                                    </select>
                                </div>

                                 <!-- Cep -->
                                <div class="col-3 mb-3">
                                    <label for="cep"><strong class="text-danger">*</strong>Cep: </label>
                                    <input type="text" name="cep" id="cep" class="form-control" maxlength="9" data-mask="00000-000" value="<?php echo $funcionario['cep'] ?>" required>
                                </div>

                                <!-- Endereço -->
                                <div class="col-5 mb-3">
                                    <label for="endereco"><strong class="text-danger">*</strong>Endereço: </label>
                                    <input type="text" name="endereco" id="endereco" class="form-control" maxlength="70" value="<?php echo $funcionario['endereco'] ?>"
                                        required>
                                </div>

                                <!-- Número -->
                                <div class="col-1 mb-3">
                                    <label for="numero"><strong class="text-danger">*</strong>Número: </label>
                                    <input type="number" name="numero" id="numero" class="form-control" value="<?php echo $funcionario['numero'] ?>" required>
                                </div>

                                <!-- Complemento -->
                                <div class="col-3 mb-3">
                                    <label for="complemento">Complemento: </label>
                                    <input type="text" name="complemento" id="complemento" class="form-control"
                                        maxlength="40" value="<?php echo $funcionario['complemento'] ?>">
                                </div>

                                <!-- Bairro -->
                                <div class="col-3 mb-3">
                                    <label for="bairro"><strong class="text-danger">*</strong>Bairro: </label>
                                    <input type="text" name="bairro" id="bairro" class="form-control" maxlength="30" value="<?php echo $funcionario['bairro'] ?>"
                                        required>
                                </div>

                                <!-- Cidade -->
                                <div class="col-4 mb-3">
                                    <label for="cidade"><strong class="text-danger">*</strong>Cidade: </label>
                                    <input type="text" name="cidade" id="cidade" class="form-control" maxlength="40" value="<?php echo $funcionario['cidade'] ?>"
                                        required>
                                </div>

                                <!-- Estado -->
                                <div class="col-1 mb-3">
                                    <label for="estado"><strong class="text-danger">*</strong>UF: </label>
                                    <select name="estado" id="estado" class="form-control" required>
                                        <option value="SP" <?php if($funcionario['estado'] == 'SP') echo 'selected' ?>> SP</option>
                                        <option value="AL" <?php if($funcionario['estado'] == 'AL') echo 'selected' ?>> AL</option>
                                        <option value="AP" <?php if($funcionario['estado'] == 'AP') echo 'selected' ?>> AP</option>
                                        <option value="AM" <?php if($funcionario['estado'] == 'AM') echo 'selected' ?>> AM</option>
                                        <option value="BA" <?php if($funcionario['estado'] == 'BA') echo 'selected' ?>> BA</option>
                                        <option value="CE" <?php if($funcionario['estado'] == 'CE') echo 'selected' ?>> CE</option>
                                        <option value="DF" <?php if($funcionario['estado'] == 'DF') echo 'selected' ?>> DF</option>
                                        <option value="ES" <?php if($funcionario['estado'] == 'ES') echo 'selected' ?>> ES</option>
                                        <option value="GO" <?php if($funcionario['estado'] == 'GO') echo 'selected' ?>> GO</option>
                                        <option value="MA" <?php if($funcionario['estado'] == 'MA') echo 'selected' ?>> MA</option>
                                        <option value="MT" <?php if($funcionario['estado'] == 'MT') echo 'selected' ?>> MT</option>
                                        <option value="MS" <?php if($funcionario['estado'] == 'MS') echo 'selected' ?>> MS</option>
                                        <option value="MG" <?php if($funcionario['estado'] == 'MG') echo 'selected' ?>> MG</option>
                                        <option value="PA" <?php if($funcionario['estado'] == 'PA') echo 'selected' ?>> PA</option>
                                        <option value="PB" <?php if($funcionario['estado'] == 'PB') echo 'selected' ?>> PB</option>
                                        <option value="PR" <?php if($funcionario['estado'] == 'PR') echo 'selected' ?>> PR</option>
                                        <option value="PE" <?php if($funcionario['estado'] == 'PE') echo 'selected' ?>> PE</option>
                                        <option value="PI" <?php if($funcionario['estado'] == 'PI') echo 'selected' ?>> PI</option>
                                        <option value="RJ" <?php if($funcionario['estado'] == 'RJ') echo 'selected' ?>> RJ</option>
                                        <option value="RN" <?php if($funcionario['estado'] == 'RN') echo 'selected' ?>> RN</option>
                                        <option value="RS" <?php if($funcionario['estado'] == 'RS') echo 'selected' ?>> RS</option>
                                        <option value="RO" <?php if($funcionario['estado'] == 'RO') echo 'selected' ?>> RO</option>
                                        <option value="RR" <?php if($funcionario['estado'] == 'RR') echo 'selected' ?>> RR</option>
                                        <option value="SC" <?php if($funcionario['estado'] == 'SC') echo 'selected' ?>> SC</option>
                                        <option value="AC" <?php if($funcionario['estado'] == 'AC') echo 'selected' ?>> AC</option>
                                        <option value="SE" <?php if($funcionario['estado'] == 'SE') echo 'selected' ?>> SE</option>
                                        <option value="TO" <?php if($funcionario['estado'] == 'TO') echo 'selected' ?>> TO</option>
                                    </select>
                                </div>

                        
                                <input type="hidden" name="editar" value="editar_funcionario">
                                <input type="hidden" name="codigo_funcionario" value="<?php echo $codigo ?>">

                                <input type="submit" value="Atualizar" class="btn btn-primary mt-3 px-5">
                            </div>

                        </form>
                    </div>
                </div>
                <?php 
                    }
                    else
                        {
                            echo 'Nenhum funcionário encontrado!';
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