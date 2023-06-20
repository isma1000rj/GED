<?php
if(!isset($_SESSION['idUsuario'])){
   
  require_once dirname(__FILE__).'util/funcoes.php/';
  direciona("formLogin.php");
}?>
<?php 
  $permissoes=$_SESSION['permissoesUsuario'];
if($permissoes['cdr_config']=='S'){?>
<html>
<body>
<form id="formCadastraConfig" name="formCadastraConfig" method="post" action="index.php?acao=gravarConfig">
  <p>&nbsp;</p>
  <table width="382" border="1" align="center">
    <tr>
      <th colspan="2" scope="col"><?php translateMsg('System settings')?></th>
    </tr>
    <tr>
      <th width="68" align="center" scope="col"><?php translateMsg('Company:')?></th>
      <th width="378" align="center" scope="col">
      <input name="txtNomeEmpresa" type="text" id="txtNomeEmpresa" size="50" maxlength="40"   value="<?php  echo $operacao->registros->nome_empresa;?>"/></th>
    </tr>
    <tr>
      <th scope="row"><?php translateMsg('Logo:')?></th>
      <th scope="row"><input name="txtLogo" type="text" id="txtLogo" size="50" maxlength="10"  value="<?php  echo $operacao->registros->nome_logo;?>"/></th>
    </tr>
    <tr>
      <th scope="row"><?php translateMsg('Title:')?></th>
      <th scope="row"><input name="txtTitulo" type="text" id="txtTitulo" size="50" maxlength="40"  value="<?php  echo $operacao->registros->titulo_navegador;?>"/></th>
    </tr>
    <tr>
      <th colspan="2" scope="row"><table width="32" border="1">
        <tr>
          <th scope="col"><input type="button" name="btCadastrar" id="btCadastrar" value="<?php translateMsg('Register')?>" onClick="validaCampoConfig(messageCompany,messageLogo,messageTitle)"  /></th>
          <th scope="col"><input type="button" name="btLimparCampos" id="btLimparCampos" value="<?php translateMsg('Clean')?>" onClick=limparCamposConfiguracao() /></th>
          <th scope="col"><input type="reset" name="btCancelar" id="btCancelar" value="<?php translateMsg('Cancel')?>"/></th>
        </tr>
      </table></th>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
<script type="text/javascript">
   var messageCompany="<?php translateMsg('The company field is empty!');?>";
   var messageLogo="<?php translateMsg('The logo field is empty!');?>";
   var messageTitle="<?php translateMsg('The title field is empty!');?>";
</script>
</body>
</html>
<?php }else{
   geraPedidoConfirmacao("<h3>".getTranslateMsg('Attention!')."</h3></br>" ."<h3>".getTranslateMsg('The user does not have access to this module.')."<h3>","error","center");
  } ?> 
