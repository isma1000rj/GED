<?php
  require_once dirname(__FILE__).'/../util/conecta.php';
	class log{
		
	  var 	$resultado;
	  var   $registros;
	  var   $resultadosPorPagina;
	  var   $proximaPagina;
	  var   $paginaAtual;
	  var   $qtdRegistros;

  function log(){
		   
		   $this->conecta=new conexao();
		   $this->resultadosPorPagina=6;
	 }	
function listarLog($proximaPagina,$resultadosPorPagina){
			$sql = "Select id_log,nome_documento,data,hora,operacao,u.login from log_acesso_documento as lg,usuario as u
			       where lg.id_usuario=u.id_usuario ORDER by data DESC LIMIT $proximaPagina, $resultadosPorPagina";	   
			$this->resultado=$this->conecta->banco->Execute($sql);
}
function pesquisarLog($descricao,$proximaPagina,$resultadosPorPagina){
	   $sql="Select id_log,nome_documento,data,hora,operacao,u.login from log_acesso_documento as lg,usuario as u
			 where (lg.id_usuario=u.id_usuario) and  (nome_documento like '%$descricao%' or data like '%$descricao%' 
			 or hora like '%$descricao%' or login like '%$descricao%' or operacao like '%$descricao%') 
			 order by data DESC LIMIT $proximaPagina, $resultadosPorPagina";

		$this->resultado=$this->conecta->banco->Execute($sql);
		if($this->registros=$this->resultado->RecordCount()==0){
			geraAlertaInformacao("<h3>".getTranslateMsg("No record has been located!")."<h3>","error","center","listarLog");
    	   }//fim do if
		}//fim do function pesquisarDocumento		

function contaRegistroDocumento(){
	$sql="Select id_log,nome_documento,data,hora,operacao,u.login from log_acesso_documento as lg,usuario as u
		  where lg.id_usuario=u.id_usuario";
		$this->resultado=$this->conecta->banco->Execute($sql);
		$this->registros=$this->resultado->FetchNextObject();
    	return $this->qtdRegistros=$this->resultado->RecordCount();
}//fim do contaRegistros
	   
function contaRegistroPesquisa($descricao){
	$sql="Select id_log,nome_documento,data,hora,operacao,u.login from log_acesso_documento as lg,usuario as u
       where (lg.id_usuario=u.id_usuario) and (nome_documento like '%$descricao%' or data like '%$descricao%' 
	   or hora like '%$descricao%' or login like '%$descricao%' or operacao like '%$descricao%' )";   	
	$this->resultado=$this->conecta->banco->Execute($sql);
	$this->registros=$this->resultado->FetchNextObject();
    return $this->qtdRegistros=$this->resultado->RecordCount();
}	  

function excluirLog($idLog){
 $sql="delete from log_acesso_documento where id_log=$idLog";
 if($this->resultado=$this->conecta->banco->Execute($sql)){
    geraAlertaInformacao("<h3>".getTranslateMsg("Log deleted successfully.")."<h3>","success","center","listarLog");
 }else{
     geraAlertaInformacao("<h3>".getTranslateMsg("Failed to delete log.")."<h3>","error","center","listarLog");
}//fim do function excluirLog
} 
}//fim da classe LOG
?>