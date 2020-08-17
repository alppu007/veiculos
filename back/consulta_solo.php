<?php
//////==========> HEADERS REQUERIDOS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
//////==========> ARQUIVOS REQUERIDOS
include_once '../config/db.php';
include_once '../classfun/veiculos.php';
  
//////==========> REQUISIÇÃO DA CONEXÃO COM BANCO DE DADOS    
$db = new Database();
$pdo = $db->getConnection();
  
//////==========> PREPARA O OBJETO VEÍCULO
$veic = new Veiculo($pdo);
  
//////==========> PEGA O ID DO VEÍCULO DESEJADO
$veic->id = isset($_GET['id']) ? $_GET['id'] : die();
  
//////==========> LE OS DETALHES DO VEÍCULO PARA SER EDITADO
$veic->consultaSolo();
  
//////==========> CHECA SE VEÍCULO NÃO É NULO E CRIA ARRAY DE DADOS
if($veic->veiculo!=null){

    $veic_arr = array(
        "id" =>  $veic->id,
        "veiculo" => $veic->veiculo,
        "marca" => $veic->marca,
        "ano" => $veic->ano,
        "descricao" => $veic->descricao,
        "vendido" => $veic->vendido,
        "created" => $veic->created,
        "updated" => $veic->updated
  
    );
  
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
