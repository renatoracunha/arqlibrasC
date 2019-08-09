<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Funcoes {	
	function AcessoPermitido($menu = null){
		$this->CI =& get_instance();
		$this->CI->load->model('perfil_model');//Carrega o model
		
		$usuario_id = 	$this->CI->session->userdata('usuario_id');
		$tipo_usuario_id = $this->CI->session->userdata('tipo_usuario_id');
		$clinica_id =		$this->CI->session->userdata('clinica_id');
		$cod_referencia =	$this->CI->session->userdata('cod_referencia');
		
		Return $this->CI->perfil_model->PermitidoUsuarioMenu($usuario_id,$menu);	
		
	}
	
	function criarPerfilPadrao(){
		$this->CI =& get_instance();
		$this->CI->load->model('perfil_model');//Carrega o model
		//$this->CI->load->library('session');//Carrega a biblioteca de sess�o
		
		$usuario_id = 	$this->CI->session->userdata('usuario_id');
		$tipo_usuario_id = $this->CI->session->userdata('tipo_usuario_id');
		$clinica_id =		$this->CI->session->userdata('clinica_id');
		$cod_referencia =	$this->CI->session->userdata('cod_referencia');
		
		$dadosPerfil = array(
			'descricao'=>'Gerencial',
			'tipo_usuario_id'=>$tipo_usuario_id,
			'clinica_id'=>$clinica_id,
			'cod_referencia'=>$cod_referencia,
			'gerencial'=>'T',
			'padrao' => 'T'
		);

		$perfil = $this->CI->perfil_model->inserirPerfil($dadosPerfil);	

		if($perfil){	
			$perfil_id = $perfil[0];
			$menus = $this->CI->perfil_model->listarMenu();			
			$campos = array('listar','inserir','editar','excluir','enviar');
			foreach($menus as $key => $value){	
				$permissao = array();
				$permissao['menu_id'] = $menus[$key]['id'];
				$permissao['perfil_id'] = $perfil_id;
				foreach($menus[$key] as $key2 => $value2){
					if(in_array($key2,$campos)){
						$permissao[$key2] = ($value2 == 'X') ? 'F' : $value2;
					}
				}		
				$this->CI->perfil_model->inserirAtualizarPermissao($permissao);	
			}			
			$this->CI->perfil_model->inserirPerfilCadUsusario($usuario_id,$perfil_id);	
		}else{		
			redirect("login/logout");
		}		
		
	} 
}
