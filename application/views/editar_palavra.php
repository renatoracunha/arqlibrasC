<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css') ?>">
    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="<?php echo base_url('js/jquery.js') ?>"></script>
    <script src="<?php echo base_url('js/popper.js') ?>"></script>
    <script src="<?php echo base_url('js/bootstrap.js') ?>"></script>
    <script src="https://kit.fontawesome.com/8d24bc018e.js"></script>

    <title>Arqlibras!</title>
    

  </head>
  <body style="background-color: black">
    <div id="header">
      <?php $this->load->view('navbar.php') ?>
    </div>
    <?php 
    echo validation_errors('<p>','</p>');
    if($this->session->flashdata('atualizacao_positivo'))
    {
      echo '<p><font color="#228B22">'.$this->session->flashdata('atualizacao_positivo').'</font></p>';
    }
    if($this->session->flashdata('atualizacao_negativo'))
    {
      echo '<p><font color="#FF0000">'.$this->session->flashdata('atualizacao_negativo').'</font></p>';
    }
    ?>
    <div class="container">  
      <form id="contact" action="<?php echo site_url("arqlibras/editarPalavra/$id_item");?>" method="post">
        <h3 style="text-align: center">Editar Palavra</h3>
        <fieldset>
          <input placeholder="Informe a palavra..." value="<?php echo $palavra ?>" type="text" name="palavra" tabindex="1" required autofocus>
        </fieldset>  
        <fieldset>
          <textarea placeholder="Informe a descrição da palavra...." name="descricao" tabindex="2" required><?php echo $descricao ?></textarea>
        </fieldset>
        <fieldset>
          <textarea placeholder="Informe o exemplo em uma frase...." name="exemplo" tabindex="3" required><?php echo $exemplo ?></textarea>
        </fieldset>
        <fieldset>
          <input placeholder="Informe a chave do vídeo no youtube..." value="<?php echo $yt_id ?>" type="text" name="yt_id" tabindex="4" required autofocus>
        </fieldset>
        <fieldset>
          <input placeholder="Informe o nome do arquivo da imagem..." value="<?php echo $img ?>" type="text" name="img" tabindex="5" required autofocus>
        </fieldset>
        <fieldset>
          <button name="submit" type="submit" id="contact-submit" data-submit="...enviando">Editar</button>
        </fieldset>

      </form>
    </div>



  </body>
</html>