<?php
error_reporting(E_ALL ^ E_DEPRECATED);

header ('Content-type: text/html; charset=UTF-8');
session_start();
if(!isset($_SESSION['idUsuario'])){

    require_once dirname(__FILE__).'/util/funcoes.php';
   	direciona("formLogin.php?locale=pt_BR");

}else {
    require_once dirname(__FILE__).'/util/config.php';//arquivo de configuração da tradução
    require_once  dirname(__FILE__).'/util/i18n.php';  //Funções para o gettext
   	$permissoes=$_SESSION['permissoesUsuario'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Cache-control" content="No-Cache; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="util/_css/index.css">
<link rel="stylesheet" type="text/css" href="util/_css/cuscosky.css">
<link rel="stylesheet" type="text/css" href="util/_css/animate.css">
<link rel="stylesheet" type="text/css" href="util/_css/buttons.css">
<script type="text/javascript" src="util/jq/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="util/jq/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="util/jq/jquery.form.js"></script>
<script type="text/javascript" src="util/js/noty/packaged/jquery.noty.js"></script>
<script type="text/javascript" src="util/js/noty/packaged/jquery.noty.packaged.js"></script>
<script type="text/javascript" src="util/geraNotificacao.js"></script>
<script type="text/javascript" src="util/js/validaCampos.js"></script>
<title><?php echo $_SESSION['tituloNavegador']?></title>
</head>
<body>

<header class="barra-superior">
<img src="imagens/<?php echo $_SESSION['logotipo']?>"/>
<div class="menu-superior">
  <p > <?php translateMsg('Welcome')?>:<?php echo $_SESSION['nomeUsuario'];?></p> 
    <div class="botoes-barra-superior-direita" >
     <a href="index.php"><img  class="botaoHome" src="imagens/home-05.png" alt="<?php translateMsg('Home')?>" title="<?php translateMsg('Home')?>"/></a>
     <a href="index.php?acao=editorTexto"><img  class="botaoEditorTexto" src="imagens/editar.png" alt="<?php translateMsg('Text Editor')?>" title="<?php translateMsg('Text Editor')?>"/></a> 
     <a href="index.php?acao=config"><img class="botaoConfig" src="imagens/config.png" alt="<?php translateMsg('Settings')?>" title="<?php translateMsg('Settings')?>"></a>
     <a href="logoff.php"><img  class="botaoSair" src="imagens/exit.png" alt="<?php translateMsg('Exit')?>" title="<?php translateMsg('Exit')?>"/></a>
      </div>
  </div>
</header>

<div class="menu">
		<ul> 
		    <?php if($permissoes['cdr_documento']=='S'){?>   
			<li><a href="index.php?acao=cadastrarDocumento"><div class="imagensMenu"><img src="imagens/menu/documento.png"></div><?php translateMsg('Register Document')?></a></li>
        	<?php }?>
        	<?php if($permissoes['cdr_tpdocumento']=='S'){?>
			<li><a href="index.php?acao=cadastrarTipoDoc"><div class="imagensMenu"><img src="imagens/menu/tipoDoc.png"></div><?php translateMsg('Register Type of Document')?></a></li>
			<?php }?>
			<?php if($permissoes['cdr_usuario']=='S'){?>
			<li><a href="index.php?acao=cadastrarUsuario" ><div class="imagensMenu"><img src="imagens/menu/usuario.png"></div><?php translateMsg('Register User')?></a></li>
			<?php } ?>
			<?php if($permissoes['cdr_permissaoacesso']=='S'){?>
            <li><a href="index.php?acao=cadastrarPermissao"><div class="imagensMenu"><img src="imagens/menu/permissao.png"></div><?php translateMsg('Register Permission')?></a></li>
            <?php }?>
        	<?php if($permissoes['lst_documento']=='S'){?>
        	<li><a href="index.php?acao=listarDocumento"><div class="imagensMenu"><img src="imagens/menu/listarDocumento.png"></div><?php translateMsg('List Documents')?></a></li>
			<?php }?>
			<?php if($permissoes['lst_tpdocumento']=='S'){?>
			<li><a href="index.php?acao=listarTipoDocumento"><div class="imagensMenu"><img src="imagens/menu/listarTipoDoc.png"></div><?php translateMsg('List Type Documents')?></a></li>
			<?php }?>
			<?php if($permissoes['lst_usuario']=='S'){?>
			<li><a href="index.php?acao=listarUsuario"><div class="imagensMenu"><img src="imagens/menu/listarUsuario.png"></div><?php translateMsg('List User')?></a></li>
            <?php }?>
            <?php if($permissoes['lst_log']=='S'){?>
            <li><a href="index.php?acao=listarLog"><div class="imagensMenu"><img src="imagens/menu/listarLog.png"></div><?php translateMsg('List Log')?></a></li>
            <?php }?>
            <?php if($permissoes['cdr_config']=='S'){?>
             <li><a href=index.php?acao=config><div class="imagensMenu"><img src="imagens/menu/cdrConfig.png"></div><?php translateMsg('Settings')?></a></li>
             <?php }?>
            
          </ul>
	</div>

<div id="areaNotificacao" class="areaNotificacao"></div>
<div class="area">
<?php 
  
if(isset($_REQUEST['acao'])){
   
	if($_REQUEST['acao']=='cadastrarTipoDoc')
					   require('controladores/cadastrarTipoDocAcao.php');
	
	if($_REQUEST['acao']=='gravaTipoDoc')
					   require('controladores/cadastrarTipoDocAcao.php');
	
	if($_REQUEST['acao']=='listarTipoDocumento')
					   require('controladores/cadastrarTipoDocAcao.php');
	
	if($_REQUEST['acao']=='excluirTipoDoc')
					   require('controladores/cadastrarTipoDocAcao.php');
					   
	if($_REQUEST['acao']=='alterarTipoDoc')
					   require('controladores/cadastrarTipoDocAcao.php');	
					   
	if($_REQUEST['acao']=='atualizarTipoDoc')
					   require('controladores/cadastrarTipoDocAcao.php');	
	if($_REQUEST['acao']=='pesquisarTipoDocumento')
					   require('controladores/cadastrarTipoDocAcao.php');	
					   
	if($_REQUEST['acao']=='listarUsuario')
					   require('controladores/cadastrarUsuarioAcao.php');	
					 
	if($_REQUEST['acao']=='cadastrarUsuario')
	   require('controladores/cadastrarUsuarioAcao.php');	
	   
	if($_REQUEST['acao']=='cadastraNovoUsuario')
	   require('controladores/cadastrarUsuarioAcao.php');	
	   
    if($_REQUEST['acao']=='excluirUsuario')
		require('controladores/cadastrarUsuarioAcao.php');	
	
	if($_REQUEST['acao']=='alterarUsuario')
		require('controladores/cadastrarUsuarioAcao.php');   			   			   			   
		
	if($_REQUEST['acao']=='atualizarUsuario')
		require('controladores/cadastrarUsuarioAcao.php'); 
		
	if($_REQUEST['acao']=='pesquisarUsuario')
	   require('controladores/cadastrarUsuarioAcao.php');		
	   
	if($_REQUEST['acao']=='pesquisarDocumento')
	   require('controladores/cadastrarDocumentoAcao.php');	
	   
	 if($_REQUEST['acao']=='cadastrarDocumento')
	   require('controladores/cadastrarDocumentoAcao.php');	
	  
	 	   
	if($_REQUEST['acao']=='listarDocumento')
	   require('controladores/cadastrarDocumentoAcao.php');
	   
	if($_REQUEST['acao']=='excluirDocumento')
	   require('controladores/cadastrarDocumentoAcao.php');
	
	if($_REQUEST['acao']=='visualizarDocumento')   
  		require('visualizarDocumento.php');
		
	if($_REQUEST['acao']=='editorTexto')   
  		require('editorTexto.php');  
		
	if($_REQUEST['acao']=='listarLog')
	   require('controladores/logAcao.php');
	   
    if($_REQUEST['acao']=='pesquisarLog')
	   require('controladores/logAcao.php');

 	if($_REQUEST['acao']=='excluirLog')
	   require('controladores/logAcao.php');

	if($_REQUEST['acao']=='cadastrarPermissao')
		require('controladores/cadastrarPermissaoAcao.php');
    
    if($_REQUEST['acao']=="gravarPermissao")
    	require('controladores/cadastrarPermissaoAcao.php');
    
    if($_REQUEST['acao']=="carregarPermissao")
    	require('controladores/cadastrarPermissaoAcao.php');
    
    if($_REQUEST['acao']=="config")
        require("controladores/cadastrarConfigAcao.php");

    if($_REQUEST['acao']=="gravarConfig")
    	require("controladores/cadastrarConfigAcao.php");

}//fim do isset
	?>
</div>
</body>
</html>
<?php } ?> 
