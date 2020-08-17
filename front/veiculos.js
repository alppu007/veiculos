$(document).ready(function(){

//////==========> HTML INICIAL DO FRONT
    var p_ini=`
                <div class='container-fluid text-dark'>
    	            <h2>TESTE</h2>
                </div>
    
    <!-- Container barra de pesquisa e cadastro -->
                <div class='container'>
                    <div id='bpesquisa'></div>
                </div>  
	            <div id='modcad'></div>
                <br>
    
    <!-- fundo cinza -->
                <div class='bg-dark'><br>
    
    <!-- container da lista e detalhes do veículos-->
                    <div class='container'>
                        <div class='row'>
                            <div class='col-sm-6 border border-light rounded-sm bg-light'>
                                <h4><b>Lista de Veículos</b></h4>
                                <div id='lista'></div>
                                <div id='botoespag'class='btn-group botpagi' style='margin-top: -25px; float: right;'></div>
                            </div>

    <!-- cocluna dos Detalhes do veículo -->         
                            <div class='col-sm-5 offset-sm-1 border border-light rounded-sm bg-light'>
                                <h4><b>Detalhes do veículo</b></h4>
                                <div id='deveiculo'></div>
                                <div id='modupdate'></div>
                            </div>
                        </div>
                    </div><br>
                </div>`;
 
//////==========> ENVIO PARA index.html
    $("#VEICULOS").html(p_ini);

});
