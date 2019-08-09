<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class AnalisarLogin {	
		function analisarlogin(){
			$permitido = array('','admin','clinica','empresa','paciente','home');
			$url = $_SERVER['REQUEST_URI'];//$this->CI->uri->segment(1);
			
			$apelido = explode("/", $url);		
			if(!in_array($apelido[1],$permitido)){
				//redirect(site_url('acesso/clinica/'.$apelido[1]));	
				$redirect = 'http://www.ansexames.com/acesso/clinica/'.$apelido[1];
				echo $redirect;
				header("location:$redirect");
				//echo "Carregando...";
				//print_r($apelido);
				/*$this->CI->load->model('home_model');//Carrega o model
				$dadosClinica = $this->CI->home_model->buscaPorApelidoClinica($apelido);
				if(!Empty($dadosClinica)){
					redirect(site_url('acesso/clinica/'.$apelido));	
				}
				var_dump($dadosClinica);*/
			}		
		}
	}
?>