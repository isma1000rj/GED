<?php
if(!isset($_SESSION['idUsuario'])){
   
  require_once dirname(__FILE__).'util/funcoes.php/';
  direciona("formLogin.php");
  
}?>
<?php 
  $permissoes=$_SESSION['permissoesUsuario'];
if($permissoes['lst_usuario']=='S'){?>
<html>
<body>
<table width="629" border="1" align="center">
  <tr class="titulos_listas"  >
    <th height="23" colspan="6" align="center" scope="col">
    <?php translateMsg('Registered Users');?>
    </th>
  </tr>
  <tr>
    <th height="31" colspan="6" align="center" scope="col">
      <label for="txtPesquisaUsuario"><?php translateMsg('Search');?></label>
      <input name="txtPesquisaUsuario" type="text" id="txtPesquisaUsuario" size="60" />
      <input type="button" name="btPesquisar" id="btPesquisar" value="<?php translateMsg('Search');?>" onclick="pesquisarUsuario()" />
    </th>
  </tr>
  <tr>
    <th width="45" scope="row"><div align="left"><?php translateMsg('Code');?></div></th>
    <th width="219" scope="row"><div align="left"><?php translateMsg('Name');?></div></th>
    <th width="141" scope="row"><div align="left"><?php translateMsg('Login');?></div></th>
    <th width="84" scope="row"><div align="left"><?php translateMsg('Profile');?></div></th>
    <th><div align="left"><?php translateMsg('Edit');?></div></th>
    <th><div align="left"><?php translateMsg('Delete');?></div></th>
    </td>
  </tr>
  <?php
  while($opUsuario->registros=$opUsuario->resultado->FetchNextObj())
	{
?>
        <tr >
          <td align="left" scope="row" >
                  <?php echo $opUsuario->registros->id_usuario; ?> 
           </td>
          <td align="left"  scope="row">
                  <?php echo $opUsuario->registros->nome; ?>
          </td>
          <td align="left"  scope="row">
                <?php echo $opUsuario->registros->login; ?>
          </td>
          <td align="left"  scope="row">
                <?php echo $opUsuario->registros->descricao;?>
          </td>
          <td width="51" align="center">
                  <a href="index.php?acao=alterarUsuario&amp;codigo=<?php echo  $opUsuario->registros->id_usuario; ?>">
                   <img src="imagens/editar.png" alt="<?php translateMsg('Edit User');?>" title="<?php translateMsg('Edit User');?>" /></a>
          </td>
          <td width="49" align="center">
          <a  onclick="gerarPedidoExclusao('<h3>'+message+'<h3>','information','center','excluirUsuario','<?php echo  $opUsuario->registros->id_usuario; ?>')" >
          <img src="imagens/excluir.png" alt="<?php translateMsg('Delete User');?>" title="<?php translateMsg('Delete User');?>" /></a>
          </td>
        </tr>
  <?php
     	}
  ?>
</table>
<?php 
if(isset($_GET['pg'])){/*Só mostra o alerta quando o usuário clicar na página*/
    if($_REQUEST['pg']==$_SESSION['limiteDePaginas'] ){
        geraNotificacao("<h2>".getTranslateMsg('This is the last page.')."<h2>",'information','div#areaNotificacao');
      }
}//fim do isset pg
/* Paginação de resultados e alguns tratamentos para evitar problemas*/
if(isset($_REQUEST['pg'])){
if($_REQUEST['pg'] < $_SESSION['limiteDePaginas']){/* Evita que a váriavel receba um valor igual a zero ou negativo*/
      $_REQUEST['pg']=$_REQUEST['pg'] + 1;
    }
  }
if(isset($paginaAtual)){
if($paginaAtual==1){
     $paginaAtual=2;  
  }
}
require('util/botoesPaginacao.php');//Mostra os botões para controlar a paginação de resultados
?>
<script> 
     var message="<?php translateMsg('Do you want to delete the record?');?>";
     function pesquisarUsuario(){
     var txtPesquisaUsuario = document.getElementById('txtPesquisaUsuario');
     window.location="index.php?acao=pesquisarUsuario&fltr="+txtPesquisaUsuario.value;
    }
    document.addEventListener('keypress', function(e){
       if(e.which == 13){
          pesquisarUsuario();
       }
    }, false);
  </script>
</body>
</html>
<?php }else{
  geraPedidoConfirmacao("<h3>".getTranslateMsg('Attention!')."</h3></br>" ."<h3>".getTranslateMsg('The user does not have access to this module.')."<h3>","error","center");
  } ?> 
