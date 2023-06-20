<?php
if(!isset($_SESSION['idUsuario'])){
   
    require_once dirname(__FILE__).'util/funcoes.php/';
    direciona("formLogin.php");
}?>
<?php 
   $permissoes=$_SESSION['permissoesUsuario'];
if($permissoes['cdr_permissaoacesso']=='S'){?>
<html>
<body>
<form id="formCadastrarPermissao" name="formCadastrarPermissao" method="post" action="index.php?acao=gravarPermissao">
  
  <table width="750" height="156">
  <tr>
    <th height="23" colspan="7" align="center" scope="col"><?php translateMsg('Register Permission');?></th>
  </tr>
    <tr align="left">
      <th width="800" height="20" scope="col">
        <?php translateMsg('User Name:');?>
         <select name="cbxNomeUsuario" id="cbxNomeUsuario" onchange="getStates(this)">
         <?php if(!isset($_GET['codigo'])){?>  
         <option value="-1"><?php translateMsg('Select an User');?></option>
         <?php } ?>
               <?php for($i=0;$i<$operacao->qtdRegistros;$i++){
               $dados = $operacao->resultado->FetchRow();?>
               <?php 
                if(isset($_GET['codigo'])){
                if($_GET['codigo']==$dados['id_usuario']){?>
                <option value="<?php echo $dados['id_usuario']?>"><?php echo $dados['nome'];?>
               <?php }?>
               <?php }else {?>
              <option value="<?php echo $dados['id_usuario']?>"><?php echo $dados['nome']?></option>
          <?php }?>
          <?php }?>
           </select>
          </th>
    </tr>
    <tr align="left">
      
  <th height="60" colspan="2" scope="col">
      
      <table width="750" height="80">
        <tr align="left">
          <th width="183" height="24" scope="col" ><?php translateMsg('Register User');?></th>
          <th align="center" width="23" scope="col">
              <?php 
              if(isset($_GET['codigo'])){
              $operacao->listarPermissaoUsuario($_GET['codigo']); 
                $permissao= $operacao->resultado->FetchRow();
              }
               if( isset($permissao['cdr_usuario']) and $permissao['cdr_usuario']=='S'){?>
              <input  type="checkbox" name="cxSelcCadastraUsuario" id="cxSelcCadastraUsuario" checked/>
              <?php }else{ ?>
               <input  type="checkbox" name="cxSelcCadastraUsuario" id="cxSelcCadastraUsuario" />
               <?php }?>
          </th>
          <th width="160" scope="col"><?php translateMsg('List User');?></th>
          <th align="center" width="27" scope="col">
          <?php if(isset($_GET['codigo'])){
              $operacao->listarPermissaoUsuario($_GET['codigo']); 
                $permissao= $operacao->resultado->FetchRow();
              }
              if(isset($permissao['lst_usuario']) and $permissao['lst_usuario']=='S'){?>
                <input type="checkbox" name="cxSelecListarUsuario" id="cxSelecListarUsuario" checked/>
             <?php }else{?>
            <input type="checkbox" name="cxSelecListarUsuario" id="cxSelecListarUsuario"/>
            <?php }?>
          </th>
          <th width="197" scope="col"><?php translateMsg('List Log');?></th>
          <th align="center" width="26" scope="col">
            <?php if(isset($_GET['codigo'])){
              $operacao->listarPermissaoUsuario($_GET['codigo']); 
                $permissao= $operacao->resultado->FetchRow();
              }
                if(isset($permissao['lst_log']) and $permissao['lst_log']=='S'){?>    
                <input type="checkbox" name="cxSelecListarLog" id="cxSelecListarLog" checked />
              <?php }else{?>
                <input type="checkbox" name="cxSelecListarLog" id="cxSelecListarLog"  />
                <?php }?>
          </th>
        </tr>
        <tr align="left">
          <th height="24" scope="row"><?php translateMsg('Register Document');?></th>
          <th  align="center" height="24" scope="row">
           <?php if(isset($_GET['codigo'])){
              $operacao->listarPermissaoUsuario($_GET['codigo']); 
                $permissao= $operacao->resultado->FetchRow();
              }
                if(isset($permissao['cdr_documento']) and $permissao['cdr_documento']=='S'){?>
                  <input type="checkbox" name="cxSelecCadastrarDocumento" id="cxSelecCadastrarDocumento" checked />
                <?php }else{?>
                  <input type="checkbox" name="cxSelecCadastrarDocumento" id="cxSelecCadastrarDocumento"  />
                  <?php }?>
                </th>
          <th><?php translateMsg('List Type Documents');?></th>
          <th align="center">
              <?php if(isset($_GET['codigo'])){
              $operacao->listarPermissaoUsuario($_GET['codigo']); 
                $permissao= $operacao->resultado->FetchRow();
              }
                if(isset($permissao['lst_tpdocumento']) and $permissao['lst_tpdocumento']=='S'){?>
              <input type="checkbox" name="cxSelecListarTipoDocumento" id="cxSelecListarTipoDocumento" checked />
              <?php }else{?>
               <input type="checkbox" name="cxSelecListarTipoDocumento" id="cxSelecListarTipoDocumento" />
               <?php }?>
          </th>
          <th><?php translateMsg('Access permission');?></th>
          <th align="center">
          <?php if(isset($_GET['codigo'])){
              $operacao->listarPermissaoUsuario($_GET['codigo']); 
                $permissao= $operacao->resultado->FetchRow();
              }
                if(isset($permissao['cdr_permissaoacesso']) and $permissao['cdr_permissaoacesso']=='S'){?>
              <input type="checkbox" name="cxSelecCadastrarPermissaoAcesso" id="cxSelecCadastrarPermissaoAcesso" checked />
              <?php }else{?>
               <input type="checkbox" name="cxSelecCadastrarPermissaoAcesso" id="cxSelecCadastrarPermissaoAcesso"  />
               <?php }?>
          </th>
        </tr>
        <tr align="left">
          <th height="22" scope="row"><?php translateMsg('Register Type Document');?></th>
          <th align="center" height="22" scope="row">
           <?php if(isset($_GET['codigo'])){
              $operacao->listarPermissaoUsuario($_GET['codigo']); 
                $permissao= $operacao->resultado->FetchRow();
              }
                if(isset($permissao['cdr_tpdocumento']) and $permissao['cdr_tpdocumento']=='S'){?>
              <input type="checkbox" name="cxSelecCadastrarTipoDocumento" id="cxSelecCadastrarTipoDocumento" checked />
              <?php }else{?>
               <input type="checkbox" name="cxSelecCadastrarTipoDocumento" id="cxSelecCadastrarTipoDocumento"  />
              <?php }?>
            </th>
          <th><?php translateMsg('List Documents');?></th>
          <th align="center">
          <?php if(isset($_GET['codigo'])){
              $operacao->listarPermissaoUsuario($_GET['codigo']); 
                $permissao= $operacao->resultado->FetchRow();
              }
                if(isset($permissao['lst_documento']) and $permissao['lst_documento']=='S'){?>
              <input type="checkbox" name="cxSelecListarDocumento" id="cxSelecListarDocumento" checked />
              <?php }else{?>
              <input type="checkbox" name="cxSelecListarDocumento" id="cxSelecListarDocumento" />
              <?php }?>
          </div>
          </th>
          <th><?php translateMsg('Settings');?></th>
          <th align="center">
          <?php if(isset($_GET['codigo'])){
              $operacao->listarPermissaoUsuario($_GET['codigo']); 
                $permissao= $operacao->resultado->FetchRow();
              }
                if(isset($permissao['cdr_config']) and $permissao['cdr_config']=='S'){?>
              <input type="checkbox" name="cxSelecCadastrarConfiguracao" id="cxSelecCadastrarConfiguracao" checked />
              <?php }else{?>
               <input type="checkbox" name="cxSelecCadastrarConfiguracao" id="cxSelecCadastrarConfiguracao"  />
               <?php }?>
          </th>
        </tr>
      </table>
      </th>
    </tr>
    <tr align="center">
      <th height="34" colspan="2" scope="col">
      <table width="32">
        <tr>
          <th height="28" scope="col">
                <input type="button" name="btGravar" id="btGravar" value="<?php translateMsg('Save');?>" onclick="verificaUsuarioSelecionado()" /></th>
          <th scope="col">
                <input type="reset" name="btCancelar" id="btCancelar" value="<?php translateMsg('Cancel');?>" /></th>
          <th scope="col">
                  <input type="button" name="btLimpar" id="btLimpar" value="<?php translateMsg('Clean');?>" onclick="limparPermissoes()" /></th>
        </tr>
      </table>
      </th>
    </tr>
  </table>
</form>
<script>
function verificaUsuarioSelecionado(){
  var mensagem ="<?php translateMsg("Select the username!");?>";
 if(document.getElementById('cbxNomeUsuario').value=="-1"){
  gerarNotificacao("<h2>"+mensagem+"<h2>","error","div#areaNotificacao");
   document.getElementById('cbxNomeUsuario').focus();
 }else{
     document.getElementById('formCadastrarPermissao').submit();
    }//fim do if
  }
function getStates(what) {
      if (what.selectedIndex != '') {
        var codigo = what.value;
        document.location=('index.php?acao=carregarPermissao&codigo='+codigo);
}
}

function limparPermissoes(){

  document.getElementById('cxSelcCadastraUsuario').checked=false;
  document.getElementById('cxSelecListarUsuario').checked=false;
  document.getElementById('cxSelecListarLog').checked=false;
  document.getElementById('cxSelecCadastrarDocumento').checked=false;
  document.getElementById('cxSelecListarTipoDocumento').checked=false;
  document.getElementById('cxSelecCadastrarPermissaoAcesso').checked=false;
  document.getElementById('cxSelecCadastrarTipoDocumento').checked=false;
  document.getElementById('cxSelecListarDocumento').checked=false;
  document.getElementById('cxSelecCadastrarConfiguracao').checked=false;
}
</script>
</body>
</html>
<?php }else{
  geraPedidoConfirmacao("<h3>".getTranslateMsg('Attention!')."</h3></br>" ."<h3>".getTranslateMsg('The user does not have access to this module.')."<h3>","error","center");
}?>
