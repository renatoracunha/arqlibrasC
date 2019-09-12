<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');//Define que o arquivo n?o tem acesso direto via navegador

class Arqlibras extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');//Carrega o helper de url(link)
		$this->load->helper('form');//Carrega o helper de formul?rio
		$this->load->helper('array');//Carrega o helper array
		$this->load->helper('encode');
		$this->load->library('table');// Carrega a bibioteca de tabela

		$this->load->library('form_validation');//Carrega a biblioteca de valida??o de formul?rio
		$this->load->model('arqlibras_model');//Carrega o model		
		//Limpa o cache, não permitindo ao usuário visualizar nenhuma página logo depois de ter feito logout do sistema
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		session_start();
	}
	
	public function index(){
		$this->load->view('login');
	}

	public function ajax_get_user_data(){
		$login = $this->input->get('login');
		$senha = $this->input->get('senha');
		$registros=$this->arqlibras_model->get_user_data($login,$senha);

		if (!empty($registros)) {
			$_SESSION['user_id'] = $registros['id'];
		}
		
		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}
	//fazer cadastrar e cadastro em uma função só
	public function cadastro(){
		$this->load->view('cadastro_usuario');
	}


	public function cadastrar_usuario(){

		if ($this->input->post('cadastrar') != null){

			/*$email = $this->input->post('email');
			$senha = $this->input->post('senha');
			$confirmarSenha = $this->input->post('confirmarsenha');*/
			foreach($this->input->post() as $key => $value ){
				$dados[$key] = $value;
			}

			if(	$dados['senha'] == $dados['confirmarsenha'] ){

				/*$salto = 'geladeiraquebrada'.$dados['senha'];

				$dados['senha'] = hash('sha256', $salto);*/

				//$dados = array('email' => $email, 'senha' => $senha);

				$resultado = $this->arqlibras_model->cadastrar_usuario($dados);

				if($resultado){

					redirect('./');
				}
			}			
		}
	}

	/*
	==>página principal
	*/

	public function main_page(){
		if (empty($_SESSION['user_id'])) {
			redirect("./");
		}
		$this->load->view('index.php');
	}

	public function ajax_get_listar_palavras(){

		$registros=$this->arqlibras_model->get_listar_palavras();

		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}

	public function ajax_get_favoritos(){
		$usuario_id = $this->input->get('usuario_id');

		$registros=$this->arqlibras_model->get_favoritos($usuario_id);

		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}

	public function ajax_get_palavras_populares(){

		$registros=$this->arqlibras_model->get_palavras_populares();

		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}

	public function ajax_get_palavras_recentes(){

		$registros=$this->arqlibras_model->get_palavras_recentes();

		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}

	/*
	==>palavra
	*/
	
	public function view_palavra($id_palavra){
		if (empty($_SESSION['user_id'])) {
			redirect("./");
		}
		$dados['id_palavra'] = $id_palavra;
		$dados['contador']  = $this->arqlibras_model->contar_acesso($id_palavra);
		$this->load->view('view_palavra.php', $dados);
	}
	
	public function ajax_get_palavra(){
		$id_palavra = $this->input->get('id_palavra');
		$usuario_id = $this->input->get('usuario_id');

		$dados=$this->arqlibras_model->get_palavra($id_palavra,$usuario_id);

		echo json_encode($dados,JSON_UNESCAPED_UNICODE);
	}
	
	public function ajax_change_fav_status(){
		$usuario_id = $this->input->get('usuario_id');
		$id_palavra = $this->input->get('id_palavra');

		$dados=$this->arqlibras_model->change_fav_status($usuario_id,$id_palavra);

		echo json_encode($dados,JSON_UNESCAPED_UNICODE);
	}
	
	public function ajax_change_desfav_status(){
		$id_palavra_favorita_usuario = $this->input->get('id_palavra_favorita_usuario');
		

		$dados=$this->arqlibras_model->change_desfav_status($id_palavra_favorita_usuario);

		echo json_encode($dados,JSON_UNESCAPED_UNICODE);
	}
	
	/*
	==>cadastrar
	*/
	
	
	public function cadastrar(){

		if ($this->input->post('descricao')) {
			foreach($this->input->post() as $key => $value ){
				$registros[$key] = $value;
			}

			$registros['yt_id'] = 'https://www.youtube.com/embed/'.$registros['yt_id'];
			//print_r($registros);exit;
			if($this->arqlibras_model->cadastrar_palavra($registros)){
				$this->session->set_flashdata('atualizacao_positivo','Salvo com sucesso!');
				redirect("arqlibras/cadastrar");
			}else{
				$this->session->set_flashdata('atualizacao_negativo','Ocorreu um erro!');
				redirect("arqlibras/cadastrar");
			}

		}

		$this->load->view('cadastrar_palavra.php');
	}

	/*
	==>Navbar
	*/

	public function ajax_get_pesquisar(){
		$nome = $this->input->get('nome');

		$registros = $this->arqlibras_model->get_pesquisar($nome);

		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}
	

	public function ajax_get_info_usuarios(){
		$usuario_id = $this->input->get('usuario_id');

		$registros = $this->arqlibras_model->get_info_usuarios($usuario_id);

		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}
	

	/*
	==>Dasabilitar/Editar
	*/

	public function editar(){
		if (empty($_SESSION['user_id'])) {
			redirect("./");
		}
		$this->load->view('editar_listar_palavras.php');
	}

	public function editarPalavra($id_palavra){
		if (empty($_SESSION['user_id'])) {
			redirect("./");
		}
		if ($this->input->post('descricao')) {
			foreach($this->input->post() as $key => $value ){
				$registros[$key] = $value;
			}

			$registros['yt_id'] = 'https://www.youtube.com/embed/'.$registros['yt_id'];
			$registros['id'] = $id_palavra;
			
			if($this->arqlibras_model->editar_palavra($registros)){
				$this->session->set_flashdata('atualizacao_positivo','<p style="font:10em;margin-bottom:5em;">Salvo com sucesso!</p>');
				redirect("arqlibras/editarPalavra/$id_palavra");
			}else{
				$this->session->set_flashdata('atualizacao_negativo','Ocorreu um erro!');
				redirect("arqlibras/editarPalavra/$id_palavra");
			}

		}


		$dados = $this->arqlibras_model->get_palavra($id_palavra);

		$dados['yt_id'] = explode("/embed/", $dados['yt_id']);
		$dados['yt_id']=$dados['yt_id'][1];
		$dados['id_item'] = $id_palavra;
		//print_r($dados);exit;
		$this->load->view('editar_palavra.php',$dados);
		
	}

	public function ajax_get_editar_listar_palavras_ativas(){

		$registros=$this->arqlibras_model->get_editar_listar_palavras();

		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}

	public function ajax_desabilitar_itens(){
		$id_item = $this->input->get('id_item');
		$registros=$this->arqlibras_model->mudar_status_ativo($id_item);

		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}

	public function ajax_get_editar_listar_palavras_inativas(){

		$registros=$this->arqlibras_model->get_editar_listar_palavras('F');

		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}

	public function ajax_habilitar_itens(){
		$id_item = $this->input->get('id_item');
		$registros=$this->arqlibras_model->mudar_status_ativo($id_item,'T');

		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}


	#
	#
	#Admins
	#
	#

	public function set_admin(){
		$this->load->view('set_admin.php');
	}

	public function ajax_get_users(){
		$status = $this->input->get('status');
		$registros=$this->arqlibras_model->get_users($status);

		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}

	public function ajax_set_satus_admin(){
		$status = $this->input->get('status');
		$id_item = $this->input->get('id_item');
		$registros=$this->arqlibras_model->set_satus_admin($id_item,$status);

		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}

	public function ajax_get_users_by_name(){
		$nome = $this->input->get('nome');
		$status = 'T';
		$registros=$this->arqlibras_model->get_users($status,$nome);

		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}
}
