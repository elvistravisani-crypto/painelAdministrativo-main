<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Capivaras Hardwares</title>
    <!-- Autor -->
    <meta name="author" content="Elvis Travisani" />
    <!-- Link do Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- CDN fontaWere Icones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <!-- ADICIONAR FONTE AQUI -->
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet" />
    <!-- Link do meu arquivo CSS -->
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <?php require 'includes/cabecalho.php'; ?>

    <main id="login">

        <div class="container gy-5">
            <div class="row gy-5">
                <div class="col-12 col-md-6 mb">
                    <h2>Entre na sua conta</h2>
                    <form action="" method="post">
                        <div class="form-floating mb-3">
                            <input type="email" name="login_email" class="form-control form-control-sm"
                                id="floatingInputLogin" placeholder="name@example.com">
                            <label for="floatingInputLogin">Endereço de email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="login_senha" class="form-control" id="floatingPasswordLogin"
                                placeholder="Password">
                            <label for="floatingPasswordLogin">Senha</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </form>
                </div>
                <div class="col-12 col-md-6 ">
                    <form action="" method="post">
                        <h2>Cadastre-se</h2>
                        <div class="form-floating mb-3">
                            <input type="text" name="cad_username" class="form-control" id="floatingUsername"
                                placeholder="Username">
                            <label for="floatingUsername">Nome de usuário</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="cad_email" class="form-control" id="floatingEmail"
                                placeholder="Email">
                            <label for="floatingEmail">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="cad_senha" class="form-control" id="floatingPasswordCadastro"
                                placeholder="Password">
                            <label for="floatingPasswordCadastro">Senha</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="cad_confirmar_senha" class="form-control"
                                id="floatingConfirmPasswordCadastroConfirma" placeholder="Confirm Password">
                            <label for="floatingConfirmPasswordCadastroConfirma">Confirmar Senha</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </main>


    <!-- Rodapé -->
    <?php require 'includes/rodape.php'; ?>


    <!-- my Js -->
    <script src="assets/Js/script.js"></script>
    <!-- JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>