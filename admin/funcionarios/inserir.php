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
                include('../mensagem.php');
                ?>

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="m-0">Novo Funcionário</h4>

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
                                    <input type="text" name="nome" id="nome" class="form-control" maxlength="40"
                                        required>
                                </div>
                                <!-- Nome Social -->
                                <div class="col-5 mb-3">
                                    <label for="nome_social">Nome Social: </label>
                                    <input type="text" name="nome_social" id="nome_social" class="form-control"
                                        maxlength="40">
                                </div>
                                <!-- Foto -->
                                <div class="col-md-2 mb-3 text-center">
                                    <!-- espaço para a foto -->
                                    <div class="foto_fun border rounded bg-light d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 100px; height: 100px;">
                                        <i class="bi bi-person-fill text-secondary fs-1"></i>
                                    </div>

                                    <!--  -->
                                    <label for="foto_funcionario" class="form-label small">Foto do Funcionário</label>
                                    <input type="file" name="foto_funcionario" id="foto_funcionario" class="form-control form-control" accept="image/*">
                                </div>
                                <!-- Data de nascimento -->
                                <div class="col-2 mb-3">
                                    <label for="data_nascimento"><strong class="text-danger">*</strong>Data de
                                        nascimento</label>
                                    <input type="date" name="data_nascimento" id="data_nascimento" class="form-control"
                                        required>
                                </div>
                                <!-- Sexo -->
                                <div class="col-2 mb-3">
                                    <label for="sexo"><strong class="text-danger">*</strong>Sexo: </label>
                                    <select name="sexo" id="sexo" class="form-control" required>
                                        <option value="M">Masculino</option>
                                        <option value="F">Feminino</option>
                                        <option value="F">Não informado</option>
                                    </select>
                                </div>
                                <!-- Estado civil -->
                                <div class="col-2 mb-3">
                                    <label for="estado_civil">Estado civil: </label>
                                    <select name="estado_civil" id="estado_civil" class="form-control">
                                        <option value="Casado(a)">Casado(a)</option>
                                        <option value="Solteiro(a)">Solteiro(a)</option>
                                        <option value="Divorciado(a)">Divorciado(a)</option>
                                    </select>
                                </div>
                                <!-- Cpf -->
                                <div class="col-3 mb-3">
                                    <label for="cpf"><strong class="text-danger">*</strong>Cpf</label>
                                    <input type="text" name="cpf" id="cpf" class="form-control" maxlength="14" data-mask="000.000.000-00" required>
                                </div>

                                <!-- Rg -->
                                <div class="col-3 mb-3">
                                    <label for="rg">Rg</label>
                                    <input type="text" name="rg" id="rg" class="form-control" maxlength="12" data-mask="00.000.000-A">
                                </div>
                                <!-- Telefone residencial -->
                                <div class="col-3 mb-3">
                                    <label for="telefone_residencial">Telefone residencial: </label>
                                    <input type="text" name="telefone_residencial" id="telefone_residencial"
                                        class="form-control" maxlength="13" (00)00000-000>
                                </div>

                                <!-- Telefone celular -->
                                <div class="col-3 mb-3">
                                    <label for="telefone_celular">Telefone celular: </label>
                                    <input type="text" name="telefone_celular" id="telefone_celular"
                                        class="form-control" maxlength="14" data-mask="(00)00000-0000">
                                </div>
                                <!-- Salário -->
                                <div class="col-2 mb-3">
                                    <label for="salario">Salário: </label>
                                    <input type="text" name="salario" id="salario" class="form-control" data-mask="00000,00" data-mask-reverse="true">
                                </div>

                                <!-- Email -->
                                <div class="col-4 mb-3">
                                    <label for="email"><strong class="text-danger">*</strong>Email: </label>
                                    <input type="email" name="email" id="email" class="form-control" maxlength="50"
                                        required>
                                </div>

                                <!-- Usuário -->
                                <div class="col-3 mb-3">
                                    <label for="usuario"><strong class="text-danger">*</strong>Usuário: </label>
                                    <input type="text" name="usuario" id="usuario" class="form-control" maxlength="15"
                                        required>
                                </div>

                                <!-- Senha -->
                                <div class="col-3 mb-3">
                                    <label for="senha"><strong class="text-danger">*</strong>Senha: </label>
                                    <input type="password" name="senha" id="senha" class="form-control" maxlength="8"
                                        required>
                                </div>

                                <!-- Tipo de acesso -->
                                <div class="col-2 mb-3">
                                    <label for="tipo_acesso"><strong class="text-danger">*</strong>Tipo de acesso:
                                    </label>
                                    <select name="tipo_acesso" id="tipo_acesso" class="form-control" required>
                                        <option value="1">Administrador</option>
                                        <option value="0">Comum</option>
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="col-2 mb-3">
                                    <label for="status"><strong class="text-danger">*</strong>Status: </label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="1">Ativo</option>
                                        <option value="0">Inativo</option>
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
                                            echo '<option value="' . $cargo['codigo_cargo'] . '">' . $cargo['nome'] . '</option>';
                                        }

                                        ?>
 
 
                                    </select>
                                </div>

                                 <!-- Cep -->
                                <div class="col-3 mb-3">
                                    <label for="cep"><strong class="text-danger">*</strong>Cep: </label>
                                    <input type="text" name="cep" id="cep" class="form-control" maxlength="9" data-mask="00000-000" require>
                                </div>

                                <!-- Endereço -->
                                <div class="col-5 mb-3">
                                    <label for="endereco"><strong class="text-danger">*</strong>Endereço: </label>
                                    <input type="text" name="endereco" id="endereco" class="form-control" maxlength="70"
                                        required>
                                </div>

                                <!-- Número -->
                                <div class="col-1 mb-3">
                                    <label for="numero"><strong class="text-danger">*</strong>Número: </label>
                                    <input type="number" name="numero" id="numero" class="form-control" required>
                                </div>

                                <!-- Complemento -->
                                <div class="col-3 mb-3">
                                    <label for="complemento">Complemento: </label>
                                    <input type="text" name="complemento" id="complemento" class="form-control"
                                        maxlength="40">
                                </div>

                                <!-- Bairro -->
                                <div class="col-3 mb-3">
                                    <label for="bairro"><strong class="text-danger">*</strong>Bairro: </label>
                                    <input type="text" name="bairro" id="bairro" class="form-control" maxlength="30"
                                        required>
                                </div>

                                <!-- Cidade -->
                                <div class="col-4 mb-3">
                                    <label for="cidade"><strong class="text-danger">*</strong>Cidade: </label>
                                    <input type="text" name="cidade" id="cidade" class="form-control" maxlength="40"
                                        required>
                                </div>

                                <!-- Estado -->
                                <div class="col-1 mb-3">
                                    <label for="estado"><strong class="text-danger">*</strong>UF: </label>
                                    <select name="estado" id="estado" class="form-control" required>
                                        <option value="SP">SP</option>
                                        <option value="AL">AL</option>
                                        <option value="AP">AP</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO">GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MT">MT</option>
                                        <option value="MS">MS</option>
                                        <option value="MG">MG</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PR">PR</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RS">RS</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="SC">SC</option>
                                        <option value="AC">AC</option>
                                        <option value="SE">SE</option>
                                        <option value="TO">TO</option>
                                    </select>
                                </div>

                        
                                <input type="hidden" name="cadastrar" value="cadastrar_funcionario">

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
     <!-- busca cep -->
    <script src="../../custom/js/via-cep.js"></script>
</body>

</html>