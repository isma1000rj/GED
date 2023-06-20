<?php
require_once dirname(__FILE__).'/../consultas/sqlPermissao.php';
$operacao=new permissao();

if(isset($_REQUEST['cbxNomeUsuario'])){
$idUsuarioSelecionado=$_REQUEST['cbxNomeUsuario'];//pega o value selecionado do combo
}
if(isset($_REQUEST['acao'])){
	$acao=$_REQUEST['acao'];
}
//verifica se os checkbox's estão marcados
if(isset($_REQUEST['cxSelcCadastraUsuario'])){
	        $cdrUsuario="S";
	}else{
	        $cdrUsuario="N";
}
if(isset($_REQUEST['cxSelecCadastrarDocumento'])){
		   $cdrDocumento="S";
	}else{
	       $cdrDocumento="N";
} 
if(isset($_REQUEST['cxSelecCadastrarTipoDocumento'])){
		   $cdrTpDocumento="S";
	}else{
		 $cdrTpDocumento="N";
}
if(isset($_REQUEST['cxSelecCadastrarPermissaoAcesso'])){
		 $cdrPermissaoAcesso="S";
	}else{    
         $cdrPermissaoAcesso="N";
}

if(isset($_REQUEST['cxSelecListarDocumento'])){
	  $lstDocumento="S";
		
}else{
     $lstDocumento="N";  	
}
if(isset($_REQUEST['cxSelecListarLog'])){
	    $lstLog="S";
		
}else{
	  $lstLog="N";
}
if(isset($_REQUEST['cxSelecListarUsuario'])){
		$lstUsuario="S";
		
}else{
	   $lstUsuario="N";
}
if(isset($_REQUEST['cxSelecListarTipoDocumento'])){
		 $lstTpDocumento="S";
		
}else{
	    $lstTpDocumento="N";
}
if(isset($_REQUEST['cxSelecCadastrarConfiguracao'])){
         $cdrConf="S";
}else{
		$cdrConf="N";
}

if($acao=="gravarPermissao"){

$operacao->gravarPermissao($idUsuarioSelecionado,$cdrUsuario,$cdrDocumento,$cdrTpDocumento,$cdrPermissaoAcesso,$lstDocumento,$lstLog,$lstUsuario,$lstTpDocumento,$cdrConf);
}
if($acao=="cadastrarPermissao"){
$operacao->contaRegistros();
$operacao->listarUsuario();
require("formCadastraPermissao.php");
}

if($acao=="carregarPermissao"){
$operacao->contaRegistros();
 $operacao->listarPermissaoUsuario($_GET['codigo']);
 
 require("formCadastraPermissao.php");
}

?>