<?php
if(!isset($_SESSION['idUsuario'])){
   
  require_once dirname(__FILE__).'util/funcoes.php/';
	direciona("formLogin.php");
	
}?>
<?php 
  $permissoes=$_SESSION['permissoesUsuario'];
if($permissoes['cdr_documento']=='S'){?>
<html>
<body>
<form action="controladores/cadastrarDocumentoAcao.php?acao=gravarDocumento" method="post" enctype="multipart/form-data" name="formGravaDocumento" id="formGravaDocumento">
  <table width="464" border="1" align="center">
    <tr>
      <th width="454" scope="col"><?php translateMsg('Register Document');?></th>
    </tr>
    <tr>
      <th height="20" align="right" scope="row"><div align="left"><?php translateMsg('Name:');?> <input border="0" name="txtNomeDocumento" type="text" id="txtNomeDocumento" size="60" maxlength="80" /></div></th>
    </tr>
    <tr>
      <th align="left" scope="row"><?php translateMsg('Document type:');?> 
        <select name="cbxTipoDocumento" id="cbxTipoDocumento">
        <?php for($i=0;$i<$operacao->qtdRegistrosTipoDoc;$i++){
	             $dados = $operacao->resultado->FetchRow();?>
          <option value="<?php echo $dados['id_tipo']?>"><?php echo $dados['descricao']?></option>
          <?php }?>
      </select>
              </th>
    </tr>
    <tr>
      <th align="left" scope="row"><?php translateMsg("Access level:");?>
        <select name="cbxNivelAcesso" size="1"  id="cbxNivelAcesso">
          <?php for($i=0;$i<$operacao->qtdRegistrosNivelAcesso;$i++){
	            $dadosNivelAcesso = $operacao->resultadoNivelAcesso->FetchRow();?>
              <option value="<?php echo $dadosNivelAcesso['id_nivel']?>"><?php echo $dadosNivelAcesso['descricao']?></option>
                <?php }?>
       </select>
      </th>
    </tr>
    <tr>
      <th height="59" align="left" scope="row"><?php translateMsg('Document:');?>
      <input name="arquivoDescricao" type="file" id="arquivoDescricao" class="inputfile" height="60"/></th>
    </tr>
    <tr>
      <th height="28" align="left" scope="row">
              <div class="progress" >
                 <div class="bar"></div >
                 <div class="percent" ></div >
		      </div>
          <div id="status"></div> 
      </th>
    </tr>
      <tr>
    </tr>
      <tr>
        <th height="35" align="center" scope="row">
          <input type="submit" name="btSalvar" id="btSalvar" value="<?php translateMsg('Register');?>"/>
          <input type="reset" name="btLimpar" id="btLimpar" value="<?php translateMsg('Clean');?>" onclick="reset" />
         <input type="reset" name="btCancelar" id="btCancelar" value="<?php translateMsg('Cancel');?>"/>
        </th>
    </tr>
  </table>
</form>
<script>
(function() 
{
  var bar = $('.bar');
  var percent = $('.percent');
  var status = $('#status');
  var mensageName ="<?php translateMsg("The name field is empty or contains invalid characters!");?>";
  var mesageDoc="<?php translateMsg("The document field is empty.");?>";  
  $(document.getElementById('formGravaDocumento')).ajaxForm({
        
         beforeSend: function() {
         if((txtNomeDocumento.value=="") || ehLetra(txtNomeDocumento.value)){
         gerarNotificacao("<h2>"+mensageName+"<h2>","error","div#areaNotificacao");
         document.getElementById('txtNomeDocumento').focus();
         document.getElementById('txtNomeDocumento').reset();
         }
       if(document.getElementById('arquivoDescricao').value==""){
           gerarNotificacao("<h2>"+mesageDoc+"<h2>","error","div#areaNotificacao");
           document.getElementById('arquivoDescricao').focus();
           document.getElementById('arquivoDescricao').reset();
          }

          status.empty();
          var percentVal = '0%';
          bar.width(percentVal)
          percent.html(percentVal);
      },
      uploadProgress: function(event, position, total, percentComplete) {
          var percentVal = percentComplete + '%';
          bar.width(percentVal)
          percent.html(percentVal);
      //console.log(percentVal, position, total);
      },
      success: function() {
          var percentVal = '100%';
          bar.width(percentVal)
          percent.html(percentVal);
      },
    complete: function(xhr) {
    status.html(xhr.responseText);
    }
  }); 
})();    
</script>
</body>
</html>
<?php }else{
   geraPedidoConfirmacao("<h3>".getTranslateMsg('Attention!')."</h3></br>" ."<h3>".getTranslateMsg('The user does not have access to this module.')."<h3>","error","center");
} ?> 
