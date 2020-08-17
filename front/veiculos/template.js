/////============> TEMPLATE PRICIPAL DO SITE
function listaTemplate(data, keywords){
      
/////============> SESSÃO PESQUISA DE VEÍCULOS
    var pv =`
             <form id='pveiculos' action='#' method='post'>
                 <div class='input-group'>
                     <input type='text' value='` + keywords + `'class='form-control' name='pesquisa' id='pesquisa' placeholder='Pesquisar Veículo'>
                     <button style='font-size: 0px;' class='btn btn-dark' type='submit'><i class='material-icons'>search</i></button>
             </form>
                     <button id='btaddveic' style='font-size: 0px;' type='button' class='btn btn-primary font-weight-bold btaddveic' data-toggle='modal' data-target='#novajanela'><i class='material-icons'>add</i></button>
                 </div>`;
                 
$("#bpesquisa").html(pv);

/////============> SESSÃO LISTA DE VEÍCULOS 
    var lv = `<table>`
     $.each(data.records, function(key, val) {
        lv +=`
              <div class='container border border-secundary rounded-sm'>
                  <table class='table-borderless table-hover col-xl-12' id='lista'>
                      <tbody sytle='cursor: pointer;'>
                          <tr> 
                              <td class='border-bottom td_id' id='rowd' data-id='` + val.id + `'><span class='text-primary'><b>` + val.marca + `<b></span>
                                  <h6>` + val.veiculo + `</h6>
                                  <h6>` + val.ano + `</h6>
                                  <td class='border-bottom'>
                                  <button type='button' id='boted' class='btn btn-dark font-weight-bold btatveic float-right' data-id='` + val.id + `' data-toggle='modal' data-target='#janelaeditar' onclick='trow_edit(this)'><i class='material-icons'>edit</i></button>
                              </td> 
                          </tr>
                      </tbody>`;
     }); 
     lv +=`</table></div><br>`;
     
$("#lista").html(lv);

/////============> SESSÃO DOS DETALHES DO VEÍCULO
    compartid = $("td:first").attr('data-id');
//    console.log(compartid);
    
    $.getJSON("back/consulta_solo.php?id=" + compartid, function(key){
	var dv =`
 	         <div class='container border-secundary border-top border-bottom'>
                     <span class='text-info font-weight-bold h5' id='dveic'>` + key.veiculo + `</span>
                     <br><br>
                     <div class='row'>
                         <div class='col-sm-6'><span class='h6'>Marca</span><br>
                             <span class='font-weight-bold h6' id='dmarca'>` + key.marca + `</span>
                         </div>
                         <div class='col-sm-6'><span class='h6'>Ano</span><br>
                             <span class='font-weight-bold h6' id='dano'>` + key.ano + `</span>
                         </div>
                     </div><br>
                     <span class='h6'>Descrição</span><br>
                     <span id='ddescricao'>` + key.descricao + `</span>
                 </div><br>
                 <button id='boted1' class='btn btn-primary font-weight-bold btatveic float-right' data-id='` + key.id + `' data-toggle='modal' data-target='#janelaEditar'>EDITAR</button>`;
             
$('#deveiculo').html(dv);

/////============> SESSÃO MODAL EDITAR
    var hoje = new Date();
    var ev = ` 
              <div class='modal' id='janelaEditar'>
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
                                  <input type='text' class='form-control EdModalV' name='veiculo' id='veiculo' value='` + key.veiculo + `'><br>
                                  <div class='row'>
                                      <div class='col-sm-6'>
                                          <label><b>Marca</b></label>
                                          <input type='text' class='form-control EdModalM' name='marca' id='marca' value='` + key.marca + `'><br>
                                      </div>
                                      <div class='col-sm-6'>
                                          <label><b>Ano</b></label>
                                          <input type='text' class='form-control EdModalA' name='ano' id='ano' value='` + key.ano + `'><br>
                                      </div>
                                  </div>
                                  <label><b>Descrição</b></label>
                                  <textarea class='form-control EdModalD' name='descricao' id='descricao' rows='6' cols='90'>` + key.descricao + `</textarea>
                                  <div style='margin-left: 25px; margin-top: 20px; margin-bottom: -75px;'>
                                      <input style='background-color: green; width: 30px; height: 30px;' class='form-check-input' type='checkbox' name='vendido' id='vendido' value='` + key.vendido +`'>
                                      <label style='padding-left: 12px; padding-top: 10px;' class='form-check-label font-weight-bold' for='inlinecheckbox1'>Vendido</label> 
                                  <input style='visibility: hidden;' class='form-control' type='text' name='updated' id='updated' value='`+hoje.toISOString().substring(0,19).replace(/T/," ")+`'> 
                          </div>
    <!-- Modal footer -->
                          <div class='modal-footer'>
                              <button type='submit' class='btn btn-primary' id='bup'>Alterar</button>
                              <button type='button' class='btn btn-danger btdel' data-id='` + key.id + `'>Excluir</button>
                              <button type='button' class='btn btn-primary' data-dismiss='modal'>Cancelar</button>
                          </div>
                              </form>
              </div></div></div>`;

$("#modupdate").html(ev);

/////============> CHECA SE VENDIDO MARCA CHECKBOX
    var chbox = key.vendido;
        if(chbox==1){
            $('input:checkbox').prop('checked', true);
        }
      
});

/////============> SESSÃO DE PAGINAÇÃO
    for (x in data.paging.pages){
        if (data.paging){
        var nop = (data.paging.pages.length) -1;
        var cp = data.paging.pages[x].page;
        var inipag = data.paging.pages[0].page;
        var np=0;
        var i;
        for (i=0; i<nop; i++){
        json_urln = data.paging.pages[np].url;
        np ++;
        }
        for (i=1; i<nop; i++){
        json_urlp = data.paging.pages[np].url;
        np --;
        }
        }
       
        var bp = `<button id='first' style='font-size: 0px;' class='btn btpag' type='button' data-page='` + data.paging.first + `'><i class='material-icons'>first_page</i></button> 
                  <button id='bprev' style='font-size: 0px;' class='btn btpag bprev' type='button' data-page='` + json_urlp + `'><i class='material-icons'>navigate_before</i></button>
                  <button id='bnext' style='font-size: 0px;' class='btn btpag bnext' type='button' data-page='` + json_urln + `'><i class='material-icons'>navigate_next</i></button>
                  <button id='last' style='font-size: 0px;' class='btn btpag' type='button' data-page='` + data.paging.last + `'><i class='material-icons'>last_page</i></button>`;
        }
  $("#botoespag").html(bp);
    
}

/////============> FUNÇÃO BOTÃO EDITAR - LISTA DE VEÍCULOS
function trow_edit(){
   
    event.cancelBubble = true;
    
    $(".btatveic").on('click', function(){
        var id = $(this).attr("data-id");
        $.getJSON("back/consulta_solo.php?id=" + id, function(key){
                $('input.EdModalV').val(key.veiculo);
                $('input.EdModalM').val(key.marca);
                $('input.EdModalA').val(key.ano);
                $('textarea.EdModalD').val(key.descricao);
                $("#janelaEditar").modal('show');
        });
    });
}

    
