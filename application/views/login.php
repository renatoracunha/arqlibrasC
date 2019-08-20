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
		<title>Entrar</title>
		<style type="text/css">
			body {
				background-color: black;
			}
			#entradas {
				text-align: center;
				margin-top: 80%;
				margin-bottom: 20%;
				margin-left: 25%;
				margin-right: 25%;
			}
			a{
				margin-right: 50%;
				margin-left: 35%;
			}
		</style>
	</head>
	<body>	

	  <div id="container">
	  	
	  	<div id="entradas">
	  		<form method="get" action="<?php echo base_url('arqlibras/entrar') ?>">
	  			
		    	<input class="form-control" type="text" name="login" id="login" placeholder="E-mail"><br>
					<input class="form-control" type="password" name="senha" id="senha" placeholder="Senha"><br>
					<input class="form-control" type="submit" name="Entrar" value="Entrar">

	  		</form>
	  		

	  	</div>	

	  	<a class="btn btn-dark" href="<?php echo base_url('arqlibras/cadastro')?>">Cadastre-se</a>	
	  			      
	    
	  </div>


		
	</body>
</html>