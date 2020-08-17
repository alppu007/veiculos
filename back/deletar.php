<?php
//////==========> HEADERS REQUERIDOS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
//////==========> ARQUIVOS REQUERIDOS
include_once '../config/db.php';
include_once '../classfun/veiculos.php';
  
//////==========> REQUISIÇÃO DA CONEXÃO COM BANCO DE DADOS  
$db = new Database();
$pdo = $db->getConnection();
  
//////==========> PREPARA O OBJETO VEÍCULO
$veic = new Veiculo($pdo);
  
//////==========> PEGA O ID DO VEICULO E SEPARA PARA SER DELETADO
$data = json_decode(file_get_contents("php://input"));

$veic->id = $data->id;
  
//////==========> DELETA O VEÍCULO
if($veic->delete()){

//////==========> MENSAGEM DE RESPOSTA EM CASO DE SUCESSO
    http_response_code(200);
    echo json_encode(array("message" => "O veículo foi excluído!"));
}
  
//////==========> MENSAGEM DE RESPOSTA EM CASO DE INSUCESSO
else{
  
    http_response_code(503);
    echo json_encode(array("message" => "Impossibilitado de excluir o veículo!"));
}
?>
