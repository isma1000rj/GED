<?php 
require_once dirname(__FILE__).'/../consultas/sqlConfig.php';
$operacao=new configuracao();
if(isset($_REQUEST['fltr'])) {
 	$filtroPesquisa=$_REQUEST['fltr'];
 }
$acao=$_REQUEST['acao'];
if(isset($_REQUEST['txtNomeEmpresa'])){
	$nomeEmpresa=$_REQUEST['txtNomeEmpresa'];
}
if(isset($_REQUEST['txtLogo'])){
	$nomeLogo=$_REQUEST['txtLogo'];
}
if(isset($_REQUEST['txtTitulo'])){
	$tituloNavegador=$_REQUEST['txtTitulo'];
}

if(isset($_REQUEST['codigo'])){
	$id_tipo=$_REQUEST['codigo'];
}
if($acao=='config'){
  $operacao->listarConfiguracao();	
  require('formCadastraConfig.php');	
 }//fim do function CadastraTipoDoc

if($acao=='gravarConfig'){
  $operacao->gravarConfiguracao($nomeEmpresa,$nomeLogo,$tituloNavegador,$_SESSION['idUsuario']);

}


?>