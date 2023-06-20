<?php 
require_once dirname(__FILE__).'/../consultas/sqlTipoDocumento.php';
$operacao=new tipoDocumento();
if(isset($_REQUEST['fltr'])){
	$filtroPesquisa=$_REQUEST['fltr'];
}
$acao=$_REQUEST['acao'];

if(isset($_REQUEST['codigo'])){
	$id_tipo=$_REQUEST['codigo'];
}

if(isset($_REQUEST['pg'])){/*Pega o número da página para paginar o resultado*/
	$numeroPagina=$_REQUEST['pg'];
}

if($acao=='cadastrarTipoDoc'){
  require('formCadastraTipoDocumento.php');	
 }//fim do function CadastraTipoDoc

if($acao=='listarTipoDocumento'){
$_SESSION['limiteDePaginas']=ceil ($operacao->contaRegistros()/$operacao->resultadosPorPagina);
	if(!isset($numeroPagina)){
	      $numeroPagina=0;
	 }
     if($numeroPagina <= 0){
		 		$paginaAtual=1;
				$_REQUEST['pg']=1;
	  }else{
		 	 $paginaAtual=$numeroPagina;
   	     }
if($paginaAtual > $_SESSION['limiteDePaginas']){ /*Evita que a variável receba um valor diferente da quantidade real de páginas :) */
   		$paginaAtual=1;
   		$_REQUEST['pg']=1;
}
/* determina o limite de registros que será utilizado na consulta*/
$proximaPagina = ($paginaAtual * $operacao->resultadosPorPagina) - $operacao->resultadosPorPagina;
/* Executa a consulta SQL*/
$operacao->listarTipoDocumento($proximaPagina,$operacao->resultadosPorPagina);
require('formListaTipoDocumento.php');
}//fim do function listarTipoDocumento

if ($acao=='gravaTipoDoc'){
$operacao->incluirTipoDocumento($_POST['txtTipoDocumento']);	
}//fim do function gravaTipoDoc

if($acao=='excluirTipoDoc'){
  $operacao->excluirTipoDocumento($id_tipo);	
}//fim do function ExluirTipoDoc

if($acao=='alterarTipoDoc'){
    $operacao->selecionarTipoDocumento($id_tipo);
	require('formCadastraTipoDocumento.php');		
}//fim do function alterarTipoDoc

if($acao=='atualizarTipoDoc'){
    $operacao->atualizarTipoDocumento($id_tipo,$_REQUEST['txtTipoDocumento']);
}//fim do function atualizarTipoDoc

if($acao=='pesquisarTipoDocumento'){
$_SESSION['limiteDePaginas']=ceil ($operacao->contaRegistrosPesquisa($filtroPesquisa)/$operacao->resultadosPorPagina);
	if(!isset($numeroPagina)){
	      $numeroPagina=0;
	 }
     if($numeroPagina <= 0){
		 		$paginaAtual=1;
				$_REQUEST['pg']=1;
	  }else{
		 	 $paginaAtual=$numeroPagina;
   	     }
if($paginaAtual > $_SESSION['limiteDePaginas']){ /*Evita que a variável receba um valor diferente da quantidade real de páginas :) */
   		$paginaAtual=1;
   		$_REQUEST['pg']=1;
}
/* determina o limite de registros que será utilizado na consulta*/
$proximaPagina = ($paginaAtual * $operacao->resultadosPorPagina) - $operacao->resultadosPorPagina;
$operacao->pesquisarTipoDocumento($filtroPesquisa,$proximaPagina,$operacao->resultadosPorPagina);
require('formListaTipoDocumento.php');		
}//fim do function pesquisarTipoDocumento


?>