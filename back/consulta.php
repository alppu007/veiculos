<?php
//////==========> HEADERS REQUERIDOS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
//////==========> ARQUIVOS REQUERIDOS
include_once '../config/db.php';
include_once '../classfun/veiculos.php';

//////==========> REQUISIÇÃO DA CONEXÃO COM BANCO DE DADOS    
$db = new Database();
$pdo = $db->getConnection();

//////==========> PREPARA O OBJETO VEÍCULO
$veic = new Veiculo($pdo);
  
//////==========> QUERY DOS VEÍCULOS
$stmt = $veic->consulta();
$num = $stmt->rowCount();
  
//////==========> CHECA POR VALORES DE REGISTROS ENCONTRADOS MAIOR QUE ZERO
if($num>0){
  
//////==========> ARRAY VEICULOS
    $veic_arr=array();

//////==========> RETORNA O CONTEÚDO DA TABELA
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
   
//////==========> EXTRAÇÃO DAS LINHAS
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
        array_push($veic_arr, $veic_item);  

    }
  
//////==========> ENVIO DO JSON CODIFICADO
    http_response_code(200);
    echo json_encode($veic_arr);
}
  
else{
  
//////==========> MENSAGEM DE RESPOSTA EM CASO DE INSUCESSO
    http_response_code(404);
    echo json_encode(array("message" => "Nenhum veículo encontrado!"));
}

?>
