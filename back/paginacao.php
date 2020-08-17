<?php
//////==========> HEADERS REQUERIDOS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
//////==========> ARQUIVOS REQUERIDOS
include_once '../config/core.php';
include_once '../config/db.php';
include_once '../classfun/classpag.php';
include_once '../classfun/veiculos.php';
  
//////==========> PREPARA UTILIDADES
$utili = new Utili();
  
//////==========> REQUISIÇÃO DA CONEXÃO COM BANCO DE DADOS
$db = new Database();
$pdo = $db->getConnection();
  
//////==========> PREPARA O OBJETO VEÍCULO
$veic = new Veiculo($pdo);
  
//////==========> QUERY VEICULOS E CONTAGEM DE LINHAS
$stmt = $veic->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
  
//////==========> CHECA SE REGISTROS FORAM ENCONTRADOS E PREPARA ARRAY DOS VEÍCULOS E PAGINAS
if($num>0){
    $veic_arr=array();
    $veic_arr["records"]=array();
    $veic_arr["paging"]=array();
  
  //////==========> RETORNA O CONTEÚDO DA TABELA
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
  
        $veic_item=array(
            "id" => $id,
            "veiculo" => $veiculo,
            "marca" => $marca,
            "ano" => $ano,
            "descricao" => $descricao,
            "vendido" => $vendido,
            "created" => $created,
            "updated" => $updated
        );
  
        array_push($veic_arr["records"], $veic_item);
    }
  
  
//////==========> INCLUI A PAGINACAO
    $total_rows=$veic->count();
    $page_url="{$home_url}back/paginacao.php?";
    $paging=$utili->getPaging($page, $total_rows, $records_per_page, $page_url);
    $veic_arr["paging"]=$paging;

//////==========> ENVIO DO JSON CODIFICADO
    http_response_code(200);
    echo json_encode($veic_arr);
}
  
else{  
 //////==========> MENSAGEM DE RESPOSTA EM CASO DE INSUCESSO
    http_response_code(404);
    echo json_encode(
        array("message" => "Solicitação não encontrada.")
    );
}
?>
