$(document).ready(function(){

/////============> SESSÃO CLIQUE PARA DETALHES VEÍCULOS
    $("#lista").on('click','tr', function(){
      
        var id = $(this).find("td").attr("data-id");
            		
	$.getJSON("back/consulta_solo.php?id=" + id, function(key){
	var dv =`
	         <div class='container border-secundary border-top border-bottom'>
                     <span class='text-info font-weight-bold h5' id='dveic'>`+ key.veiculo +`</span>
                     <br><br>
                     <div class='row'>
                         <div class='col-sm-6'><span class='h6'>Marca</span><br>
                             <span class='font-weight-bold h6' id='dmarca'>`+ key.marca +`</span>
                         </div>
                         <div class='col-sm-6'><span class='h6'>Ano</span><br>
                             <span class='font-weight-bold h6' id='dano'>`+ key.ano +`</span>
                         </div>
                     </div><br>
                    <span class='h6'>Descrição</span><br>
                    <span id='ddescricao'>`+ key.descricao +`</span>
                 </div><br>
                 <button type='button' id='boted1' class='btn btn-primary font-weight-bold btatveic float-right' data-id='` + key.id +`' data-toggle='modal' data-target='#janelaeditar'>EDITAR</button>`;

$('#deveiculo').html(dv);

/////============> SESSÃO MODAL EDITAR

    var hoje = new Date();
    var chbox = [];        
    var ev = ` 
              <div class='modal' id='janelaeditar'>
                  <div class='modal-dialog modal-dialog-centered modal-lg'>
                      <div id='modaleditar' class='modal-content'>
   
    <!-- Modal header --> 
                          <div class='modal-header'>
                              <h4 class='modal-title'>Editar Veículo</h4>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                          </div>

    <!-- Modal body -->
                          <div class='modal-body'>
                              <form id='edveiculo' calss='form-control' action='#' method='POST'>
                                  <input style='visibility: hidden;' class='form-control' type='text' name='id' id='id' value='` + key.id + `'>
                                  <label class='lb-sm'><b>Veículo</b></label>
                                  <input type='text' class='form-control' name='veiculo' id='veiculo' value='` + key.veiculo + `'><br>
                                  <div class='row'>
                                      <div class='col-sm-6'>
                                          <label><b>Marca</b></label>
                                          <input type='text' class='form-control' name='marca' id='marca' value='` + key.marca + `'><br>
                                      </div>
                                      <div class='col-sm-6'>
                                          <label><b>Ano</b></label>
                                          <input type='text' class='form-control' name='ano' id='ano' value='` + key.ano + `'><br>
                                      </div>
                                  </div>
                                  <label><b>Descrição</b></label>
                                  <textarea class='form-control' name='descricao' id='descricao' rows='6' cols='90'>` + key.descricao + `</textarea>
                                  <div style='margin-left: 25px; margin-top: 20px; margin-bottom: -30px;'>
                                      <input style='background-color: green; width: 30px; height: 30px;' class='form-check-input' type='checkbox' name='vendido' id='vendido' value='` + key.vendido +`'>
                                      <label style='padding-left: 12px; padding-top: 8px;' class='form-check-label font-weight-bold' for='inlinecheckbox1'>Vendido</label> 
                                  </div>
                                  <input style='visibility: hidden;' class='form-control' type='text' name='updated' id='updated' value='` + hoje.toISOString().substring(0,19).replace(/T/," ") + `'> 
                          </div>
                          
    <!-- Modal footer -->
                          <div class='modal-footer'>
                              <button type='submit' class='btn btn-primary bup' id='bup'>Alterar</button>
                              <button type='button' class='btn btn-danger btdel' data-id='` + key.id + `'>Excluir</button>
                              <button type='button' class='btn btn-primary' data-dismiss='modal'>Cancelar</button>
                          </div>
                              </form>
              </div></div></div>`;
              
$("#modupdate").html(ev);

/////============> CHECA SE VENDIDO MARCA CHECKBOX
	var chbox = key.vendido;
	console.log(chbox);
	if(chbox==1){
	$('input:checkbox').prop('checked', true);
	}
	
	});
    });
 
});
