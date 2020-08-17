$(document).ready(function(){
 
/////============> INÍCIO DA FUNÇÃO AO CLICAR NO BOTÃO DELETAR
    $(document).on('click', '.btdel', function(){
    var veic_id = $(this).attr('data-id');

 
/////============> CARREGA O ENDEREÇO DO BACK-END E ENVIA O ID PARA SER EXCLUÍDO
    $.ajax({
        url: "back/deletar.php",
        type : "POST",
        dataType : 'json',
        data : JSON.stringify({ id: veic_id }),
        success : function(result) {
        // product was created, go back to products list
                    alert("Tem certeza que deseja excluir o veículo?");
                    window.location = "index.html";
                    },
                error: function(xhr, resp, text) {
                    alert("Veiculo não excluido!");
        // show error to console
                    console.log(xhr, resp, text);
                    }
        });
/////============> EVITA CARREGAR O SITE INTEIRO NOVAMENTE
        return false;
});
   
});


