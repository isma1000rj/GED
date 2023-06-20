<?php
/*Implementação do WodoTextEditor para criação de documentos ODT*/ 

if(isset($_REQUEST['acao'])){
	$acao=$_REQUEST['acao'];
}

if(isset($_REQUEST['nome'])){
	$data=$_REQUEST['data'];
}
if(isset($_REQUEST['nome'])){
$nomeDocumento=$_REQUEST['nome'];
}
?>
<iframe src = "Wodotexteditor/localeditor.html" width='100%' height='100%' allowfullscreen webkitallowfullscreen frameborder="0"></iframe>


