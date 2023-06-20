<?php
if(!isset($_SESSION['idUsuario'])){
   
  require_once dirname(__FILE__).'util/funcoes.php/';
  direciona("formLogin.php");
}?>
<?php 
  $permissoes=$_SESSION['permissoesUsuario'];
if($permissoes['cdr_usuario']=='S'){?>
<html>
<body>
  <p>
    <label for="txnomeUsuario"></label>
  </p>
  <form id='formCadastraUsuario' method='post' action="index.php?acao=<?php if(isset($_REQUEST['codigo'])) echo 'atualizarUsuario'; else echo 'cadastraNovoUsuario'; ?>&codigo=<?php if(isset($_REQUEST['codigo'])) echo $_REQUEST['codigo'];?>">
  <table width="295" border="1" align="center">
    <tr>
      <th colspan="2" align="center"><?php translateMsg('User registration');?></th>
    </tr>
    <tr>
      <th width="41"><?php translateMsg('Name:');?></th>
      <td width="360"><label for="txtNomeUsuario">
        <input name="txtNomeUsuario" type="text" id="txtNomeUsuario" value="<?php if(isset($_REQUEST['codigo'])) echo $opUsuario->registros->nome;?>" size="40" maxlength="60"/>
      </label></td>
    </tr>
    <tr>
      <th><?php translateMsg('Login:');?></th>
      <td><label for="txtLogin"></label>
      <input name="txtLogin" type="text" id="txtLogin" value="<?php if(isset($_REQUEST['codigo'])) echo $opUsuario->registros->login;?>" size="40" maxlength="20"/></td>
    </tr>
    <tr>
    <th><?php translateMsg('Password:');?></th>
      <td><label for="txtSenha"></label>
      <input name="txtSenha" type="password" id="txtSenha" size="40" /></td>
      </tr>
    <tr>
      <th><?php translateMsg('Profile:');?></th>
      <td><label for="cbxPerfilUsuario"></label>
        <select name="cbxPerfilUsuario" id="cbxPerfilUsuario" >
          <option value="1"><?php translateMsg('Administrator');?></option>
          <option value="2"><?php translateMsg('User');?></option>
      </select></td>
    </tr>
    <tr>
      <td height="43" colspan="2"><table width="193" border="1" align="center">
        <tr>
          <td width="53"><input type="button" name="btGravarUsuario" id="btGravarUsuario" value="<?php translateMsg('Register');?>" onclick="validaCamposCadastraUsuario(messageName,messageSenha,messageLogin);"/></td>
          <td width="56"><input type="button" name="btLimparCamposUsuario" id="btLimparCamposUsuario" value="<?php translateMsg('Clear');?>" onclick="limparCamposCadastraUsuario()" /></td>
          <td width="62"><input type="reset" name="btCancelarUsuario" id="btCancelarUsuario" value="<?php translateMsg('Cancel');?>" onclick="javascript:history.back()" /></td>
        </tr>
      </table></td>
    </tr>
  </table>
  </form>
  <script>
    var messageName="<?php translateMsg('The name field is empty or contains invalid characters!');?>";
    var messageSenha="<?php translateMsg('The password field is empty or contains invalid characters!');?>";
    var messageLogin="<?php translateMsg('The login field is empty or contains invalid characters!');?>";
    
   </script>
 </body>
</html>
<?php }else{
  geraPedidoConfirmacao("<h3>".getTranslateMsg('Attention!')."</h3></br>" ."<h3>".getTranslateMsg('The user does not have access to this module.')."<h3>","error","center");
} ?> 
