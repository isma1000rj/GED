<?php
if(!isset($_SESSION['idUsuario'])){
   
    require_once dirname(__FILE__).'util/funcoes.php/';
    direciona("formLogin.php");
  
}?>
<?php 
  $permissoes=$_SESSION['permissoesUsuario'];
if($permissoes['cdr_tpdocumento']=='S'){?>
<html>
<body>
<form id="formCadastraTipoDocumento" name="formCadastraTipoDocumento" method="post" action="index.php?acao=<?php if(isset($_REQUEST['codigo'])) echo 'atualizarTipoDoc'; else echo 'gravaTipoDoc'; ?>&codigo=<?php if(isset($_REQUEST['codigo'])) echo $_REQUEST['codigo'];?>">
  <p>&nbsp;</p>
  <table width="460" border="1" align="center">
    <tr>
      <th colspan="3" scope="col"><?php translateMsg('Register Type of Document');?></th>
    </tr>
    <tr>
      <th colspan="3" scope="col" align="center"><?php translateMsg('Name:');?> 
    <input name="txtTipoDocumento" type="text" id="txtTipoDocumento" size="50" maxlength="80" onkeypress="return somenteCaracteres(event)"
    value="<?php if(isset($_REQUEST['codigo'])) echo $operacao->registros->descricao;?>"/>
      </th>
    </tr>
    <tr>
      <th width="155" scope="row">
            <input type="button" name="btCadastrar" id="btCadastrar" value="<?php translateMsg('Register');?>" onclick="validaCampoCadastroTipoDocumento(messageName,messageletter)"  />
      </th>
      <th width="124" scope="row">
            <input type="reset" name="btLimparCampos" id="btLimparCampos" value="<?php translateMsg('Clean');?>" onclick="reset" />
      </th>
      <th width="159" scope="row">
            <input type="reset" name="btCancelar" id="btCancelar" value="<?php translateMsg('Cancel');?>" onclick="javascript:history.back()"/>
     </th>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
<script type="text/javascript">
   var messageName="<?php translateMsg('The name field is empty or contains invalid characters!');?>";
   var messageletter="<?php translateMsg('Only letters in this field!');?>";
</script>
</body>
</html>
<?php }else{
   geraPedidoConfirmacao("<h3>".getTranslateMsg('Attention!')."</h3></br>" ."<h3>".getTranslateMsg('The user does not have access to this module.')."<h3>","error","center");
  } ?> 
