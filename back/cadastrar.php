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
  
//////==========> PEGA OS DADOS PARA O CADASTRO
$data = json_decode(file_get_contents("php://input"));
  
//////==========> ROTINA PARA CHECAR SE NÃO HÁ DADOS VAZIOS
if(
    !empty($data->veiculo) &&
    !empty($data->marca) &&
    !empty($data->ano) &&
    !empty($data->descricao)&&
    ($data->vendido<=1)
  ){
  
//////==========> DEFINE OS VALORES DO VEÍCULO
    $veic->veiculo = $data->veiculo;
    $veic->marca = $data->marca;
    $veic->ano = $data->ano;
    $veic->descricao = $data->descricao;
    $veic->vendido = intval($data->vendido);
    $veic->created = date('Y-m-d H:i:s');
      
//////==========> ADICIONA O VEÍCULO
    if($veic->adicionar()){
  
//////==========> MENSAGEM DE RESPOSTA EM CASO DE SUCESSO
        http_response_code(201);
        echo json_encode(array("message" => "O veículo foi adicionado!"));
    }
  
//////==========> MENSAGEM DE RESPOSTA EM CASO DE INSUCESSO
    else{
         http_response_code(503);
         echo json_encode(array("message" => "Impossibilitado de adicionar o veículo!"));
    }
}
  
//////==========> MENSAGEM DE RESPOSTA EM CASO DADOS ESTEJAM INCOMPLETOS
else{
  
    http_response_code(400);
    echo json_encode(array("message" => "Dados incompletos, impossibilitando a adição do veículo!"));
}
?>
