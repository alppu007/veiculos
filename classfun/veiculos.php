<?php
class Veiculo{
  
//////==========> INSTÂNCIA DE CONEXÃO COM TABELA
    private $pdo;
    private $table_name = "veiculos";
  
    // OBJETOS
    public $id;
    public $veiculo;
    public $marca;
    public $ano;
    public $descricao;
    public $vendido;
    public $created;
    public $updated;
  
//////==========> CONSTRUTOR $PDO COM CONEXÃO DO BANCO DE DADOS
    public function __construct($pdo){
        $this->pdo = $pdo;
    }      
    
//////==========> FUNÇÃO ADICIONA VEÍCULO
    function adicionar(){
  
//////==========> QUERY PARA INSERIR OS VALORES
    $query = "INSERT INTO " . $this->table_name . " SET veiculo=:veiculo, marca=:marca, ano=:ano, descricao=:descricao, vendido=:vendido, created=:created";
  
//////==========> PREPARA A QUERY
    $stmt = $this->pdo->prepare($query);
  
//////==========> FILTRAGEM DOS VALORES
    $this->veiculo=htmlspecialchars(strip_tags($this->veiculo));
    $this->marca=htmlspecialchars(strip_tags($this->marca));
    $this->ano=htmlspecialchars(strip_tags($this->ano));
    $this->descricao=htmlspecialchars(strip_tags($this->descricao));
    $this->vendido=htmlspecialchars(strip_tags($this->vendido));
    $this->created=htmlspecialchars(strip_tags($this->created));
      
//////==========> BIND DOS VALORES
    $stmt->bindParam(":veiculo", $this->veiculo);
    $stmt->bindParam(":marca", $this->marca);
    $stmt->bindParam(":ano", $this->ano);
    $stmt->bindParam(":descricao", $this->descricao);
    $stmt->bindParam(":vendido", $this->vendido);
    $stmt->bindParam(":created", $this->created);
      
//////==========> EXECUTA A QUERY
    if($stmt->execute()){
        return true;
    }
  
    return false;
    }

//////==========> FUNÇÃO LISTA DE TODOS PRODUTOS
    function consulta(){
  
//////==========> SELECIONA TODAS AS QUERYS
    $query = "SELECT * FROM " . $this->table_name . " ORDER BY created DESC";
  
//////==========> PREPARA DECLARAÇÃO DA QUERY
    $stmt = $this->pdo->prepare($query);
  
//////==========> EXECUTA A QUERY
    $stmt->execute();
  
    return $stmt;
}


//////==========> FUNÇÃO LISTA UM UNICO PRODUTO PARA EDIÇÃO OU DELEÇÃO
    function consultaSolo(){
  
//////==========> SELECIONA SOMENTE UMA QUERY PELO ID
    $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
  
//////==========> PREPARA DECLARAÇÃO DA QUERY
    $stmt = $this->pdo->prepare($query);
  
//////==========>BIND DO ID DO PRODUTO PARA A EDIÇÃO OU DELEÇÃO
    $stmt->bindParam(1, $this->id);
  
//////==========> EXECUTA A QUERY
    $stmt->execute();
  
//////==========> RECEBE A LINHA RETORNADA
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    // set values to object properties
    $this->veiculo = $row['veiculo'];
    $this->marca = $row['marca'];
    $this->ano = $row['ano'];
    $this->descricao = $row['descricao'];
    $this->vendido = $row['vendido'];
    $this->created = $row['created'];
    $this->updated = $row['updated'];
    }


//////==========> FUNÇÃO ATUALIZAR VEÍCULO
    function atualiza(){
  
//////==========> QUERY UPDATE
    $query = "UPDATE " . $this->table_name . " SET veiculo = :veiculo, marca = :marca, ano = :ano, descricao = :descricao, vendido = :vendido, updated = :updated WHERE id = :id";
  
//////==========> PREPARA DECLARAÇÃO DA QUERY
    $stmt = $this->pdo->prepare($query);
  
//////==========> FILTRAGEM DE CARACTERES
    $this->veiculo=htmlspecialchars(strip_tags($this->veiculo));
    $this->marca=htmlspecialchars(strip_tags($this->marca));
    $this->ano=htmlspecialchars(strip_tags($this->ano));
    $this->descricao=htmlspecialchars(strip_tags($this->descricao));
    $this->vendido=htmlspecialchars(strip_tags($this->vendido));
    $this->updated=htmlspecialchars(strip_tags($this->updated));
    $this->id=htmlspecialchars(strip_tags($this->id));
       
//////==========> BIND DOS VALORES A SEREM INSERIDOS
   
    $stmt->bindParam(':veiculo', $this->veiculo);
    $stmt->bindParam(':marca', $this->marca);
    $stmt->bindParam(':ano', $this->ano);
    $stmt->bindParam(':descricao', $this->descricao);
    $stmt->bindParam(':vendido', $this->vendido);
    $stmt->bindParam(':updated', $this->updated);
    $stmt->bindParam(':id', $this->id);   

//////==========> EXECUTA A QUERY
    if($stmt->execute()){
        return true;
    }
  
    return false;
    }


//////==========> FUNÇÃO DELETA O PRODUTO
    function delete(){
  
//////==========> QUERY PARA DELETAR VEICULO PELO ID
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
  
//////==========> PREPARA A QUERY
    $stmt = $this->pdo->prepare($query);
  
//////==========> FILTRA OS CARACTERES
    $this->id=htmlspecialchars(strip_tags($this->id));
  
//////==========> BIND DO ID DO VEÍCULO DELETADO
    $stmt->bindParam(1, $this->id);
  
//////==========> EXECUTA A QUERY
    if($stmt->execute()){
        return true;
    }
  
    return false;
    }

//////==========> FUNÇÃO PESQUISA VEÍCULOS
    function search($keywords){

//////==========> SELECIONA TODAS AS QUERYS
    $query = "SELECT * FROM " . $this->table_name . " WHERE veiculo LIKE ? OR marca LIKE ? OR ano LIKE ? OR descricao LIKE ? ORDER BY created DESC";
  
//////==========> PREPARA A DECLARAÇÃO DA QUERY
    $stmt = $this->pdo->prepare($query);
  
//////==========> FILTRA OS CARACTERES
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
  
//////==========> BIND DOS VALORES DESEJADOS
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);
    $stmt->bindParam(4, $keywords);
  
//////==========> EXECUTA A QUERY
    $stmt->execute();
  
    return $stmt;
}
    
//////==========> FUNÇÃO PARA LISTAR VEÍCULOS EM GRUPOS
    public function readPaging($from_record_num, $records_per_page){
  
//////==========> SELECIONA AS QUERIES
    $query = "SELECT * FROM " . $this->table_name . " ORDER BY created DESC LIMIT ?, ?";
  
//////==========> PREPARA A DECLARAÇÃO DA QUERY
    $stmt = $this->pdo->prepare($query);
  
//////==========> BIND DOS VALORES DO NÚMERO DE REGISTROS E REGISTROS POR PÁGINA
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
  
//////==========> EXECUTA A QUERY
    $stmt->execute();
  
    return $stmt;
}

//////==========> FUNÇÃO PARA PAGINAÇÃO DOS VEÍCULOS
    public function count(){
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
  
    $stmt = $this->pdo->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    return $row['total_rows'];
}

}

?>
