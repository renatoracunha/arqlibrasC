<?php $usuario_id = $_GET['id']; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<!-- Meta tags Obrigatórias -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<!-- JavaScript (Opcional) -->
	<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			loadData();
			//loadFavButton();
		});

		function loadData(){
			$.ajax({
				url: "<?php echo site_url();?>arqlibras/ajax_get_palavra",
				dataType:"json",
				type:"get",
				data:{id_palavra:<?php echo $id_palavra ?>,usuario_id:<?php echo $usuario_id ; ?>	},
				cache:false,
				success:function(data){
					//console.log(data);
					$('#yt_video').append('<iframe width="100%" height="70%" src="'+data.yt_id+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>	</iframe>');
					$('#definicao_texto').append(data.descricao);
					$('#uso_texto').append(data.exemplo);
					$('#palavra').append(data.palavra);

					if (data.favorita) {
						
						$('#div_favButton').append('<button onclick="status_desfav('+data.favorita+')" class="btn btn-danger btnFav"></button>');
					}else{
						$('#div_favButton').append('<button onclick="status_fav()" class="btn btn-primary btnFav"></button>');
					}
					//data.yt_id;
				},error:function(e){
					alert('erro');
				}
			})
		}

		function status_fav(status){
			$.ajax({
				url: "<?php echo site_url();?>arqlibras/ajax_change_fav_status",
				dataType:"json",
				cache:false,
				type:"get",
				data:{ usuario_id:<?php echo $usuario_id ; ?>,id_palavra:<?php echo $id_palavra ?>},
				success: function(data){
					$('#div_favButton').html('');
					$('#div_favButton').append('<button onclick="status_desfav('+data+')" class="btn btn-danger btnFav"></button>');
				},
				error:function(e){
					alert('erro');
				}
			});
		}

		function status_desfav(id_palavra_favorita_usuario){
			$.ajax({
				url: "<?php echo site_url();?>arqlibras/ajax_change_desfav_status",
				dataType:"json",
				cache:false,
				type:"get",
				data:{ id_palavra_favorita_usuario:id_palavra_favorita_usuario},
				success: function(data){
					$('#div_favButton').html('');
					$('#div_favButton').append('<button onclick="status_fav()" class="btn btn-primary btnFav"></button>');
					
				},
				error:function(e){
					alert('erro');
				}
			});
		}
	</script>
	<title>Arqlibras!</title>
	<style type="text/css">
		.title{
			color: white;
			text-align: center;
		}
		.container{
			text-align: center;
			align-items: center;
		}
		.card_img{
			margin-top: 3em;
			width: 100%;
			background-color: #808080;
		}
		.descricao_title{
			color: white;
			margin: 5%;			
			font-size: 100%;
		}
		.descricao_text{
			color: white;
			margin-right: 10%;
			margin-left: 10%;			
		}
		.btnFav{
			position: fixed;
			float: bottom;
			bottom: 15px;
			right: 15px;
			z-index: 100;
			border-radius: 50%;
			font-size: 20px;
			padding: 15px;
		}
	</style>
</head>
<body style="background-color: black">
	<div id="header">
		<?php $this->load->view('navbar.php') ?>
	</div>

	<div id="container">
		<div id="row">
			<div id="header"></div>
			<h2 style="text-align: center;color: white">
				<div id="palavra"></div>
			</h2>
			<div id="yt_video" class="form-group">

			</div>
			<div  id="definicao">
				<label class="descricao_title" for="definicao_texto">Definição</label>
				<div class="descricao_text" id="definicao_texto">
					
				</div>
			</div>
			<div  id="uso">
				<label class="descricao_title" for="uso_texto">Exemplo em uma frase</label>
				<div class="descricao_text" id="uso_texto">
				</div>
			</div>

		</div>
		<!-- botão favoritar -->
		<div id="div_favButton"></div>
		
	</div><!--Fim container-->



</body>
</html>

