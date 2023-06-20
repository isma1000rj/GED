<?php 
session_start();
require_once dirname(__FILE__).'/consultas/sqlConfig.php';
require_once  dirname(__FILE__).'/util/i18n.php';  //Funções para o gettext
$operacao=new configuracao();
$operacao->listarConfiguracao();
if(isset($_SESSION['StLogin'])){

if($_SESSION['StLogin']=="INVALIDO"){

   geraNotificacao("<h2>".getTranslateMsg('Usuário ou Senha inválidos!')."<h2>","error","div#areaNotificacao");
    session_destroy();
}
}//fim do isset
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link  rel="stylesheet" type="text/css" href="util/_css/cuscosky.css"/>
<link  rel="stylesheet" type="text/css" href="util/_css/animate.css">
<script type="text/javascript" src="util/jq/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="util/jq/jquery.form.js"></script>
<script type="text/javascript" src="util/js/noty/packaged/jquery.noty.packaged.js"></script>
<script type="text/javascript" src="util/geraNotificacao.js"></script>
<script type="text/javascript" src="util/js/validaCamposFormLogin.js"></script>
<title><?php translateMsg('GED-Electronic Document Management');?></title>
</head>
<body class="fundoPaginaLogin">

<div class="botoes-idiomas" align="right">
    <a href="formLogin.php?locale=pt_BR"><img src="imagens/BrFlag.png"></a>
    <a href="formLogin.php?locale=es_ES"><img src="imagens/EsFlag.png"></a>
    <a href="formLogin.php?locale=en_US"><img src="imagens/UsFlag.png"></a>
</div>

<div class="logo-login">
  <?php 
          if(isset($_REQUEST['locale'])){

            if($_REQUEST['locale']=="pt_BR"){
              echo "<img src='imagens/gedBr.png'>";
            }

            if($_REQUEST['locale']=="es_ES"){

              echo "<img src='imagens/gedEs.png'>";
            }

            if($_REQUEST['locale']=="en_US"){

              echo "<img src='imagens/gedUs.png'>";
            }

         }

      ?>    

</div>

<div id="areaNotificacao" class="areaNotificacaoFormLogin"></div>
<div class="formLogin">
<form   id="formLogin" name="formLogin" method="post" action="validaLogin.php">
<table  width="316" border="1" align="center">
    <tr>
      <th colspan="2" scope="col"><?php translateMsg('System access');?></th>
    </tr>
    <tr>
      <th width="98" scope="row" align="center"><img src="imagens/users.png" width="40" height="40" /><?php translateMsg('User');?></th>
      <th width="194" align="left" scope="row"><input name="txLoginUsuario" type="text" id="txLoginUsuario" size="40" /></th>
    </tr>
    <tr>
      <th width="98" scope="row" align="center"><img src="imagens/lock.png" width="32" height="32" alt="<?php translateMsg('Password');?>" /><?php translateMsg('Password');?></th>
      <th width="194" align="left" scope="row"><input name="txSenhaUsuario" type="password" id="txSenhaUsuario" size="40" /></th>
    </tr>
    <tr>
      <th width="98" scope="row" align="center"><img src="imagens/idioma.png" width="32" height="32" alt="Idioma" /><?php translateMsg('Language');?></th>
      <th width="194" size="40" align="left" scope="row">
      <select name="cbxIdioma" id="cbxIdioma" >
       <option value="en_US">Inglês</option>
       <option value="pt_BR">Português</option>
       <option value="es_ES">Espanhol</option>
       </select>
      </th>
    </tr>
    <tr>
      <th height="32" colspan="2" scope="row"> <table align="center" width="32" border="0">
        <tr>
          <th scope="col"><input style="border:thin" type="button" name="btEntrar" id="btEntrar" value="<?php translateMsg('Access');?>" onclick="validaCamposFormLogin(messageUsuario,messageSenha)" /></th>
          <th scope="col"><input style="border:thin" type="reset" name="btLimpar" id="btLimpar" value="<?php translateMsg('Clean');?>" onclick="reset" /></th>
        </tr>
      </table></th>
    </tr>
  </table>
  </form>
  </div>
  <script>
    var messageUsuario="<?php translateMsg('The user field is empty!');?>";
    var messageSenha="<?php translateMsg('The password field is empty!');?>";
    document.addEventListener('keypress', function(e){
       if(e.which == 13){
          validaCamposFormLogin(messageUsuario,messageSenha);
       }
    }, false);
</script>
</body>
<div class="nomeEmpresa"><?php echo $operacao->registros->nome_empresa?></div>
</html>
