<!DOCTYPE html>
<html>
<head>
	<!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="manifest" href="./manifest.json">
  <!-- JavaScript (Opcional) -->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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