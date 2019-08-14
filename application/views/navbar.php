
<nav class="navbar navbar-dark bg-dark ">
  <!-- Conteúdo do navbar -->
  
  <button class="btn btn-sm btn-dark" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="<?php echo site_url();?>">Arqlibras</a>
  <?php 

    if ($_SERVER['REQUEST_URI']=='/') {
      //só aparecerá o input pesquisar se tiver na listagem de vídeos;
      echo '<input id="pesquisar_palavra" type="search" onkeyup="pesquisar_palavra()" placeholder="Pesquisar" aria-label="Pesquisar">';
      echo '<button type="button" class="btn btn-dark" onclick="abrirPesquisa()"><span class="fas fa-search"></span></button>';
    } ?>  

  <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo site_url();?>">Biblioteca <span class="sr-only">(página atual)</span></a>
      </li>      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Opções de administrador
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo site_url("arqlibras/cadastrar");?>">Cadastrar Palavra</a>
          <a class="dropdown-item" href="<?php echo site_url("arqlibras/editar");?>">Editar Palavra</a>
        </div>
      </li>      
    </ul>    
  </nav>

  <script type="text/javascript">

    function pesquisar_palavra(){
      nome = $('#pesquisar_palavra').val();
      $.ajax({
        url: "<?php echo site_url();?>arqlibras/ajax_get_pesquisar",
        dataType:"json",
        type:"get",
        data:{nome:nome},
        cache:false,
        success:function(data){
          var lines = '';
          $.each(data,function(index,value){
            lines+= loadDataInApp(value);
          });

          if (lines) {
            $("#palavras").html('');
            $("#palavras").append(lines);
          }else{
            alert('não há vídeos cadastrados');
          }
        },
        error:function(e){
          alert('erro');
        }
      });

    }
  </script>
