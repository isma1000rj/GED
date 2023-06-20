<?php
ob_start();
session_start();
require_once dirname(__FILE__).'/../util/conecta.php';
require_once dirname(__FILE__).'/../util/config.php';//arquivo de configuração da tradução
require_once  dirname(__FILE__).'/../util/i18n.php';  //Funções para o gettext
	class documento{

	  var 	$resultado;
	  var   $registros;
	  var   $qtdRegistrosTipoDoc;
	  var   $qtdRegistrosNivelAcesso;
	  var   $resultadoNivelAcesso;
	  var   $dataAtual;
	  var   $resultadosPorPagina;

function documento(){

		   $this->conecta=new conexao();
		   $this->resultadosPorPagina=6;//Quantidade de registros por página
}

function listarTipoDocumento(){
			$sql="Select * from tipo_doc";
			$this->resultado=$this->conecta->banco->Execute($sql);

}// fim do function listarTipoDocumento.

function listarNivelAcesso(){

			$sql="Select * from nivel_acesso";
			$this->resultadoNivelAcesso=$this->conecta->banco->Execute($sql);
		}//fim do function listarNivelAcesso

function listarDocumento($idUsuario,$idPerfilUsuario,$proximaPagina,$resultadosPorPagina){
		  $sql="";
		 if($idPerfilUsuario==1){
				$sql="Select * from documento as d,tipo_doc as tp where d.id_tipo=tp.id_tipo ORDER by id_doc DESC LIMIT $proximaPagina, $resultadosPorPagina";
			}else{
				$sql="Select * from documento as d,tipo_doc as tp
			     	  where (id_usuario=".$idUsuario." or id_nivel=1) and (d.id_tipo=tp.id_tipo) ORDER by id_doc DESC LIMIT $proximaPagina, $resultadosPorPagina";
				}
			$this->resultado=$this->conecta->banco->Execute($sql);
		}//fim do function listarDocumento

function pesquisarDocumento($idUsuario,$descricaoDocumento,$idPerfilUsuario,$proximaPagina,$resultadosPorPagina){
$sql="";
if($idPerfilUsuario==1){//Se for administrador
	   	$sql="Select * from documento as d,tipo_doc as tp where (nome like '%".$descricaoDocumento."%' 
		or id_doc like '%".$descricaoDocumento."%' or autor like '%".$descricaoDocumento."%' 
		or extensao like '%".$descricaoDocumento."%' or data like '%".$descricaoDocumento."%' 
		or apelido like '%".$descricaoDocumento."%' or tp.descricao like '%".$descricaoDocumento."%') and (d.id_tipo=tp.id_tipo) 
		ORDER by id_doc DESC LIMIT $proximaPagina, $resultadosPorPagina";
	}
	else{
		$sql="Select * from documento as d,tipo_doc as tp  
		where (id_usuario=".$idUsuario." or id_nivel=1) and (nome like '%".$descricaoDocumento."%' 
		or id_doc like '%".$descricaoDocumento."%' or autor like '%".$descricaoDocumento."%' 
		or extensao like '%".$descricaoDocumento."%' or data like '%".$descricaoDocumento."%' 
		or apelido like '%".$descricaoDocumento."%' or tp.descricao like '%".$descricaoDocumento."%') and (d.id_tipo=tp.id_tipo) 
		ORDER by id_doc DESC LIMIT $proximaPagina, $resultadosPorPagina";
	}

		$this->resultado=$this->conecta->banco->Execute($sql);
		if($this->registros=$this->resultado->RecordCount()==0){
			geraAlertaInformacao("<h3>".getTranslateMsg("No record has been located!")."
<h3>","error","center","listarDocumento");
			}//fim do if

}//fim do function pesquisarDocumento

function excluirDocumento($idDocumento,$dataArquivo,$nomeArquivo,$idUsuario,$idPerfilUsuario){
		  $sql="delete from documento 
		  where id_doc=".$idDocumento."";
		  $dataAtual= date('d-m-Y');
		  if($this->verificaAutorDocumento($idDocumento,$idUsuario) or $idPerfilUsuario==1){//só permite que o autor e o administrador possam excluir um documento

		  	 if((unlink(dirname(__FILE__)."/../arquivos/".$dataArquivo."/".$nomeArquivo))){ //tenta remover o arquivo dentro do direórtio
					if($this->resultado=$this->conecta->banco->Execute($sql)){
							geraAlertaInformacao("<h3>".getTranslateMsg("The document has been successfully deleted!")."<h3>","success","center","listarDocumento");
							$this->RegistrarAcao($_SESSION['idUsuario'],$nomeArquivo,$dataAtual,'current_time',getTranslateMsg("Deleted Document"));//log da operação
					 }else {
					      geraAlertaInformacao("<h3>".getTranslateMsg("Failed to delete document!").   "<h3>","success","center","listarDocumento");
					    }//fim do if sql

			}else{
					geraAlertaInformacao("<h3>".getTranslateMsg("Unable to remove file!")."<h3>","error","center","listarDocumento");

		  	  }//fim do if que apaga o arquivo
		} else {
             geraNotificacao("<h3>".getTranslateMsg("Failed to delete the document. The document does not belong to the logged-in user!")."</h3>","error","div#areaNotificacao");
		} //fim do if ehAutorDocumento
	}//fim do function excluirDocumento

function selecionarDocumento($idDocumento){
		 $sql="Select * from documento
		       where id_doc=".$idDocumento."";
		 }

function gravarDocumento(){
		   ob_start();
		   $dataAtual= date('d-m-Y');/*Y-m-d*/
		   $arquivosPermitidos=array("pdf","PDF","odt","ODT","jpg","JPG","png","PNG","jpeg","JPEG","ods","ODS","odp","ODP");
		   $nomeArquivoCompleto=$_FILES['arquivoDescricao']['name'];
		   $extensao=pathinfo($nomeArquivoCompleto, PATHINFO_EXTENSION); //pega a extensao do arquivo
		   $nomeArquivo=pathinfo($nomeArquivoCompleto,PATHINFO_FILENAME); //pega o nome do arquivo
		   if(in_array($extensao,$arquivosPermitidos)){ //verifica se o arquivo tem a extensao permitida
				   if(!is_dir(dirname(__FILE__)."/../arquivos/".$dataAtual)){ //Verifica se existe um diretório com a data atual dentro de arquivos
				        mkdir(dirname(__FILE__)."/../arquivos/".$dataAtual); // cria o diretório  no formato ano-mes-dia dentro de arquivos
			   		}//fim do if que veirifica se o diretório existe

		  	 //Verifica se o arquivo já existe
		   	if(is_file(dirname(__FILE__)."/../arquivos/".$dataAtual."/".$nomeArquivoCompleto)){

			geraNotificacao("<h2>".getTranslateMsg("A file with this name already exists on the server.")."<h2>","error","div#areaNotificacao");
			   } else {
			   				/*tenta mover o arquivo para o servidor*/
			   			if(move_uploaded_file($_FILES['arquivoDescricao']['tmp_name'],dirname(__FILE__)."/../arquivos/".$dataAtual."/".$nomeArquivoCompleto)){

							$sql="insert into documento (id_nivel,id_usuario,id_tipo,extensao,data,autor,nome,apelido) 
				  			     values (".$_REQUEST['cbxNivelAcesso'].",'".$_SESSION['idUsuario']."',".$_REQUEST['cbxTipoDocumento'].",'".$extensao."','".$dataAtual."','".$_SESSION['loginUsuario']."','$nomeArquivo','".$_REQUEST['txtNomeDocumento']."')";

				if($this->resultado=$this->conecta->banco->Execute($sql)){

				 geraPedidoContinuarCadastro("<h3>".getTranslateMsg("The document was saved successfully. Do you want to continue registering?")."<h3>","success","center","cadastrarDocumento","listarDocumento");

						$this->RegistrarAcao($_SESSION['idUsuario'],$nomeArquivoCompleto,$dataAtual,'current_time',"Gravou Documento");//log da operação
								}else{
								geraPedidoContinuarCadastro("<h2>".getTranslateMsg("Failed to save document.")."<h2><BR>".getTranslateMsg("Do you want to try again?"),"error","center","cadastrarDocumento","listarDocumento");
							 		} //fim do if executa SQL
					  	}else{
					  	 	 geraNotificacao("<h2>".getTranslateMsg("Failed to upload file!")."<h2>","error","div#areaNotificacao");
					  	 	  }//fim do if move_uoload
			   }//fim do if que verifica se o arquivo existe
		}else {geraNotificacao("<h2>".getTranslateMsg("File type not allowed!")."<h2>","error","div#areaNotificacao");}// fim do if in_array
}//fim do function gravarDocumento

function verificaAutorDocumento($idDocumento,$idUsuario){

		 $sql="select * from documento 
		        where id_doc=".$idDocumento." and id_usuario=".$idUsuario."";
		 $this->resultado=$this->conecta->banco->Execute($sql);
		 $this->registros=$this->resultado->FetchNextObject();

		 if($this->registros=$this->resultado->RecordCount()!=0)
		   		return true;
		   else
		   		return false;
}

function contarRegistrosPaginacaoResultado($acao,$idUsuario,$idPerfilUsuario,$filtroPesquisa){
	$sql="";
	$sqlFiltrado="";
if($idPerfilUsuario==1){
	  $sql="select *  from documento";
	  $sqlFiltrado="Select * from documento where nome like '%".$filtroPesquisa."%' 
		or id_doc like '%".$filtroPesquisa."%' or autor like '%".$filtroPesquisa."%' 
		or extensao like '%".$filtroPesquisa."%' or data like '%".$filtroPesquisa."%'
		or apelido like '%".$filtroPesquisa."%'";
	}
	else{
		$sql="Select * from documento where (id_usuario=".$idUsuario." or id_nivel=1)";
		$sqlFiltrado="Select * from documento where (id_usuario=".$idUsuario." or id_nivel=1) and nome like '%".$filtroPesquisa."%' 
		or id_doc like '%".$filtroPesquisa."%' or autor like '%".$filtroPesquisa."%' 
		or extensao like '%".$filtroPesquisa."%' or data like '%".$filtroPesquisa."%' 
		or apelido like '%".$filtroPesquisa."%'";

	}
	if($acao=="listarDocumento"){
			$this->resultado=$this->conecta->banco->Execute($sql);
	 	 }
			else{
    	       $this->resultado=$this->conecta->banco->Execute($sqlFiltrado);
	        }
		 $this->registros=$this->resultado->FetchNextObject();
         return $this->qtdRegistrosTipoDoc=$this->resultado->RecordCount();

}//fim do function contarRegistrosPaginacaoResultado


function contaRegistros(){
	$sql="select *  from documento";
	$this->resultado=$this->conecta->banco->Execute($sql);
	$this->registros=$this->resultado->FetchNextObject();
    return $this->qtdRegistrosTipoDoc=$this->resultado->RecordCount();

}

function contaRegistrosTipoDoc(){
 $sql="select *  from tipo_doc";
 $this->resultado=$this->conecta->banco->Execute($sql);
 $this->registros=$this->resultado->FetchNextObject();
 return $this->qtdRegistrosTipoDoc=$this->resultado->RecordCount();


}

function contaRegistrosNivelAcesso(){

		 $sql="select *  from nivel_acesso";
		 $this->resultado=$this->conecta->banco->Execute($sql);
		 $this->registros=$this->resultado->FetchNextObject();
         return $this->qtdRegistrosNivelAcesso=$this->resultado->RecordCount();

}

function RegistrarAcao($idUsuario,$nomeDocumento,$data,$hora,$acao){
			$sql="insert into log_acesso_documento(id_usuario,nome_documento,data,hora,operacao)
		      values('".$idUsuario."','$nomeDocumento','$data',$hora,'".$acao."')";
			$this->resultado=$this->conecta->banco->Execute($sql);

}// fim do function registrar acao sobre o documento

}
ob_end_flush();
?>