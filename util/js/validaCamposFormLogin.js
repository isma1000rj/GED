function validaCamposFormLogin(messageUsuario,messageSenha){
var txLoginUsuario=document.getElementById('txLoginUsuario');
var txSenhaUsuario=document.getElementById('txSenhaUsuario');
if(txLoginUsuario.value==""){
        gerarNotificacao("<h2>"+messageUsuario+"<h2>","error","div#areaNotificacao");
        txLoginUsuario.focus();
        return;   
}

if(txSenhaUsuario.value==""){
       gerarNotificacao("<h2>"+messageSenha+"<h2>","error","div#areaNotificacao");
       txSenhaUsuario.focus();
       return;   
}
 document.getElementById('formLogin').submit();


}