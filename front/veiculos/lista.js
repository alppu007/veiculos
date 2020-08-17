$(document).ready(function(){
 
/////============> CARREGA A LISTA DE VEÍCULOS AO CLICAR NOS BOTÕES DE PAGINAÇÃO
    mostraVeiculosP1();
 
	$(document).on('click', '.btpag', function(){
	 var json_url = $(this).attr('data-page');
 
/////============> MOSTRA A LISTA DE VEÍCULOS
         mostraVeiculos(json_url);
        });
              
});
 /////============> FUNÇÃO PARA CARREGAR O ENDEREÇO BACK-END EM UMA VARIÁVEL
    function mostraVeiculosP1(){
        var json_url="back/paginacao.php";
        mostraVeiculos(json_url);
    
    }
 
/////============> CARREGA A LISTA DE VEÍCULOS AO ENTRAR
    function mostraVeiculos(json_url){
 
/////============>    RECEBE A LISTA DE VEÍCULOS DO BACK-END
       $.getJSON(json_url, function(data){
       
/////============>    TEMPLETE HTML QUE CARREGA O RESTANTE DO FRONT-END
          listaTemplate(data, "");
       });
}

