<?php
ob_start();
session_start();
require_once dirname(__FILE__).'/consultas/sqlPermissao.php';
require_once dirname(__FILE__).'/util/config.php';//arquivo de configuração da tradução
require_once  dirname(__FILE__).'/util/i18n.php';  //Funções para o gettext
$operacao=new permissao();
$dataAtual= date('d-m-Y');
$operacao->RegistrarAcao($_SESSION['idUsuario'],$_SESSION['nomeUsuario'],$dataAtual,'current_time',getTranslateMsg('Exited the System'));
unset($_SESSION['NomeUsuario']);
unset($_SESSION['codigoUsuario']);
unset($_SESSION['nivelUsuario']);
session_destroy();
direciona("formLogin.php?locale=pt_BR");
?>
