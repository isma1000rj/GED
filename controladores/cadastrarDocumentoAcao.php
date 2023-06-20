<?php
require_once dirname(__FILE__).'/../consultas/sqlDocumento.php';
ob_start();
session_start();
$operacao=new documento();
if(isset($_REQUEST['fltr'])){
	$filtroPesquisa=$_REQUEST['fltr'];
}
if(isset($_SESSION['idUsuario'])){
	$idUsuario=$_SESSION['idUsuario'];
}
if(isset($_SESSION['idPerfil'])){
$idPerfilUsuario=$_SESSION['idPerfil'];	
}
if(isset($_REQUEST['acao'])){
	$acao=$_REQUEST['acao'];
}
if(isset($_GET['acao'])){
	$acao=$_GET['acao'];
}
if(isset($_REQUEST['codigo'])){
		$idDocumento=$_REQUEST['codigo'];
 		$dataArquivo=$_REQUEST['data'];
 		$nomeArquivo=$_REQUEST['nome'];
}
if($acao=="listarDocumento"){ /* Páginação de resultado*/
	if(isset($filtroPesquisa)){
$_SESSION['limiteDePaginas']=ceil ($operacao->contarRegistrosPaginacaoResultado($acao,$_SESSION['idUsuario'],$_SESSION['idPerfil'],$filtroPesquisa)/$operacao->resultadosPorPagina);
}
}
if(isset($_REQUEST['pg'])){
	$paginaAtual= $_REQUEST['pg'];
}
if(isset($_SESSION['limiteDePaginas']) and isset($paginaAtual)){
if($paginaAtual > $_SESSION['limiteDePaginas']){ /*Evita que a variável receba um valor diferente da quantidade real de páginas :) */
 		$paginaAtual=1;
   		$_REQUEST['pg']=1;
}// fim do if paginaAtual	
}
if(isset($_REQUEST['pg'])){
	$paginaAtual= $_REQUEST['pg'];
}
if(isset($_REQUEST['pg'])){
	$numeroPagina=$_REQUEST['pg'];
}
if($acao=="cadastrarDocumento"){
	$operacao->contaRegistrosTipoDoc();
	$operacao->contaRegistrosNivelAcesso();
	$operacao->listarTipoDocumento();
	$operacao->listarNivelAcesso();
	require('formCadastraDocumento.php');
}//fim do if 

if($acao=="gravarDocumento"){
	$operacao->gravarDocumento();
}
if($acao=="listarDocumento"){
	if(!isset($numeroPagina))
	      $numeroPagina=0;
	if($numeroPagina <= 0){
	 	$paginaAtual=1;
		$_REQUEST['pg']=1;
	  }else{
		  $paginaAtual=$numeroPagina;
}
/* determina o limite de registros que será utilizado na consulta*/
$proximaPagina = ($paginaAtual * $operacao->resultadosPorPagina) - $operacao->resultadosPorPagina;
	$operacao->listarDocumento($idUsuario,$idPerfilUsuario,$proximaPagina,$operacao->resultadosPorPagina);  	
	require('formListaDocumento.php');
}

if($acao=="excluirDocumento"){
	$operacao->excluirDocumento($idDocumento,$dataArquivo,$nomeArquivo,$idUsuario,$idPerfilUsuario);  	
}

if($acao=="pesquisarDocumento"){
  if(!isset($numeroPagina))
	      $numeroPagina=0;
	if($numeroPagina <= 0){
	 	$paginaAtual=1;
		$_REQUEST['pg']=1;
	  }else{
		  $paginaAtual=$numeroPagina;
	   }
$proximaPagina = ($paginaAtual * $operacao->resultadosPorPagina) - $operacao->resultadosPorPagina;
$operacao->pesquisarDocumento($idUsuario,$filtroPesquisa,$_SESSION['idPerfil'],$proximaPagina,$operacao->resultadosPorPagina);
require('formListaDocumento.php');
}
ob_end_flush();
?>