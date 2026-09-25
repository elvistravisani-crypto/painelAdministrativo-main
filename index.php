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
  <main>
    <!--<<<<<<<<<<<<<<<< Inicio da Sessão Banner >>>>>>>>>>>>>>>-->

    <section id="banner">

      <div class="container-fluid text-center">
        <div class="row align-items-center justify-content-center">
          <!-- Coluna do texto -->
          <div class="col-12 col-md-6 text-white">
            <h2>
              <span style="color: white;">Bem vindos à </span><span style="color:#ff6b00;">Capivaras_hardwares</span>
            </h2>
            <p>Os melhores componentes, pelo melhor preço</p>
            <a href="cpu.php" class="btn btn-danger">Ver produtos</a>
          </div>
          <!-- coluna da imagem -->
          <div class="col-12 col-md-6">
            <div>
              <img src="assets/img/banner/banner_principal.png" alt="Capivara com produtos eletrônicos">
            </div>
          </div>

        </div>
      </div>
    </section>
    <!--<<<<<<<<<<<<<<<< Final da Sessão Banner >>>>>>>>>>>>>>>-->

    <h2 class="carrossel-titulo">Produtos em Destaque</h2>

    <!--<<<<<<<<<<<<<<<< Inicio da Sessão Carrossel >>>>>>>>>>>>>>>-->
    <section id="carrossel">
      <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">
        <!-- Itens do carrossel -->
        <div class="carousel-inner">
          <!-- Item -01 -->
          <div class="carousel-item active">
            <div class="fundo">
              <img src="assets/img/carrossel/pc-gamer02.PNG" class="d-block w-100" alt="..." />
              <h4>PC Gamer RTX 4070 - 32GB Ram</h4>
            </div>
          </div>
          <!-- Item -02 -->
          <div class="carousel-item">
            <div class="fundo">
              <img src="assets/img/carrossel/cpu_13.PNG" class="d-block w-100" alt="..." />
              <h4>CPU Intel Core i7</h4>
            </div>
          </div>
          <!-- Item -03 -->
          <div class="carousel-item">
            <div class="fundo">
              <img src="assets/img/carrossel/rtx-5080.PNG" class="d-block w-100" alt="..." />
              <h4>Placa Gráfica RTX 5080</h4>
            </div>
          </div>
          <!-- Item -04 -->
          <div class="carousel-item">
            <div class="fundo">
              <img src="assets/img/carrossel/monitor.PNG" class="d-block w-100" alt="..." />
              <h4>TCL 34" QD-Mini LED</h4>
            </div>
          </div>
          <!-- Item -05 -->
          <div class="carousel-item">
            <div class="fundo">
              <img src="assets/img/carrossel/cpu-ryzen.PNG" class="d-block w-100" alt="..." />
              <h4>CPU AMD Ryzen 7</h4>
            </div>
          </div>
        </div> <!-- Final dos produtos do carrossel >>>>>>>-->

        <!-- Setas do carrossel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching"
          data-bs-slide="prev">
         <i class="fa-solid fa-arrow-left"></i>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching"
          data-bs-slide="next">
          <i class="fa-solid fa-arrow-right-long"></i>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>
    <!--<<<<<<<<<<<<<<<< Final da Sessão Carrossel >>>>>>>>>>>>>>>-->


    <!--<<<<<<<<<<<<<<<< Inicio da Sessão Sobre Nós >>>>>>>>>>>>>>>-->
    <section id="sobre">
      <div class="container text-left">
        <div class="row align-items-start">
          <div class="col-12 col-md-6">
            <h2>Sobre Nós</h2>
            <p>
              Somos uma loja online focada em hardwares, buscando te ajudar a
              chegar no próximo nível com os hardwares de alto desempenho
              premium
            </p>
            <p>
              Também atendemos empresas e desktops para escritório e seus
              variados periféricos.
            </p>
            <p>Não perca tempo procurando, você esta no lugar certo!</p>
          </div>
          <div class="col-12 col-md-6"><img src="assets/img/banner/Capivara.png"
              alt="Capivara com produtos eletrônicos" /></div>
        </div>
      </div>
    </section>
    <!--<<<<<<<<<<<<<<<< Final da Sessão Sobre Nós >>>>>>>>>>>>>>>-->


    <!-- mapa -->
    <section id="localizacao">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6">
            <h4>Estamos Localizados</h4>
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3679.99224877252!2d-47.648162124694906!3d-22.72852947938091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c631a09ac7b2e1%3A0x197834b105f878e3!2sSenac%20Piracicaba!5e0!3m2!1spt-BR!2sbr!4v1780883593613!5m2!1spt-BR!2sbr"
              width="100%" height="300" style="border: 0" allowfullscreen="" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
            <!-- width 100% para deixar expansivo -->
          </div>
        </div>
      </div>
    </section>
  </main>

    <!--<<<<<<<<<<<<<<<<Rodapé >>>>>>>>>>>>>>>-->
 <?php require 'includes/rodape.php'; ?>



    <!-- my Js -->
    <script src="assets/Js/script.js"></script>
    <!-- JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>