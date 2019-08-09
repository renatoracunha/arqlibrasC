
<nav class="navbar navbar-dark bg-dark">
  <!-- Conteúdo do navbar -->
   <a class="navbar-brand" href="<?php echo site_url("arqlibras");?>">Arqlibras</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./">Biblioteca <span class="sr-only">(página atual)</span></a>
      </li>
      <!--<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Opções de usuário
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Informações</a>
          <a class="dropdown-item" href="#">Conectar Redes Sociais</a>
          <a class="dropdown-item" href="<?php echo site_url("arqlibras/sugestao");?>">Sugerir Palavra</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Compartilhar</a>
        </div>
      </li>-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Opções de administrador
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo site_url("arqlibras/cadastrar");?>">Cadastrar Palavra</a>
          <a class="dropdown-item" href="<?php echo site_url("arqlibras/desabilitar");?>">Desabilitar Palavra</a>
          <a class="dropdown-item" href="<?php echo site_url("arqlibras/editar");?>">Editar Palavra</a>
        </div>
      </li>
      
    </ul>
  <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
</nav>

