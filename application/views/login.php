<!DOCTYPE html>
<html>
	<head>
		<!-- Meta tags Obrigatórias -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="manifest" href="https://arqlibrasc.000webhostapp.com/manifest.json">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css') ?>">
		<!-- JavaScript (Opcional) -->
		<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
		<script src="<?php echo base_url('js/jquery.js') ?>"></script>
		<script src="<?php echo base_url('js/popper.js') ?>"></script>
		<script src="<?php echo base_url('js/bootstrap.js') ?>"></script>
		<script src="https://kit.fontawesome.com/8d24bc018e.js"></script>

		<title>Entrar</title>

		<script type="text/javascript">

			//Instalador PWA

			$(document).ready(function() { 
			    $('#btnInstall').hide();
			    setTimeout(function() { 
			        $('#btnInstall').show(); 
			 	}, 3 * 1000); 
			});
			
			let deferredPrompt = null;

			window.addEventListener('beforeinstallprompt', (e) => {
			  // Prevent Chrome 67 and earlier from automatically showing the prompt
			  e.preventDefault();
			  // Stash the event so it can be triggered later.
			  deferredPrompt = e;
			});

			async function install() {
			  if (deferredPrompt) {
			    deferredPrompt.prompt();
			    console.log(deferredPrompt)
			    deferredPrompt.userChoice.then(function(choiceResult){

			      if (choiceResult.outcome === 'accepted') {
			      console.log('Your PWA has been installed');
			    } else {
			      console.log('User chose to not install your PWA');
			    }

			    deferredPrompt = null;

			    });


			  }
			}			

			// This is the "Offline page" service worker

		    // Add this below content to your HTML page, or add the js file to your page at the very top to register service worker

		    // Check compatibility for the browser we're running this in
		    if ("serviceWorker" in navigator) {
		      if (navigator.serviceWorker.controller) {
		        console.log("[PWA Builder] active service worker found, no need to register");
		      } else {
		            // Register the service worker
	            navigator.serviceWorker
	            .register("https://arqlibrasc.000webhostapp.com/pwabuilder-sw.js")
	            .then(function (reg) {
	              console.log("[PWA Builder] Service worker has been registered for scope: " + reg.scope);
	            });
	          }
	        }

	        function verify_login(){
				let login = $('#email').val();
				let senha = $('#senha').val();

				if(senha==''){
					$('#senha').addClass('is-invalid');
					$('#senha').focus();
					$('#senha').attr('placeholder','Informe uma senha');
					$('#senha').css("background-color", "#FFD6D6");
				}

				if(login==''){
					$('#email').addClass('is-invalid');
					$('#email').focus();
					$('#email').attr('placeholder','Informe um email/Login');
					$('#email').css("background-color", "#FFD6D6");
				}
				$.ajax({
					url: "<?php echo site_url();?>arqlibras/ajax_get_user_data",
					dataType:"json",
					type:"get",
					data:{senha:senha,login:login},
					cache:false,
					success:function(data){
						if(data){
						window.location.href = "./arqlibras/main_page";
					}else{
						alert('cadastro inválido ou inexistente')
					}
					},error:function(e){
						alert('erro');
					}
				})
			}

		</script>
		<style type="text/css">
			body {
				background-color: #1c1c1c;
			}
			#btnInstall{
				margin-top: 10%;

			}
			#entradas {
				text-align: center;
				margin-bottom: 10%
			}
			#email, #senha{
				width: 60%;
				margin-left: 20%;
			}
			a {
				margin-left: 35%;
			}

			img{
				margin-top:10%;
				margin-bottom: 5%;
				margin-left: 30%;				
			}
		</style>
	</head>
	<body>	

		<div class="container">

			<div id="btnInstall" class="alert alert-light alert-dismissible fade show" role="alert">
			  <button class="btn btn-link" onclick="install()">Adicionar a tela inicial</button>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>

			<img src="./imagens/logo.png" alt="logo">

			
			<div id="entradas">
				<input class="form-control" type="text" name="email" id="email" placeholder="E-mail"><br>
				<input class="form-control" type="password" name="senha" id="senha" placeholder="Senha" ><br>
				<button class="btn btn-primary" onclick="verify_login()">Login</button>
			</div>	

			<a class="btn btn-dark" href="<?php echo base_url('arqlibras/cadastro')?>">Cadastre-se</a>

			
			
		</div>
	</body>
</html>