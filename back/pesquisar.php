<?php
//////==========> HEADERS REQUERIDOS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
//////==========> ARQUIVOS REQUERIDOS
include_once '../config/core.php';
include_once '../config/db.php';
include_once '../classfun/veiculos.php';
  
//////==========> REQUISIÇÃO DA CONEXÃO COM BANCO DE DADOS 
$db = new Database();
$pdo = $db->getConnection();
  
//////==========> PREPARA O OBJETO VEÍCULO
$veic = new Veiculo($pdo);
  
//////==========> PEGA AS PALAVRAS CHAVE PARA PEQUISA
$keywords=isset($_GET["p"]) ? $_GET["p"] : "";
  
//////==========> QUERY VEÍCULOS E CONTAGEM DE LINHAS
$stmt = $veic->search($keywords);
$num = $stmt->rowCount();
  
//////==========> CHECA SE REGISTROS FORAM ENCONTRADOS E PREPARA ARRAY DOS VEÍCULOS
if($num>0){
  
    $veic_arr["records"]=array();
     
//////==========> RETORNA O CONTEÚDO DA PESQUISA
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
  
//////==========> ENVIO DO JSON CODIFICADO
    http_response_code(200);
    echo json_encode($veic_arr);
}
  
else{
 //////==========> MENSAGEM DE RESPOSTA EM CASO DE INSUCESSO 
    http_response_code(404);
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>
