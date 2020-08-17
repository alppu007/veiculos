<?php
//////==========> HEADERS REQUERIDOS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
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
  
//////==========> PEGA O ID DO VEÍCULO QUE SERÁ EDITADO E REALIZA COMPARAÇÃO
$data = json_decode(file_get_contents("php://input"));
$veic->id = $data->id;
  
//////==========> CARREGA OS VALORES DO VEÍCULO SELECIONADO
$veic->veiculo = $data->veiculo;
$veic->marca = $data->marca;
$veic->ano = $data->ano;
$veic->descricao = $data->descricao;
$veic->vendido = $data->vendido;
$veic->updated = $data->updated;
  
//////==========> ATUALIZA OS DADOS DO VEÍCULO
if($veic->atualiza()){
  
//////==========> MENSAGEM DE RESPOSTA EM CASO DE SUCESSO
    http_response_code(200);
    echo json_encode(array("message" => "O cadastro do veículo foi atualizado!"));
}
  
//////==========> MENSAGEM DE RESPOSTA EM CASO DE INSUCESSO
else{
     http_response_code(503);
     echo json_encode(array("message" => "Impossibilitado de atualizar o veículo"));
}
?>
