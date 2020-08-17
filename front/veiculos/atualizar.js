$(document).ready(function(){
 
//////==========> SERIALIZAÇÃO DO JSON PARA EDITAR CADASTRO DO VEICULO
    $.fn.serializeObject = function(){
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name]) {
            if (!o[this.name].push) {
               o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } 
        else {
            o[this.name] = this.value || '';
        }
    });
    return o;
   };

//////==========> ENVIO DO CONTEÚDO JSON PARA ATUALIZAR REGISTRO NO BACKEND
    $(document).on('click', '.bup', function checajson(){
        var sdata = $("#edveiculo").serializeObject();
        var form_data=JSON.stringify(sdata);
        console.log(sdata);
        $.ajax({
                url: "back/atualizar.php",
                type : "POST",
                contentType : 'application/json',
                data : form_data,
                success : function(result) {
//////==========> ALERTA VEÍCULO EDITADO COM SUCESSO E RETORNO PARA PÁGINA INICIAL OU QUE VOU ALGUM PROBLEMA, PERMANECE NO FORMULÁRIO E RETORNA ERRO NO CONSOLE
                    alert("Veiculo editado com sucesso!");
                    window.location = "index.html";
                    },
                error: function(xhr, resp, text) {
                    alert("Veiculo não editado, preencha os campos novamente");
                    console.log(xhr, resp, text);
                    }
        });
        return false;
    }); 
});

