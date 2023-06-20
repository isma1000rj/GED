function gerarNotificacao(msg,tipo,container) {
        document.getElementById('areaNotificacao').innerHTML = "";
        var n =$(container).noty({
                text        : msg,
                type        : tipo,
                dismissQueue: true,
                theme       : 'relax',
                maxVisible  : 10,
                animation: {
                            open: 'animated tada', // Animate.css class names
                            close: 'animated fadeOut', // Animate.css class names
           }
            });
        console.log('html: ' + n.options.id);
        setTimeout(function () {
     }, 2000);
}
function gerarPedidoConfirmacao(msg,tipo,layout){
 var n = noty({
            text        : msg,
            type        : tipo,
            dismissQueue: true,
            layout      : layout,
            modal       : true,   
            theme       : 'defaultTheme',
            buttons     : [
                {addClass: 'btn btn-primary', text: 'Ok', onClick: function ($noty)  {
                    window.location="index.php";
                }
                },
                {addClass: 'btn btn-danger', text: 'Cancelar', onClick: function ($noty) {
                   history.back();
                   
                }
                }
            ]
        });
        console.log('html: ' + n.options.id);
}

function gerarPedidoExclusao(msg,tipo,layout,acaoBtOk,codigo){
 var n = noty({
            text        : msg,
            type        : tipo,
            dismissQueue: true,
            layout      : layout,
            modal       : true,   
            theme       : 'defaultTheme',
            buttons     : [
                {addClass: 'btn btn-primary', text: 'Ok', onClick: function ($noty)  {
                    window.location="index.php?acao="+acaoBtOk+"&codigo="+codigo;
                }
                },
                {addClass: 'btn btn-danger', text: 'Cancelar', onClick: function ($noty) {
                   $noty.close();
                   
                }
                }
            ]
        });
        console.log('html: ' + n.options.id);
}

function gerarPedidoExclusaoDoc(msg,tipo,layout,acaoBtOk,codigo,data,nome){
 var n = noty({
            text        : msg,
            type        : tipo,
            dismissQueue: true,
            layout      : layout,
            modal       : true,   
            theme       : 'defaultTheme',
            buttons     : [
                {addClass: 'btn btn-primary', text: 'Ok', onClick: function ($noty)  {
                    window.location="index.php?acao="+acaoBtOk+"&codigo="+codigo+"&data="+data+"&nome="+nome;
                }
                },
                {addClass: 'btn btn-danger', text: 'Cancelar', onClick: function ($noty) {
                   $noty.close();
                   
                }
                }
            ]
        });
        console.log('html: ' + n.options.id);
}


function gerarPedidoContinuarCadastro(msg,tipo,layout,acaoBtOk,acaoBtCancelar){
 var n = noty({
            text        : msg,
            type        : tipo,
            dismissQueue: true,
            layout      : layout,
            modal       : true,   
            theme       : 'defaultTheme',
            buttons     : [
                {addClass: 'btn btn-primary', text: 'Sim', onClick: function ($noty)  {
                    window.location="index.php?acao="+acaoBtOk;
                }
                },
                {addClass: 'btn btn-danger', text: 'Não', onClick: function ($noty) {
                   window.location="index.php?acao="+acaoBtCancelar;
                   
                   
                }
                }
            ]
        });
        console.log('html: ' + n.options.id);
    }

function gerarAlertaInformacao(msg,tipo,layout,acaoBtOk){
 var n = noty({
            text        : msg,
            type        : tipo,
            dismissQueue: true,
            layout      : layout,
            modal       : true,   
            theme       : 'defaultTheme',
            buttons     : [
                {addClass: 'btn btn-primary', text: 'OK', onClick: function ($noty)  {
                    window.location="index.php?acao="+acaoBtOk;
                }
                }
                
                
            ]
        });
        console.log('html: ' + n.options.id);
    }
