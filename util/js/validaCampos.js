function validaCamposCadastraUsuario(messageName,messageSenha,messageLogin){
      var txtNomeUsuario = document.getElementById('txtNomeUsuario');
      var txtLogin = document.getElementById('txtLogin');
      var txtSenha = document.getElementById('txtSenha');
      var cbxPerfilUsuario= document.getElementById('cbxPerfilUsuario');
      if((txtNomeUsuario.value=="") || ehLetra(txtNomeUsuario.value)){
        gerarNotificacao("<h2>"+messageName+"<h2>","error","div#areaNotificacao");
       txtNomeUsuario.focus();
       return;   
     }
      
    if((txtLogin.value=="") || ehLetra(txtLogin.value)){
       
       gerarNotificacao("<h2>"+messageLogin+"<h2>","error","div#areaNotificacao");
       txtLogin.focus();
       return;
     }
     
    if((txtSenha.value=="") || ehLetra(txtLogin.value)){ 
        gerarNotificacao("<h2>"+messageSenha+"<h2>","error","div#areaNotificacao");
        txtSenha.focus();
        return;
     }

      document.getElementById('formCadastraUsuario').submit();
   
  }//fim do function validaCamposCadastraUsuario

function limparCamposCadastraUsuario(){
   document.getElementById('txtNomeUsuario').value='';
   document.getElementById('txtLogin').value='';
   document.getElementById('txtSenha').value='';
  }// fim do function limparCamposCadastraUsuario

function limparCamposConfiguracao(){
   document.getElementById('txtTitulo').value='';
   document.getElementById('txtLogo').value='';
   document.getElementById('txtNomeEmpresa').value='';
  }// fim do function limparCamposCadastraUsuario

function validaCampoCadastroTipoDocumento(messageName,messageletter){
    var txtTipoDocumento= document.getElementById('txtTipoDocumento');
  if(txtTipoDocumento.value==""){
       gerarNotificacao("<h2>"+messageName+"<h2>","error","div#areaNotificacao");
       txtTipoDocumento.focus();
       return;   
    }
 if(ehLetra(txtTipoDocumento.value)){
      document.getElementById('txtTipoDocumento').value="";
      gerarNotificacao("<h2>"+messageletter+"<h2>","error","div#areaNotificacao");
      txtTipoDocumento.focus();
      return;   
    }
   document.getElementById('formCadastraTipoDocumento').submit();
   document.getElementById('txtTipoDocumento').value="";
}// fim do function validaCampoCadastroTipoDocumento

function validaCampoConfig(messageCompany,messageLogo,messageTitle){
    var txtNomeEmpresa= document.getElementById('txtNomeEmpresa');
    var txtLogo= document.getElementById('txtLogo');
    var txtTitulo=document.getElementById('txtTitulo')
  if(txtNomeEmpresa.value==""){
       gerarNotificacao("<h2>"+messageCompany+"<h2>","error","div#areaNotificacao");
       txtNomeEmpresa.focus();
       return;   
    }

    if(txtLogo.value==""){
       gerarNotificacao("<h2>"+messageLogo+"<h2>","error","div#areaNotificacao");
       txtLogo.focus();
       return;   
    }
    
    if(txtTitulo.value==""){
       gerarNotificacao("<h2>"+messageTitle+"<h2>","error","div#areaNotificacao");
       txtTitulo.focus();
       return;   
    }

   document.getElementById('formCadastraConfig').submit();
   
}// fim do function validaCampoConfig


function verificaCamposCadastroDocumento(){
 
var txtNomeDocumento= document.getElementById('txtNomeDocumento');
 if((txtNomeDocumento.value=="") || ehLetra(txtNomeDocumento.value)) {
       gerarNotificacao("<h2>O campo senha está vazio ou contém caracteres inválidos!<h2>","error","div#areaNotificacao");
       txtNomeDocumento.focus();
       return;   
    }


}

function ehLetra(texto){
  var letras="abcdefghyjklmnopqrstuvwxyz";
  var cont=0;
  texto = texto.toLowerCase();
  for(i=0; i<texto.length; i++){
      if (letras.indexOf(texto.charAt(i),0)!=-1){
            cont++;
      }
   }
 if(cont>0)
        return false
   else 
        return true;
}//fim do function

  function somenteNumero(e)
{
  var tecla=new Number();
  if(window.event) {
    tecla = e.keyCode;
  }
  else if(e.which) {
    tecla = e.which;
  }
  else {
    return true;
  }
  if((tecla >= "97") && (tecla <= "122")){
    return false;
  }
}

function somenteCaracteres(e)
{
  var tecla=new Number();
  if(window.event) {
    tecla = e.keyCode;
  }
  else if(e.which) {
    tecla = e.which;
  }
  else {
    return true;
  }
  if((tecla >= "33") && (tecla <= "64")){
    return false;
  }
}