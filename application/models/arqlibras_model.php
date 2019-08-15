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
	
	public function get_palavra($id_palavra=null)
	{
		$stmt = $this->db->prepare("SELECT * FROM palavras_cadastradas where id = :ID ");
		$stmt->bindParam(':ID',$id_palavra, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		
		return $resultado;
	}

	public function change_fav_status($status,$id_palavra)
	{
		
		$stmt = $this->db->prepare("UPDATE palavras_cadastradas set favorita=:FAVORITA
			WHERE id = :ID ");
		
		$stmt->bindValue(':ID', $id_palavra,PDO::PARAM_INT);
		$stmt->bindValue(':FAVORITA', $status, PDO::PARAM_STR);
		
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

	public function get_favoritos()
	{
		$stmt = $this->db->prepare("SELECT id,img FROM palavras_cadastradas where ativo = 'T' and favorita='T' order by palavra");
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

	public function get_pesquisar($observacao){
		$stmt = $this->db->prepare("SELECT id,img FROM palavras_cadastradas where ativo = 'T' and palavra like :OBSERVACAO order by palavra");
		$observacao = '%'.$observacao.'%';
		$stmt->bindValue(':OBSERVACAO',$observacao, PDO::PARAM_STR);

		$stmt->execute();
		$resultado = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		return $resultado;
		//print_r($observacao); exit;
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

}