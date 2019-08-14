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
		
		$this->load->library('form_validation');//Carrega a biblioteca de valida??o de formul?rio
		$this->load->model('arqlibras_model');//Carrega o model		
		//Limpa o cache, não permitindo ao usuário visualizar nenhuma página logo depois de ter feito logout do sistema
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
	}
	
	public function index(){
		$this->load->view('index.php');
	}

	public function ajax_get_listar_palavras(){

		$registros=$this->arqlibras_model->get_listar_palavras();

		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}

	public function ajax_get_favoritos(){

		$registros=$this->arqlibras_model->get_favoritos();

		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}

	public function ajax_get_palavras_populares(){

		$registros=$this->arqlibras_model->get_palavras_populares();

		echo json_encode($registros,JSON_UNESCAPED_UNICODE);
	}

	/*
	==>palavra
	*/
	
	public function view_palavra($id_palavra){
		$dados['id_palavra'] = $id_palavra;
		$dados['contador']  = $this->arqlibras_model->contar_acesso($id_palavra);
		$this->load->view('view_palavra.php', $dados);
	}
	
	public function ajax_get_palavra(){
		$id_palavra = $this->input->get('id_palavra');

		$dados=$this->arqlibras_model->get_palavra($id_palavra);

		echo json_encode($dados,JSON_UNESCAPED_UNICODE);
	}
	
	public function ajax_change_fav_status(){
		$status = $this->input->get('status');
		$id_palavra = $this->input->get('id_palavra');

		$dados=$this->arqlibras_model->change_fav_status($status,$id_palavra);

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
				redirect("arqlibras/cadastrar");;
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
	

	/*
	==>Dasabilitar/Editar
	*/

	public function editar(){
		$this->load->view('editar_listar_palavras.php');
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
}
