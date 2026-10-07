 <!--<<<<<<<<<<<<<<<< Inicio Cabeçalho >>>>>>>>>>>>>>>-->
  <header id="cabecalho">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
      <!-- Logo -->
      <div class="logo">
        <a href="index.php">
          <img src="assets/img/logo/logo_site.PNG" alt="logo" />
        </a>
      </div>

      <!-- icone de img para o MOBILE-->
      <div class="icons icons-mobile">
        <a href="login.php">
          <img src="assets/img/icones/icons8-usuário-masculino-94.png" alt="Login" />
        </a>
        <a href="#">
          <img src="assets/img/icones/icons8-carrinho-de-compras-94.png" alt="Carrinho de compras" />
        </a>
      </div>

      <!-- Input de Pesquisa -->
      <form class="d-flex mx-auto" role="search">
        <input class="form-control me-2" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" />
        <button class="btn btn-outline-light" type="submit">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </form>

      <!-- Botão Hamburger -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal"
        aria-controls="menuPrincipal" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links do Menu -->
      <div class="collapse navbar-collapse" id="menuPrincipal">
        <!-- icone de img para o DESKTOP-->
        <div class="icons icons-desktop">
          <a href="login.php">
            <img src="assets/img/icones/icons8-usuário-masculino-94.png" alt="Login" />
          </a>
          <a href="#">
            <img src="assets/img/icones/icons8-carrinho-de-compras-94.png" alt="Carrinho de compras" />
          </a>
        </div>

        <ul class="navbar-nav ms-auto">
          <li class="nav-item">

            <a class="nav-link" href="index.php">Home</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
              Produtos
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="cpu.php">CPU</a></li>
              <li><a class="dropdown-item" href="#">Placa Gráfica</a></li>
              <li><a class="dropdown-item" href="#">Motherboard</a></li>
              <li><a class="dropdown-item" href="#">Memória RAM</a></li>
              <li><a class="dropdown-item" href="#">SSD/HD</a></li>
              <li><a class="dropdown-item" href="#">Fonte</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Sobre</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Contato</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!--<<<<<<<<<<<<<<<< Final Cabeçalho >>>>>>>>>>>>>>>-->