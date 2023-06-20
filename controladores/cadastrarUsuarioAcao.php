<?php 
 require_once dirname(__FILE__).'/../consultas/sqlUsuario.php';
 require_once dirname(__FILE__).'/../consultas/sqlPermissao.php';
$opUsuario=new usuario();
$opPermissao=new permissao();
$acao=$_REQUEST['acao'];
if(isset($_REQUEST['txtNomeUsuario'])){
$_SESSION['txNomeUsuario']=$_REQUEST['txtNomeUsuario'];
}
if(isset($_REQUEST['fltr'])){
$filtroPesquisa=$_REQUEST['fltr'];
}

if(isset($_REQUEST['pg'])){
	$numeroPagina=$_REQUEST['pg'];
}
if(isset($_REQUEST['codigo'])){
	$id_tipo=$_REQUEST['codigo'];
}

if($acao=='listarUsuario'){
if(!isset($numeroPagina))
	      $numeroPagina=0;
	if($numeroPagina <= 0){
	 	$paginaAtual=1;
		$_REQUEST['pg']=1;
	  }else{
		  $paginaAtual=$numeroPagina;
	   }
$_SESSION['limiteDePaginas']=ceil($opUsuario->contaRegistros()/$opUsuario->resultadosPorPagina);
$paginaAtual= $_REQUEST['pg'];
if($paginaAtual > $_SESSION['limiteDePaginas']){ /*Evita que a variável receba um valor diferente da quantidade real de páginas :) */
   		$paginaAtual=1;
   		$_REQUEST['pg']=1;
}
/* determina o limite de registros que será utilizado na consulta*/
$proximaPagina = ($paginaAtual * $opUsuario->resultadosPorPagina) - $opUsuario->resultadosPorPagina;
/* Executa a consulta SQL*/
$opUsuario->listarUsuario($proximaPagina,$opUsuario->resultadosPorPagina);	
require('formListaUsuario.php');	
}//fim do if listarUsuario

if($acao=='cadastrarUsuario'){
 require('formCadastraUsuario.php');	
}

if($acao=='cadastraNovoUsuario'){
 $resultadoCadastro=$opUsuario->incluirUsuario($_REQUEST['cbxPerfilUsuario'],$_REQUEST['txtNomeUsuario'],$_REQUEST['txtLogin'],$_REQUEST['txtSenha']);	
 $UsuarioId=$opUsuario->selecionaIdUsuario($_SESSION['txNomeUsuario']);
 // evita que remova a permissão de usuário já cadastrado caso alguém tente recadastra-lo
 if(!$resultadoCadastro==0){ 
 $opPermissao->gravarPermissao($UsuarioId,"N","N","N","N","N","N","N","N","N");//Cadastra a permissao do usuário
}
 require('formListaUsuario.php');	
 
}
if($acao=='excluirUsuario'){
$opUsuario->excluirUsuario($_REQUEST['codigo']);
}
if($acao=='alterarUsuario'){
	$opUsuario->selecionarUsuario($_REQUEST['codigo']);
	require('formCadastraUsuario.php');
}

if($acao=='atualizarUsuario'){
	$opUsuario->atualizarUsuario($_REQUEST['txtNomeUsuario'],$_REQUEST['txtLogin'],$_REQUEST['txtSenha'],$_REQUEST['cbxPerfilUsuario'],$_REQUEST['codigo']);
}
if($acao=='pesquisarUsuario'){
	/*Paginação de resultado pesquisarUsuario*/
	$_SESSION['limiteDePaginas']=ceil ($opUsuario->contaRegistrosPequisa($filtroPesquisa)/$opUsuario->resultadosPorPagina);
	
	if(isset($_REQUEST['pg'])){
		$paginaAtual= $_REQUEST['pg'];
	} else{
		$paginaAtual= 1;
	}

if(isset($paginaAtual)){
	if($paginaAtual > $_SESSION['limiteDePaginas']){ /*Evita que a variável receba um valor diferente da quantidade real de páginas :) */
 		$paginaAtual=1;
   		$_REQUEST['pg']=1;
}// fim do if paginaAtual	
}//fim do isset
if(isset($_REQUEST['pg'])){
if($_REQUEST['pg'] < $_SESSION['limiteDePaginas']){/* Evita que a váriavel receba um valor igual a zero ou negativo*/
      $_REQUEST['pg']=$_REQUEST['pg'] + 1;
    }
}//fim do isset
if(isset($paginaAtual)){
	if($paginaAtual==1){
     $paginaAtual=2;  
  }
}//fim do isset
/*Controla a passagem entre as páginas*/
if(isset($_REQUEST['pg'])){
	$numeroPagina=$_REQUEST['pg'];
}else{
	$numeroPagina=0;
}
if($numeroPagina <= 0){
    	$paginaAtual=1;
		$_REQUEST['pg']=1;
  }else{
	  $paginaAtual=$numeroPagina;
}
/* determina o limite de registros que será utilizado na consulta*/

$proximaPagina = ($paginaAtual * $opUsuario->resultadosPorPagina) - $opUsuario->resultadosPorPagina;
$opUsuario->PesquisarUsuario($filtroPesquisa,$proximaPagina,$opUsuario->resultadosPorPagina);
require('formListaUsuario.php');
}//fim do if pesquisarUsuario
?>