<?php
if(!isset($_SESSION['idUsuario'])){
   
  require_once dirname(__FILE__).'util/funcoes.php/'; 
  direciona("formLogin.php");
}?>
<?php 
  $permissoes=$_SESSION['permissoesUsuario'];
if($permissoes['lst_tpdocumento']=='S'){?>
<html>
<body>
<table width="568" border"1" align="center">
  <tr>
    <th height="23" colspan="4" align="center" scope="col">
    <?php translateMsg('Types Of Documents Registered');?>
    </th>
  </tr>
  <tr>
    <th colspan="4" align="center" scope="col">
      <label for="txtPesquisaDocumento"><?php translateMsg('Search');?></label>
      <input name="txtPesquisaDocumento" type="text" id="txtPesquisaDocumento" size="40" />
      <input type="button" name="btPesquisar" id="btPesquisar" value="<?php translateMsg('Search');?>" onClick="pesquisarTipoDocumento()"/>
    </th>
  </tr>
  <tr>
    <th width="50" scope="row"><div align="left"><?php translateMsg('Code');?></div></th>
    <th width="367" scope="row"><div align="left"><?php translateMsg('Name');?></div></th>
    <th><div align="left"><?php translateMsg('Edit');?></div></th>
    <th><div aling="left"><?php translateMsg('Delete');?></div></th>
  </tr>
  <?php
  while($operacao->registros=$operacao->resultado->FetchNextObj())
	{
?>
        <tr >
          <td align="left"  scope="row">
              <?php echo $operacao->registros->id_tipo; ?>
          </td>
          <td align="left" scope="row">
              <?php echo $operacao->registros->descricao; ?>
          </td>
          <td width="62" align="center">
                 <a href="index.php?acao=alterarTipoDoc&amp;codigo=<?php echo  $operacao->registros->id_tipo; ?>">
                 <img src="imagens/editar.png" alt="<?php translateMsg('Edit Document Type');?>"     title="<?php translateMsg('Edit Document Type');?>" /></a>
          </td>
          <td width="61" align="center">
              <a  onclick="gerarPedidoExclusao('<h3>'+message+'<h3>','information','center','excluirTipoDoc','<?php echo 
              $operacao->registros->id_tipo; ?>')" >
             <img src="imagens/excluir.png" alt="<?php translateMsg('Delete Document Type');?>" title="<?php translateMsg('Delete Document Type');?>" /></a>
          </td>
        </tr>
  <?php
      
	}?>
  <script>  
     var messageField="<?php translateMsg('The name field is empty or contains invalid characters!');?>";
     var message="<?php translateMsg('Do you want to delete the record?');?>";
     function pesquisarTipoDocumento(){
     var txtPesquisaDocumento = document.getElementById('txtPesquisaDocumento');
     window.location="index.php?acao=pesquisarTipoDocumento&fltr="+txtPesquisaDocumento.value;

    }
      document.addEventListener('keypress', function(e){
       if(e.which == 13){
          pesquisarTipoDocumento();
       }
    }, false);
  </script>
</table>
<?php
if(isset($_GET['pg'])){/*Só mostra o alerta quando o usuário clicar na página*/
    if($_REQUEST['pg']==$_SESSION['limiteDePaginas'] ){
       geraNotificacao("<h2>".getTranslateMsg('This is the last page.')."<h2>",'information','div#areaNotificacao');
      }
}//fim do isset pg
/* Paginação de resultados e alguns tratamentos para evitar problemas*/
if($_REQUEST['pg'] < $_SESSION['limiteDePaginas']){/* Evita que a váriavel receba um valor igual a zero ou negativo*/
      $_REQUEST['pg']=$_REQUEST['pg'] + 1;
    }
if($paginaAtual==1){
     $paginaAtual=2;  
  }
require('util/botoesPaginacao.php');//Mostra os botões para controlar a paginação de resultados
?>
</body>
</html>
<?php }else{
  geraPedidoConfirmacao("<h3>".getTranslateMsg('Attention!')."</h3></br>" ."<h3>".getTranslateMsg('The user does not have access to this module.')."<h3>","error","center");
  } ?> 
