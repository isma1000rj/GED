<?php 
if(isset($_REQUEST['fltr'])){
	$fltr=$_REQUEST['fltr'];
}else{
	$fltr="";
}
if(!isset($_REQUEST['pg'])){
	$_REQUEST['pg']=1;
}
if(!isset($paginaAtual)){
	$paginaAtual=1;
}
if(!isset($_SESSION['limiteDePaginas'])){
	$_SESSION['limiteDePaginas']=6;
}
echo '<div align="center" class="botoes-pagincao">';
echo '<a href="?acao='.$_REQUEST['acao'].'&fltr='.$fltr.'&pg=1"><img src="imagens/priPagina.png" alt="Primeira Página" title="Primeira Página"/></a>';  
echo '<a href="?acao='.$_REQUEST['acao'].'&fltr='.$fltr.'&pg='.$_REQUEST['pg'].'"><img src="imagens/prxPagina.png" alt="Próxima Página" title="Próxima Página"/></a>';  
echo '<a href="?acao='.$_REQUEST['acao'].'&fltr='.$fltr.'&pg='.($paginaAtual-1).'"><img src="imagens/pgAnterior.png" alt="Página Anterior" title="Página Anterior"/></a>';
echo '<a href="?acao='.$_REQUEST['acao'].'&fltr='.$fltr.'&pg='.$_SESSION['limiteDePaginas'].'"><img src="imagens/ulPagina.png" alt="Ùltima Pagina" title="Ùltima Pagina"/></a>';  
echo '</div>'; 
?>

