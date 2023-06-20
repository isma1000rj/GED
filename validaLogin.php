<?php 
session_start();
$_SESSION['idiomaSelecionado']=$_POST['cbxIdioma'];
require_once dirname(__FILE__).'/util/conecta.php';
require_once dirname(__FILE__).'/consultas/sqlPermissao.php';
require_once dirname(__FILE__).'/util/config.php';//arquivo de configuração da tradução
require_once  dirname(__FILE__).'/util/i18n.php';  //Funções para o gettext
$operacao=new permissao();

if(($_POST['txLoginUsuario']!="") and  ($_POST['txSenhaUsuario']!="")){
	
	
	$sql="Select * from usuario where login='".addslashes($_POST['txLoginUsuario'])."' and senha='".sha1(addslashes($_POST['txSenhaUsuario']))."'";
	$resultado=$conecta->banco->Execute($sql);
	
	  if($resultado=$resultado->FetchNextObj()){
		  
     	   		  	 $dataAtual= date('d-m-Y');
					 $_SESSION['idUsuario']=$resultado->id_usuario;
					 $_SESSION['idPerfil']=$resultado->id_perfil; 
					 $_SESSION['nomeUsuario']=$resultado->nome;
					 $_SESSION['loginUsuario']=$resultado->login;
					 $operacao->listarPermissaoUsuario($_SESSION['idUsuario']);
					 $_SESSION['permissoesUsuario']=$operacao->resultado->FetchRow();
					 $_SESSION['tituloNavegador']=$operacao->getTitulo();
					 $_SESSION['logotipo']=$operacao->getLogo();
					 $operacao->RegistrarAcao($_SESSION['idUsuario'],$_SESSION['nomeUsuario'],$dataAtual,'current_time',getTranslateMsg("Accessed the System"));
					 direciona("index.php"); 
				}else{
					 $_SESSION['StLogin']="INVALIDO";
					 direciona("formLogin.php?locale=pt_BR");
					  
				}//fim o else if FetchNextObject
 }//fim do if $Post[login] e $Post[senha]

?>