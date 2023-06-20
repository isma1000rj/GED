<?php
require_once dirname(__FILE__).'/../consultas/sqlLog.php';
$operacao=new log();
$acao=$_REQUEST['acao'];
if(isset($_REQUEST['fltr'])){ 
$_SESSION['filtroPesquisa']=$_REQUEST['fltr'];/*Evita que o valor da pesquisa se perca quando a pesquisa é utilizada*/
}
/* verifica a origem da acao se listarLog executa uma consulta caso contrario executa outro
isso foi utilizado pois,em casos de busca o resultado total de páginas depende do filtro 
passado pelo usuário*/
if(isset($_REQUEST['pg'])){
	$numeroPagina=$_REQUEST['pg'];
}
if(isset($_REQUEST['codigo'])){
	 $idLog=$_REQUEST['codigo'];
	 $idDocumento=$_REQUEST['codigo'];
}
$idUsuario=$_SESSION['idUsuario'];
$idPerfilUsuario=$_SESSION['idPerfil'];
 
if($acao=="listarLog"){ 
if(!isset($numeroPagina))
	      $numeroPagina=0;
	if($numeroPagina <= 0){
	 	$paginaAtual=1;
		$_REQUEST['pg']=1;
	  }else{
		  $paginaAtual=$numeroPagina;
	   }
$limiteDePaginas=ceil ($operacao->contaRegistroDocumento()/$operacao->resultadosPorPagina);
$_SESSION['limiteDePaginas']=$limiteDePaginas;
if($paginaAtual > $limiteDePaginas){ /*Evita que a variável receba um valor diferente da quantidade real de páginas :) */
   		$paginaAtual=1;
   		$_REQUEST['pg']=1;
}
$proximaPagina = ($paginaAtual * $operacao->resultadosPorPagina) - $operacao->resultadosPorPagina;
$operacao->listarLog($proximaPagina,$operacao->resultadosPorPagina);
require('formListaLog.php');
}

if($acao=="pesquisarLog"){
if(!isset($numeroPagina))
	      $numeroPagina=0;
	if($numeroPagina <= 0){
	 	$paginaAtual=1;
		$_REQUEST['pg']=1;
	  }else{
		  $paginaAtual=$numeroPagina;
	   }
$limiteDePaginas=ceil ($operacao->contaRegistroPesquisa($_SESSION['filtroPesquisa'])/$operacao->resultadosPorPagina);
$_SESSION['limiteDePaginas']=$limiteDePaginas;
if($paginaAtual > $limiteDePaginas){ /*Evita que a variável receba um valor diferente da quantidade real de páginas :) */
   		$paginaAtual=1;
   		$_REQUEST['pg']=1;
}
$proximaPagina = ($paginaAtual * $operacao->resultadosPorPagina) - $operacao->resultadosPorPagina;
$operacao->pesquisarLog($_SESSION['filtroPesquisa'],$proximaPagina,$operacao->resultadosPorPagina);
require('formListaLog.php');
}

if($acao=="excluirLog"){

 $operacao->excluirLog($_REQUEST['codigo']);
 }
?>