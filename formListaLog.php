<?php
if(!isset($_SESSION['idUsuario'])){
   
   require_once dirname(__FILE__).'util/funcoes.php/';
  direciona("formLogin.php");
}?>
<?php 
  $permissoes=$_SESSION['permissoesUsuario'];
if($permissoes['lst_log']=='S'){?>
<html>
<body>
<table width="922" border="1" align="center">
  <tr>
    <th height="23" colspan="7" align="center" scope="col"><?php translateMsg('Operations Log');?></th>
  </tr>
  <tr>
    <th colspan="7" align="center" scope="col">
      <label for="txtPesquisaLog"><?php translateMsg('Search');?></label>
      <input name="txtPesquisaLog" type="text" id="txtPesquisaLog" size="60" />
      <input type="button" name="btPesquisar" id="btPesquisar" value="<?php translateMsg('Search');?>" onClick="pesquisarLog()" />
    </th>
  </tr>
  <tr class="ordenacao_novo_registro">
    <th width="47" scope="row"><div align="left"><?php translateMsg('Code');?></div></th>
    <th> <div align="left"><?php translateMsg('User');?></div></th>
    <th><div align="left"><?php translateMsg('Operation');?></div></th>
    <th width="284" scope="row"><div align="left"><?php translateMsg('Name of Object');?></div></th>
    <th><div align="left"><?php translateMsg('Date');?></div></th>
    <th><div align="left"><?php translateMsg('Time');?></div></th>
    <th><div align="left"><?php translateMsg('Delete');?></div></th>
  </tr>
  <?php
     

		while($operacao->registros=$operacao->resultado->FetchNextObj())
	{
?>
        <tr >
          <td align="left" scope="row">
             <?php echo $operacao->registros->id_log; ?>
          </td>
          <td align="left" width="111">
              <?php echo $operacao->registros->login;?>
          </td>
          <td align="left" width="207">
                <?php echo $operacao->registros->operacao;?>
          </td>
          <td align="left" scope="row">
              <?php echo $operacao->registros->nome_documento;?>
          </td>
         <td align="left" width="100">
            <?php echo $operacao->registros->data;?>
           </td>
            <td align="left" width="86">
                <?php echo $operacao->registros->hora;?>
          </td>
          <td align="center" width="58"><a  onClick="gerarPedidoExclusao('<h3>'+message+'<h3>','information','center','excluirLog','<?php echo  $operacao->registros->id_log; ?>')" ><img src="imagens/excluir.png" alt="<?php translateMsg('Delete Log');?>" title="<?php translateMsg('Delete Log');?>" /></a></td>
        </tr>
  <?php
 }?>
</table>
<?php 
if(isset($_GET['pg'])){
if($_REQUEST['pg']==$_SESSION['limiteDePaginas']){

  geraNotificacao("<h2>".getTranslateMsg('This is the last page.')."<h2>",'information','div#areaNotificacao');
}
}
/* Paginação de resultados e alguns tratamentos para evitar problemas*/
if($_REQUEST['pg'] < $_SESSION['limiteDePaginas']){/* Evita que a váriavel receba um valor igual a zero ou negativo*/
  		$_REQUEST['pg']=$_REQUEST['pg'] + 1;
  	}
if($paginaAtual==1){
		 $paginaAtual=2;  
	}
require('util/botoesPaginacao.php');//Mostra os botões para controlar a paginação de resultados
?>
<script> 
     var message="<?php translateMsg('Do you want to delete the record?');?>";
     function pesquisarLog(){
     var txtPesquisaLog = document.getElementById('txtPesquisaLog');
     window.location="index.php?acao=pesquisarLog&fltr="+txtPesquisaLog.value;
   }
   document.addEventListener('keypress', function(e){
       if(e.which == 13){
          pesquisarLog();
       }
    }, false);
  </script>
</body>
</html>
<?php }else{
  geraPedidoConfirmacao("<h3>".getTranslateMsg('Attention!')."</h3></br>" ."<h3>".getTranslateMsg('The user does not have access to this module.')."<h3>","error","center");
  } ?> 
