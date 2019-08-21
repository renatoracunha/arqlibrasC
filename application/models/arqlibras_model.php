<?php
class Arqlibras_model extends CI_Model
{
	//Trata os caracteres para utf-8, tanto os de entrada como os de saída de dados.
	function __construct()
	{
		$this->db->query( "SET NAMES 'utf8'" );
	}
	/*
	//
	//view_palavras
	//
	*/
	
	public function get_palavra($id_palavra=null,$usuario_id=null)
	{
		$stmt = $this->db->prepare("SELECT palavras_cadastradas.id,palavras_cadastradas.yt_id,palavras_cadastradas.palavra,palavras_cadastradas.descricao,palavras_cadastradas.descricao, palavras_cadastradas.exemplo,(select palavra_favorita_usuario.id from palavra_favorita_usuario where palavra_favorita_usuario.palavra_id = :PALAVRA_ID and palavra_favorita_usuario.usuario_id = :USUARIO_ID) as favorita FROM palavras_cadastradas where palavras_cadastradas.id = :PALAVRA_ID");
		$stmt->bindParam(':PALAVRA_ID',$id_palavra, PDO::PARAM_INT);
		$stmt->bindValue(':USUARIO_ID', $usuario_id,PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		
		return $resultado;
	}

	public function change_fav_status($usuario_id,$id_palavra)
	{
		
		$stmt = $this->db->prepare("INSERT INTO palavra_favorita_usuario (palavra_id,usuario_id) VALUES (:PALAVRA_ID,:USUARIO_ID)");
		
		$stmt->bindValue(':PALAVRA_ID', $id_palavra,PDO::PARAM_INT);
		$stmt->bindValue(':USUARIO_ID', $usuario_id, PDO::PARAM_STR);
		
		if($stmt->execute())
		{
			$stmt2 = $this->db->prepare("select LAST_INSERT_ID() as ID");
			if($stmt2->execute()){
				$resultado = $stmt2->fetch(PDO::FETCH_ASSOC);	
				return $resultado['ID'];
			}
			else
			{
				return false;
			}   
		}
	}	

	public function change_desfav_status($id_palavra_favorita_usuario)
	{
		
		$stmt = $this->db->prepare("DELETE from palavra_favorita_usuario
			WHERE id = :ID ");
		
		$stmt->bindValue(':ID', $id_palavra_favorita_usuario,PDO::PARAM_INT);
		
		if($stmt->execute())
		{
			return true;
		}
		else
		{
			return false;
		}
	}	

	public function contar_acesso($id_palavra){
		$stmt = $this->db->prepare("UPDATE palavras_cadastradas set acessos=acessos+1
			WHERE id = :ID ");
		
		$stmt->bindValue(':ID', $id_palavra,PDO::PARAM_INT);
		
		if($stmt->execute())
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/*
	//
	//index
	//
	*/
	public function get_listar_palavras()
	{
		$stmt = $this->db->prepare("SELECT id,img FROM palavras_cadastradas where ativo = 'T' order by palavra");
		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $resultado;
	}

	public function get_favoritos($usuario_id)
	{
		$stmt = $this->db->prepare("SELECT palavras_cadastradas.id,img FROM palavra_favorita_usuario
			left join palavras_cadastradas on palavras_cadastradas.id = palavra_favorita_usuario.palavra_id
			left join usuario on usuario.id = palavra_favorita_usuario.usuario_id
			where ativo = 'T' and usuario.id = :ID order by palavra");
		$stmt->bindValue(':ID', $usuario_id,PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $resultado;
	}

	public function get_palavras_populares()
	{
		$stmt = $this->db->prepare("SELECT id,img FROM palavras_cadastradas where ativo = 'T' order by acessos DESC
			LIMIT 3");
		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $resultado;
	}

	public function get_palavras_recentes()
	{
		$stmt = $this->db->prepare("SELECT id,img FROM palavras_cadastradas where ativo = 'T' order by data_criacao DESC
			LIMIT 3");
		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $resultado;
	}

	/*
	//
	//cadastro palavras
	//
	*/

	public function cadastrar_palavra($dados=null){
		//print_r($dados);exit;
		$stmt = $this->db->prepare("INSERT INTO palavras_cadastradas (palavra,descricao,exemplo,yt_id,img) VALUES (:PALAVRA,:DESCRICAO,:EXEMPLO,:YT_ID,:IMG)");
		
		$stmt->bindValue(':PALAVRA',element('palavra', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':DESCRICAO',element('descricao', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':EXEMPLO',element('exemplo', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':YT_ID',element('yt_id', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':IMG',element('img', $dados), PDO::PARAM_STR);
		
		if($stmt->execute())
		{
			return true;
		}
		else
		{
			return false;
		}			
	}


	/*
	//
	//navbar
	//
	*/
	public function get_pesquisar($observacao){
		$stmt = $this->db->prepare("SELECT id,img FROM palavras_cadastradas where ativo = 'T' and palavra like :OBSERVACAO order by palavra");
		$observacao = '%'.$observacao.'%';
		$stmt->bindValue(':OBSERVACAO',$observacao, PDO::PARAM_STR);

		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $resultado;
		//print_r($observacao); exit;
	}


	public function get_info_usuarios($usuario_id){
		$stmt = $this->db->prepare("SELECT * FROM usuario where id = :ID");
		
		$stmt->bindValue(':ID', $usuario_id,PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		
		return $resultado;
	}


	/*
	//
	//editar
	//
	*/
	public function get_editar_listar_palavras($status = 'T'){
		$stmt = $this->db->prepare("SELECT id,palavra,ativo FROM palavras_cadastradas where ativo = '".$status."'");

		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $resultado;
	}

	public function mudar_status_ativo($id_item,$status = 'F'){
		$stmt = $this->db->prepare("UPDATE palavras_cadastradas set ativo='".$status."'
			WHERE id = :ID ");
		
		$stmt->bindValue(':ID', $id_item,PDO::PARAM_INT);
		
		if($stmt->execute())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function editar_palavra($dados){
		$stmt = $this->db->prepare("UPDATE palavras_cadastradas set descricao = :DESCRICAO, exemplo = :EXEMPLO,palavra = :PALAVRA ,yt_id = :YT_ID,img = :IMG
			WHERE id = :ID ");
		
		$stmt->bindValue(':DESCRICAO',element('descricao', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':EXEMPLO',element('exemplo', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':PALAVRA',element('palavra', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':YT_ID',element('yt_id', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':IMG',element('img', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':ID', element('id', $dados),PDO::PARAM_INT);

		if($stmt->execute())
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	#
	#
	# USUARIOS
	#
	#
	public function cadastrar_usuario($dados=null){

		//print_r($dados);exit;
		$stmt = $this->db->prepare("INSERT INTO usuario (email, senha) VALUES (:EMAIL, :SENHA)");
		
		$stmt->bindValue(':EMAIL',element('email', $dados), PDO::PARAM_STR);
		$stmt->bindValue(':SENHA',element('senha', $dados), PDO::PARAM_STR);	
		
		if($stmt->execute())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function entrar($email=null,$senha=null){

		//print_r($dados);exit;
		$stmt = $this->db->prepare("SELECT id FROM usuario where email = :EMAIL and senha = :SENHA");
		
		$stmt->bindValue(':EMAIL',$email, PDO::PARAM_STR);
		$stmt->bindValue(':SENHA',$senha, PDO::PARAM_STR);	
		
		$stmt->execute();

		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		return $resultado;	
	}
}