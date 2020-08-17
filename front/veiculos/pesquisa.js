$(document).ready(function(){
 
/////============>  SUBMIT DO BOTÃO DE PEQUISA
    $(document).on('submit', '#pveiculos', function(){
 
/////============>  RECEBE AS PALAVARAS DESEJADAS
        var keywords = $(this).find(":input[name='pesquisa']").val();
       
/////============>  CHAMA O JSON DO BACK-END E ENVIA PALAVRA DESEJADA
        $.getJSON("back/pesquisar.php?p=" + keywords, function(data){
         
/////============>  CARREGA A PESQUISA NA LISTA DE VEÍCULOS
            listaTemplate(data, keywords);
          
         });
 
/////============>  EVITA DE CARREGAR TODA A PÁGINA NOVAMENTE
        return false;
    });
 
});
