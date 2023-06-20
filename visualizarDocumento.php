<?php 
$acao=$_REQUEST['acao'];
$data=$_REQUEST['data'];
$nomeDocumento=$_REQUEST['nome'];
$extensao=pathinfo($nomeDocumento, PATHINFO_EXTENSION);
$arImagens=array("jpg","JPG","png","PNG");
if(in_array($extensao, $arImagens)){?> 
<iframe src = "arquivos/<?php echo $data;?>/<?php echo $nomeDocumento;?>" width='100%' height='100%' allowfullscreen webkitallowfullscreen frameborder="0"></iframe>
<?php } else {?>
<iframe src = "ViewerJS/#../arquivos/<?php echo $data;?>/<?php echo $nomeDocumento;?>" width='100%' height='100%' allowfullscreen webkitallowfullscreen frameborder="0"></iframe>
<?php } ?>
