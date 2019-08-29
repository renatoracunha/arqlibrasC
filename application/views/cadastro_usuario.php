<!DOCTYPE html>
<html>
<head>
	<!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <<!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css') ?>">
  <!-- JavaScript (Opcional) -->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="<?php echo base_url('js/jquery.js') ?>"></script>
  <script src="<?php echo base_url('js/popper.js') ?>"></script>
  <script src="<?php echo base_url('js/bootstrap.js') ?>"></script>
  <script src="https://kit.fontawesome.com/8d24bc018e.js"></script>
  
	<title>Cadastro</title>
  <style type="text/css">
    body{
      background-color: #081921;
    }
    #formulario{
      text-align: center;
      margin-left: 25%;
      margin-top: 80%;
      margin-right: 25%;
    }
  </style>
</head>
<body>
  <div class="container">

    <div id="formulario">
      <form method="post" action="<?php echo base_url('arqlibras/cadastrar_usuario') ?>">        
          
          <input class="form-control" name="email" type="text" id="email" placeholder="E-mail" required><br>
          <input class="form-control" name="senha" type="password" id="senha" placeholder="Senha" required><br>
          <input class="form-control" name="confirmarsenha" type="password" id="confirmarsenha" placeholder="Confirmar Senha" required><br>
          <input class="btn btn-default" type="submit" name="cadastrar" value="cadastrar">
            
      </form>
      
    </div>
    
  </div>

</body>
</html>