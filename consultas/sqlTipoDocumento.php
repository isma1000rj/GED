<?php
 require_once dirname(__FILE__).'/../util/conecta.php';
	class tipoDocumento{
		
	  var 	$resultado;
	  var   $registros;
	  var   $qtdRegistrosTipoDoc;
	  var   $resultadosPorPagina;
	  var   $dataAtual;	

	   function tipoDocumento(){
		   
		   $this->conecta=new conexao();
		   $this->resultadosPorPagina=6;
		   $this->dataAtual=date('d-m-Y');
		   
	     }	
		
		function incluirTipoDocumento($tipoDocumento){
			$sql="Insert into tipo_doc (descricao) values('$tipoDocumento')";
			
			if(!$this->existeTipoCadastrado($tipoDocumento)){
				if($this->resultado=$this->conecta->banco->Execute($sql)){
					geraAlertaInformacao("<h3><BR>".getTranslateMsg("Successful registration.")."<h3>","success","center","listarTipoDocumento");
				   			  $this->RegistrarAcao($_SESSION['idUsuario'],$tipoDocumento,$this->dataAtual,'current_time',getTranslateMsg("Registered document type"));
						}else{ 
							 geraAlertaInformacao("<h3><BR>".getTranslateMsg("Failed to register document type.")."<h3>","error","center","cadastrarTipoDoc");
						
							}
    				}else{
						geraAlertaInformacao("<h3><BR>".getTranslateMsg("Type of document already registered.")."<h3>","error","center","cadastrarTipoDoc");
				} //fim do if existeTipoCadastrado

		}//fim do function incluirTipoDocumento
		
	    function listarTipoDocumento($proximaPagina,$resultadosPorPagina){
			$sql="Select * from tipo_doc 
			      ORDER by id_tipo ASC LIMIT $proximaPagina,$resultadosPorPagina";
		    $this->resultado=$this->conecta->banco->Execute($sql);
		   }
		
		function excluirTipoDocumento($idTipoDocumento){
			$sql="delete from tipo_doc 
			      where id_tipo=".$idTipoDocumento."";
			 $descricaoTipo=$this->getDescricaoTipo($idTipoDocumento);
			if(!$this->existeDocumentoAssociado($idTipoDocumento)){
			 
				 if($this->resultado=$this->conecta->banco->Execute($sql)){
					geraAlertaInformacao("<h3><BR>".getTranslateMsg("Deletion successfully completed.")."<h3>","success","center","listarTipoDocumento");
					$this->RegistrarAcao($_SESSION['idUsuario'],$descricaoTipo,$this->dataAtual,'current_time',getTranslateMsg("Deleted document type"));
					    
				     }else{
							geraAlertaInformacao("<h3>".getTranslateMsg("Failed to delete the document type.")."<h3>","error","center","listarTipoDocumento");
				    	}//fim do if execute($sql)
	       }else {
			   		geraAlertaInformacao("<h3><BR>".getTranslateMsg("Impossible to delete, because there are associated documents.")."<h3>","warning","center","listarTipoDocumento");
			  	 	 }//fim do existeDocumentoAssociado
		}//fim do function excluirTipoDcoucmento
		
		
	function existeDocumentoAssociado($idTipoDocumento){
			 
	   $sql="select * from documento
	        where id_tipo=".$idTipoDocumento."";
	 $this->resultado=$this->conecta->banco->Execute($sql);		
	 $this->registros=$this->resultado->FetchNextObject();
     
	 if($this->resultado->RecordCount() > 0)
	 		   return true;   
		else
	    		  return false; 
	  }//fim do existeDocumentoAssociado
		
		
	
 	    function selecionarTipoDocumento($idTipoDocumento){
			$sql="Select * from tipo_doc 
			      where id_tipo=".$idTipoDocumento."";
			$this->resultado=$this->conecta->banco->Execute($sql);
			$this->registros=$this->resultado->FetchNextObj();
			
	}
	
function atualizarTipoDocumento($idTipoDocumento,$descricao){
			$sql="update tipo_doc 
				  set descricao='".$descricao."'
			      where id_tipo=".$idTipoDocumento."";
			      $descricaoTipo=$this->getDescricaoTipo($idTipoDocumento);
			if($this->resultado=$this->conecta->banco->Execute($sql)){

					geraAlertaInformacao("<h3><BR>".getTranslateMsg("Update done successfully.")."<h3>","success","center","listarTipoDocumento");
				$this->RegistrarAcao($_SESSION['idUsuario'],$descricaoTipo,$this->dataAtual,'current_time',getTranslateMsg("Edited document type"));
				}else{
					
					geraAlertaInformacao("<h3><BR>".getTranslateMsg("Failed to perform update.")."<h3>","error","center","listarTipoDocumento");	
				 }//fim do executa sql
		}//fim da function atualizarTipoDocumento
	
function pesquisarTipoDocumento($descricaoDocumento,$proximaPagina,$resultadosPorPagina){
		$sql="select * from tipo_doc
		     where descricao like '%".$descricaoDocumento."%' or id_tipo like '%".$descricaoDocumento."%'
		     ORDER by id_tipo ASC LIMIT $proximaPagina,$resultadosPorPagina";
		$this->resultado=$this->conecta->banco->Execute($sql);
		if($this->registros=$this->resultado->RecordCount()==0){
			geraAlertaInformacao("<h3>BR>".getTranslateMsg("No record has been located!")."<h3>","error","center","listarTipoDocumento");
			}
		
	}//fim da function pesquisarDocumento

function existeTipoCadastrado($tipoDocumento){
		  $sql="Select * from tipo_doc
	    	  where descricao='".$tipoDocumento."';";
	     	$this->resultado=$this->conecta->banco->Execute($sql);
		 	if($this->registros=$this->resultado->RecordCount()>0)
	       		{
	       	 			return true;
	       			}else{

	       				return false;
	       			}
	} //fim do function existeTipoCadastrado

function getDescricaoTipo($idTipo){
	    	$sql="Select descricao from tipo_doc
	    	      where id_tipo='".$idTipo."'";
	    	$this->resultado=$this->conecta->banco->Execute($sql);
	    	$this->registros=$this->resultado->FetchNextObj();
			return $this->registros->descricao;
		  }//fim do function SelecionarUsuario



 function contaRegistros(){

 $sql="Select * from tipo_doc";
 $this->resultado=$this->conecta->banco->Execute($sql);
 $this->registros=$this->resultado->FetchNextObject();
 return $this->registros=$this->resultado->RecordCount();	

}//fim do function contaRegistros

function contaRegistrosPesquisa($descricaoDocumento){
	$sql="Select * from tipo_doc 
     where descricao like '%".$descricaoDocumento."%'";
 $this->resultado=$this->conecta->banco->Execute($sql);
 $this->registros=$this->resultado->FetchNextObject();
 return $this->registros=$this->resultado->RecordCount();

}

function RegistrarAcao($idUsuario,$descricao,$data,$hora,$acao){
			
			$sql="insert into log_acesso_documento(id_usuario,nome_documento,data,hora,operacao)
			      values('".$idUsuario."','$descricao','$data',$hora,'".$acao."')";
			$this->resultado=$this->conecta->banco->Execute($sql);
		     			
}// fim do function registrar acao sobre tipo de documento
	
}//fim da classe TipoDocumento
?>