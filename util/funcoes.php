<?php 

function alerta($mensagem){
	 
	echo '<script>alert("'.$mensagem.'");</script>';
	 
 }

function geraNotificacao($msg,$tipo,$container){
echo '<script>gerarNotificacao("'.$msg.'","'.$tipo.'","'.$container.'");</script>';	
	
}

/*function gerarPedidoConfirmacao($msg,$tipo,$layout,$acaoBtOk){
  echo '<script>gerarPedido("'.$msg.'" ,"'.$tipo.'","'.$layout.'","'.$acaoBtOk.'");</script>';	
}*/

function geraPedidoContinuarCadastro($msg,$tipo,$layout,$acaoBtOk,$acaoBtCancelar){

echo '<script>gerarPedidoContinuarCadastro("'.$msg.'" ,"'.$tipo.'","'.$layout.'","'.$acaoBtOk.'","'.$acaoBtCancelar.'");</script>';

}

function geraAlertaInformacao($msg,$tipo,$layout,$acaoBtOk){

echo '<script>gerarAlertaInformacao("'.$msg.'" ,"'.$tipo.'","'.$layout.'","'.$acaoBtOk.'");</script>';

}

function geraPedidoConfirmacao($msg,$tipo,$layout){

echo '<script>gerarPedidoConfirmacao("'.$msg.'" ,"'.$tipo.'","'.$layout.'");</script>';

}


function volta(){
	 
	echo "<script>history.back();</script>" ;
 }

function direciona($local){
	 
	echo '<script>window.location="'.$local.'"</script>' ;
 }

?>