<?php 
if(!isset($_SESSION['idUsuario'])){
   
  require_once dirname(__FILE__).'util/funcoes.php/';
  direciona("formLogin.php");
  
}?>
<?php 
  $permissoes=$_SESSION['permissoesUsuario'];
if($permissoes['lst_documento']=='S'){?>
<html>
<body>
<table width="907" border="1" align="center">
  <tr class="titulos_listas"  >
    <th height="23" colspan="10" align="center" scope="col"><?php translateMsg('
Registered documents');?></th>
  </tr>
  <tr>
    <th colspan="10" align="center" scope="col">
      <label for="txtPesquisaDocumento"><?php translateMsg('Search');?></label>
      <input name="txtPesquisaDocumento" type="text" id="txtPesquisaDocumento" size="60" />
      <input type="submit" name="btPesquisar" id="btPesquisar" value="<?php translateMsg('Search');?>" onClick="pesquisarDocumento()"/>
    </th>
  </tr>
  <tr class="ordenacao_novo_registro">
    <th width="56" scope="row"><div align="left"><?php translateMsg('Code');?></div></th>
    <th width="277" scope="row" align="left"><?php translateMsg('Name');?></th>
    <th><div align="left"><?php translateMsg('Author');?></div></th>
    <th aling="left"><?php translateMsg('Type');?></th>
    <th align="left"><?php translateMsg('Category');?></th>
    <th align="left"><?php translateMsg('Date');?></th>
    <th align="left"><?php translateMsg('Visualize');?></th>
    <th align="left"><?php translateMsg('Download');?></th>
    <th align="left"><?php translateMsg('Delete');?></th>
  </tr>
<?php
     

		while($operacao->registros=$operacao->resultado->FetchNextObj())
	{
?>
<tr>
  <?php $nomeArquivo=$operacao->registros->nome ;?>
  <?php $extensaoArquivo=$operacao->registros->extensao;?>
  <?php $nomeArquivo.=".";?>
  <?php $nomeArquivo.=$extensaoArquivo;?>
  
  <td height="40" scope="row" aling="left"><?php echo $operacao->registros->id_doc; ?></td>
  <td align="left" scope="row"> <?php echo $operacao->registros->apelido;?></td>
  <td align="left" width="107"><?php echo $operacao->registros->autor;?> </td>
  <td aling="left" width="39"><?php echo $operacao->registros->extensao;?></td>
   <td aling="left" width="39"><?php echo $operacao->registros->descricao;?></td>
  <td align="left" width="100"><?php echo $operacao->registros->data;?></td>
  
  <td width="62" align="center">
    <a href="index.php?acao=visualizarDocumento&data=<?php echo $operacao->registros->data?>&nome=<?php echo $operacao->registros->nome?>.<?php echo $operacao->registros->extensao?>&codigo=<?php echo  $operacao->registros->id_doc; ?>"><img src="imagens/visualizarDoc.png" alt="<?php translateMsg('View Document');?>" title="<?php translateMsg('View Document');?>" /></a>

    </td>
  <td width="70" align="center"><a href="download.php?arquivo=arquivos/<?php echo $operacao->registros->data;?>/<?php echo $nomeArquivo;?>"><img src="imagens/download.png" alt="<?php translateMsg('Download File');?>" title="<?php translateMsg('Download File');?>"></a></td>

  <td width="64" align="center"><a  onClick="gerarPedidoExclusaoDoc('<h3>'+message+'<h3>','information','center','excluirDocumento','<?php echo  $operacao->registros->id_doc; ?>','<?php echo $operacao->registros->data?>','<?php echo $operacao->registros->nome?>.<?php echo $operacao->registros->extensao?>')"><img src="imagens/excluir.png" alt="<?php translateMsg('Delete File');?>" title="<?php translateMsg('Delete File');?>" /></a></td>
</tr>
  <?php
 }?>
</table>

<?php 
if(isset($_GET['pg'])){/*Só mostra o alerta quando o usuário clicar na página*/
    if($_REQUEST['pg']==$_SESSION['limiteDePaginas'] ){
        geraNotificacao("<h2>".getTranslateMsg('This is the last page.')."<h2>",'information','div#areaNotificacao');
      }
}//fim do isset pg
if(isset($_SESSION['limiteDePaginas'])){
if($_REQUEST['pg'] < $_SESSION['limiteDePaginas']){/* Evita que a váriavel receba um valor igual a zero ou negativo*/
  		$_REQUEST['pg']=$_REQUEST['pg'] + 1;
  	}
}
if($paginaAtual==1){
		 $paginaAtual=2;  
	}
require('util/botoesPaginacao.php');//Mostra os botões para controlar a paginação de resultados
?>
<script> 

     var message="<?php translateMsg('Do you want to delete the record?');?>";
     function pesquisarDocumento(){
		 var txtPesquisaDocumento = document.getElementById('txtPesquisaDocumento');
		 window.location="index.php?acao=pesquisarDocumento&fltr="+txtPesquisaDocumento.value;
	 }

   document.addEventListener('keypress', function(e){
       if(e.which == 13){
          pesquisarDocumento();
       }
    }, false);
  </script>
</body>
</html>
<?php }else{
  geraPedidoConfirmacao("<h3>".getTranslateMsg('Attention!')."</h3></br>" ."<h3>".getTranslateMsg('The user does not have access to this module.')."<h3>","error","center");
  } ?> 