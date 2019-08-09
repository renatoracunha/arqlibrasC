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

	/*public function consulta($codigo=null)
	{
		$stmt = $this->db->prepare("SELECT * FROM empresa_local where id_empresa = :id and ativo = 'T'");
		$stmt->bindParam(':id',$codigo, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetchAll();
		
		return $resultado;
	}	
	
	public function buscaPorEmpresa($id=null)
	{
		$stmt = $this->db->prepare("SELECT id,descricao
			from empresa_local
			where id_empresa = :ID		
			and ativo = 'T'
			order by descricao");
		$stmt->bindParam(':ID', $id, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $resultado;
	}	
	
	public function buscaDados($id=null)
	{
		$stmt = $this->db->prepare("SELECT id,descricao,registro_ponto,contratacao_aprendiz,contratacao_aprendiz_processojudicial,
			contratacao_aprendiz_entidadeeducativa,contratacao_aprendiz_entidadeeducativacnpj,
			contratacao_PCD,contratacao_PCD_processojudicial,FAP,tipo_processo_RAT,num_processo_RAT,cod_indicativo_suspensao_RAT,
			tipo_procAdmJudFap,num_procAdmJudFap,cod_indicativo_suspensao_procAdmJudFap
			from empresa_local
			where id = :ID and clinica_id = :CLINICA_ID");
		$stmt->bindParam(':ID',$id, PDO::PARAM_INT);
		$stmt->bindParam(':CLINICA_ID', $this->session->userdata('clinica_id'), PDO::PARAM_INT);
		
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		return $resultado;
	}	
	
	public function editar($dados=null)
	{
		$stmt = $this->db->prepare("UPDATE empresa_local set descricao=:DESCRICAO,
			registro_ponto=:REGISTRO_PONTO,contratacao_aprendiz=:CONTRATACAO_APRENDIZ,
			contratacao_aprendiz_processojudicial=:CONTRATACAO_APRENDIZ_PROCESSOJUDICIAL,
			contratacao_aprendiz_entidadeeducativa=:CONTRATACAO_APRENDIZ_ENTIDADEEDUCATIVA,
			contratacao_aprendiz_entidadeeducativacnpj=:CONTRATACAO_APRENDIZ_ENTIDADEEDUCATIVACNPJ,
			contratacao_PCD=:CONTRATACAO_PCD,contratacao_PCD_processojudicial=:CONTRATACAO_PCD_PROCESSOJUDICIAL,
			FAP =:FAP,tipo_processo_RAT=:TIPO_PROCESSO_RAT,num_processo_RAT=:NUM_PROCESSO_RAT,
			cod_indicativo_suspensao_RAT=:COD_INDICATIVO_SUSPENSAO_RAT,tipo_procAdmJudFap=:TIPO_PROCADMJUDFAP,
			num_procAdmJudFap=:NUM_PROCADMJUDFAP,cod_indicativo_suspensao_procAdmJudFap=:COD_INDICATIVO_SUSPENSAO_PROCADMJUDFAP
			
			WHERE id = :ID and id_empresa = :EMPRESA_ID and clinica_id = :CLINICA_ID");
		
		$stmt->bindParam(':ID',element('id', $dados), PDO::PARAM_INT);
		$stmt->bindParam(':EMPRESA_ID', element('EmpresaID', $dados), PDO::PARAM_INT);
		$stmt->bindParam(':CLINICA_ID', element('ClinicaID', $dados), PDO::PARAM_INT);		
		$stmt->bindParam(':DESCRICAO',element('descricao', $dados), PDO::PARAM_STR);
		$stmt->bindParam(':REGISTRO_PONTO',element('registro_ponto', $dados), PDO::PARAM_INT);
		$stmt->bindParam(':CONTRATACAO_APRENDIZ',element('contratacao_aprendiz', $dados), PDO::PARAM_INT);
		$stmt->bindParam(':CONTRATACAO_APRENDIZ_PROCESSOJUDICIAL',element('contratacao_aprendiz_processojudicial', $dados), PDO::PARAM_STR);
		$stmt->bindParam(':CONTRATACAO_APRENDIZ_ENTIDADEEDUCATIVA',element('contratacao_aprendiz_entidadeeducativa', $dados), PDO::PARAM_STR);
		$stmt->bindParam(':CONTRATACAO_APRENDIZ_ENTIDADEEDUCATIVACNPJ',element('contratacao_aprendiz_entidadeeducativacnpj', $dados), PDO::PARAM_STR);
		$stmt->bindParam(':CONTRATACAO_PCD',element('contratacao_PCD', $dados), PDO::PARAM_INT);
		$stmt->bindParam(':CONTRATACAO_PCD_PROCESSOJUDICIAL',element('contratacao_PCD_processojudicial', $dados), PDO::PARAM_STR);
		
		$stmt->bindParam(':FAP',element('FAP', $dados), PDO::PARAM_STR);	
		$stmt->bindParam(':TIPO_PROCESSO_RAT', element('tipo_processo_RAT', $dados), PDO::PARAM_INT);
		$stmt->bindParam(':NUM_PROCESSO_RAT',element('num_processo_RAT', $dados), PDO::PARAM_STR);
		$stmt->bindParam(':COD_INDICATIVO_SUSPENSAO_RAT',element('cod_indicativo_suspensao_RAT', $dados), PDO::PARAM_STR);
		$stmt->bindParam(':TIPO_PROCADMJUDFAP', element('tipo_procAdmJudFap', $dados), PDO::PARAM_INT);
		$stmt->bindParam(':NUM_PROCADMJUDFAP',element('num_procAdmJudFap', $dados), PDO::PARAM_STR);
		$stmt->bindParam(':COD_INDICATIVO_SUSPENSAO_PROCADMJUDFAP',element('cod_indicativo_suspensao_procAdmJudFap', $dados), PDO::PARAM_STR);

		if($stmt->execute())
		{
			return true;
		}
		else
		{
			return false;
		}
	}	
	
	public function listarGrupos($local = null){
		$stmt = $this->db->prepare("SELECT id, descricao, iniValid, fimValid FROM empresa_grupo WHERE ativo = 'T' 
			and local_id =:ID and clinica_id = :CLINICA_ID");
		$stmt->bindParam(':ID', $local, PDO::PARAM_INT);
		$stmt->bindParam(':CLINICA_ID', $this->session->userdata('clinica_id'), PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $resultado;			
	}
	
	public function buscaDadosGrupo($grupo = null){
		$stmt = $this->db->prepare("SELECT id,local_id,descricao,codAmb,iniValid,fimValid,dscAmb,localAmb,tpInsc,nrInsc,nrInsc
			from empresa_grupo
			where id = :ID and clinica_id = :CLINICA_ID");
		$stmt->bindParam(':ID',$grupo, PDO::PARAM_INT);
		$stmt->bindParam(':CLINICA_ID', $this->session->userdata('clinica_id'), PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		return $resultado;		
	}
	
	public function editarGrupo($dados=null)
	{
		$stmt = $this->db->prepare("UPDATE empresa_grupo set descricao=:DESCRICAO,codAmb=:CODAMB,iniValid=:INIVALID,
			fimValid=:FIMVALID,dscAmb=:DSCAMB,localAmb=:LOCALAMB,tpInsc=:TPINSC,
			nrInsc=:NRINSC
			WHERE id = :ID and empresa_id = :EMPRESA_ID and clinica_id = :CLINICA_ID");
		
		$stmt->bindParam(':ID',element('id', $dados), PDO::PARAM_INT);
		$stmt->bindParam(':EMPRESA_ID', element('EmpresaID', $dados), PDO::PARAM_INT);
		$stmt->bindParam(':CLINICA_ID', element('ClinicaID', $dados), PDO::PARAM_INT);		
		$stmt->bindParam(':DESCRICAO',element('descricao', $dados), PDO::PARAM_STR);

		$stmt->bindParam(':CODAMB',element('codAmb', $dados), PDO::PARAM_STR);
		$stmt->bindParam(':INIVALID',element('iniValid', $dados), PDO::PARAM_STR);
		$stmt->bindParam(':FIMVALID',element('fimValid', $dados), PDO::PARAM_STR);
		$stmt->bindParam(':DSCAMB',element('dscAmb', $dados), PDO::PARAM_STR);
		$stmt->bindParam(':LOCALAMB', element('localAmb', $dados), PDO::PARAM_INT);
		$stmt->bindParam(':TPINSC', element('tpInsc', $dados), PDO::PARAM_INT);
		$stmt->bindParam(':NRINSC',element('nrInsc', $dados), PDO::PARAM_STR);
		if($stmt->execute())
		{
			return true;
		}
		else
		{
			return false;
		}
	}	
		
	public function inserirProgDoc($dados){
		//print_r($dados); exit;
		$dataInicio = explode("-",$dados['data_inicio']);
		$dataFim = explode("-",$dados['data_fim']);
		//$dataInicio[2]."/".$dataInicio[1]."/".$dataInicio[0]
		$stmt = $this->db->prepare("INSERT INTO empresa_local_prog_doc (id_local,id_tabela,data_inicio,data_fim,clinica_id) VALUES (:LOCAL,:TABELA,:DATA_INICIO,:DATA_FIM,:CLINICA_ID)");
		
		$stmt->bindParam(':LOCAL',element('idLocal', $dados), PDO::PARAM_INT);
		$stmt->bindParam(':TABELA',element('idTabela', $dados), PDO::PARAM_INT);
		$stmt->bindParam(':CLINICA_ID', $this->session->userdata('clinica_id'), PDO::PARAM_INT);
		$stmt->bindParam(':DATA_INICIO',element('data_inicio', $dados), PDO::PARAM_STR);
		$stmt->bindParam(':DATA_FIM',element('data_fim', $dados), PDO::PARAM_STR);
		
		if($stmt->execute())
		{
			return true;
		}
		else
		{
			return false;
		}			
	}
	
	public function listarProgDoc($local = null){
		$stmt = $this->db->prepare("select empresa_local_prog_doc.id, DATE_FORMAT(empresa_local_prog_doc.data_inicio, '%d/%m/%Y') as data_inicio, DATE_FORMAT(empresa_local_prog_doc.data_fim, '%d/%m/%Y') as data_fim,
			tabela_programa_documento.descricao from empresa_local_prog_doc 
			inner join tabela_programa_documento on (tabela_programa_documento.id = empresa_local_prog_doc.id_tabela)
			where empresa_local_prog_doc.id_local = :ID and empresa_local_prog_doc.clinica_id=:CLINICA_ID
			order by empresa_local_prog_doc.id desc");
		$stmt->bindParam(':ID', $local, PDO::PARAM_INT);
		$stmt->bindParam(':CLINICA_ID', $this->session->userdata('clinica_id'), PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $resultado;			
	}	

	public function listarTabelaProgDoc(){
		$stmt = $this->db->prepare("select id, descricao from tabela_programa_documento order by descricao");
		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $resultado;	
	}	
		
	public function listarRiscosPorGrupo($grupo = null){
		$stmt = $this->db->prepare("select riscos_ocupacionais.cod_esocial, tipo_riscos_ocupacionais.descricao as descricao_tipo, 
			riscos_ocupacionais.descricao as descricao_risco
			from empresa_profissao_riscos 
			inner join riscos_ocupacionais on (empresa_profissao_riscos.risco_id = riscos_ocupacionais.id)
			inner join tipo_riscos_ocupacionais on (tipo_riscos_ocupacionais.id = riscos_ocupacionais.id_tipo_risco)
			where empresa_profissao_riscos.ativo = 'T'
			and empresa_profissao_riscos.grupo_id =:ID and empresa_profissao_riscos.clinica_id = :CLINICA_ID
			order by tipo_riscos_ocupacionais.descricao, riscos_ocupacionais.descricao");
		
		$stmt->bindParam(':ID', $grupo, PDO::PARAM_INT);							
		$stmt->bindParam(':CLINICA_ID', $this->session->userdata('clinica_id'), PDO::PARAM_INT);							
		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $resultado;	
	}
	

	public function listarEmpresaGrupoEpi($grupo = null){
		$stmt = $this->db->prepare("select descricao_resumida,ca,validade FROM empresa_grupo_epi WHERE grupo_id=:ID and clinica_id=:CLINICA_ID");
		
		$stmt->bindParam(':ID', $grupo, PDO::PARAM_INT);							
		$stmt->bindParam(':CLINICA_ID', $this->session->userdata('clinica_id'), PDO::PARAM_INT);//lembrar de voltar pra PARAM							
		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $resultado;	
	}		
	*/
}