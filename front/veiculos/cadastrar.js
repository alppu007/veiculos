$(document).ready(function(){
/////============> VARIÁVEL PARA RECEBER A DATA ATUAL
	  var hoje = new Date();
 /////============> HTML DO FORMULÁRIO PARA CARASTRAR VEÍCULOS
          var av=`
     	 <div class='modal' id='novajanela'>
          <div class='modal-dialog modal-dialog-centered modal-lg'>
           <div class='modal-content'>
            <!-- Modal Header -->
            <div class='modal-header'>
             <h4 class='modal-title'>Cadastrar Veículo</h4>
             <button type='button' class='close' data-dismiss='modal'>&times;</button>
            </div>
            <!-- Modal body -->
            <div class='modal-body'>
              <form id='cadveiculo' action='#' method='POST'> 
              <label><b>Veículo</b></label>
              <input type='text' class='form-control' name='veiculo' id='veiculo'><br>
               <div class='row'>
                <div class='col-sm-6'>
                 <label><b>Marca</b></label>
                 <input type='text' class='form-control' name='marca' id='marca'><br>
                </div>
                <div class='col-sm-6'>
                 <label><b>Ano</b></label>
                 <input type='text' class='form-control' name='ano' id='ano'><br>
                </div>
               </div>
               <label><b>Descrição</b></label>
               <textarea class='form-control' id='descricao' name='descricao' rows='6' cols='90'></textarea>
               <input style='visibility: hidden;' class='form-control' type='text' name='vendido' id='vendido' value='0'>
               <input style='visibility: hidden;' class='form-control' type='text' name='created' id='created' value='`+hoje.toISOString().substring(0,19).replace(/T/," ")+`'>
               <input style='visibility: hidden;' class='form-control' type='text' name='updated' id='updated' value='`+hoje.toISOString().substring(0,19).replace(/T/," ")+`'>
               </form>
               </div>
             <!-- Modal footer -->
            <div class='modal-footer'>
             <button type='submit' id='bcad' class='btn btn-primary'>Cadastrar</button>
             <button type='button' class='btn btn-primary' data-dismiss='modal'>Cancelar</button>
            </div>
            </form>
            <div id="resulta"></div>
    </div></div>`;
$("#modcad").html(av);

/////============> SERIALIZAÇÃO DO FORMULÁRIO DE CADASTRO
$.fn.serializeObject = function()
{
   var o = {};
   var a = this.serializeArray();
   $.each(a, function() {
       if (o[this.name]) {
           if (!o[this.name].push) {
               o[this.name] = [o[this.name]];
           }
           o[this.name].push(this.value || '');
       } else {
           o[this.name] = this.value || '';
       }
   });
   return o;
};

/////============> FUNÇÃO DO BOTÃO CASTRAR, CHAMADA DO BACK-END E ENVIO DO CADASTRO NO FORMATO JSON
       document.getElementById("bcad").addEventListener('click', function checajson(){
	var sdata = $("#cadveiculo").serializeObject();
	var form_data=JSON.stringify(sdata);
	console.log(sdata);
  	$.ajax({
        url: "back/cadastrar.php",
        type : "POST",
        contentType : 'application/json',
        data : form_data,
        success : function(result) {
/////============> ALERTA QUE O VEÍCULO FOI CADASTRADO COM SUCESSO E RETORNA PARA A INDEX
        alert("Veiculo cadastrado com sucesso!");
        window.location = "index.html";
    },
    error: function(xhr, resp, text) {
/////============> ALERTA CASO O VEÍCULO NÃO SEJA CADASTRADO CORRETAMENTE, RETORNA ERRO NO CONSOLE
        alert("Veiculo não cadastrado, preencha os campos novamente");
	window.location = "index.html";
        console.log(xhr, resp, text);
    }
});

return false;

}); 
});
 

