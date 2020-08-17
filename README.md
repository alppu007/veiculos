# Teste Veículos OnCar
Sistema simples de cadastro, busca, edição e deleção de veículos com back-end desenvolvido em PHP PDO MySQL e JSON para comunicação entre back-end e front-end, desenvolvido em HTML, CSS, JAVASCRIPT.


# Diretórios e arquivos do projeto:

# -veiculos/
 --index.html – html inicial, carrega todos os scripts do site e contém a div principal.

# --back/
  ---atualizar.php – recebe do front-end JSON com veículo que se deseja editar e atualiza os dados na base de dados.

  ---cadastrar.php – recebe do front-end JSON com os dados do veículo que se deseja cadastrar e isere esses dados na base de dados.

  ---consulta.php – gera JSON com todos os dados dos veículos cadastrados na base de dados e os disponibiliza para serem acessados pelo front-end.

  ---deletar.php – recebe do front-end JSON com o id do veículo que se deseja excluir e deleta veículo na base de dados.

  ---paginacao.php – gera JSON com todos os dados dos veículos cadastrados, limitando o número de veículos a serem mostrados por números de cadastros em cada página definidos no arquivo “classfun/classpag.php”.

  ---pesquisar.php – recebe do front-end JSON com a palavra que se deseja pesquisar, busca na base de dados e retorna ao front-end JSON com os dados dos veículos pesquisados.

# --classfun/
  ---clasapag.php – contém a classe criada para ajustar o número de veículos que serão mostrados por sessão de paginação,  e gera array contendo o número da página, endereço url e se sessão está ativa ou não para serem adicionados ao JSON gerado no arquivo “back/paginacao.php”.

  ---veiculos.php – contém a instância de conexão com a base de dados, e todas as funções para atualizar, cadastrar, consultar, deletar, paginar e pesquisar. Editar a linha 6 com o nome da tabela da base desejada ou criar base de dados contendo tabela com o nome veículos. Adicionar a essa tablea os campos: “id”, “veiculos”, “marca”, “ano”, “descricao”, “vendido”, “created”, “updated”.

# --config/
  ---core.php – retorna erros, defina a página incial, recebe querystring de páginas, e número de registros por página para serem mostradas.

  ---db.php – classe de acesso ao banco de dados, onde deve-se configurar o nome do host, nome da base de dados, usuário e senha para acesso ao mesmo. E função pública de conexão com a base de ados via PDO.

# --front/
  ---veiculos.js – contém html inicial do front-end.
	    	   
# --veiculos/
  ---atualizar.js – recebe array do formulário de edição do veículo, serializa, converte e envia JSON 	para o back-end.
 
  ---cadastrar.js – contém html com modal do formulário de cadastro e recebe array do formulário de cadastro do veículo, serializa e envia JSON para o back-end.

  ---deletar.js – transforma e envia o id no formato JSON para o back-end realizar a exclusão na base de dados do veículo desejado.

  ---lista.js – funções para mostrar a “Lista de veículos” e dos botões de paginação.

  ---pesquisa.js – recebe a palavra desejada através do formulário de pesquisa, envia ao url do back-end e recebe o JSON referente a palavra pesquisada e envia ao template do site para amostra

  ---solo.js – função para mostrar os dados do veículo ao clicar 

  ---template.js – carrega o template do site, contém função para abrir o modal editar de cada linha da lista de veículos, chcagem do checkbox do modal eitar loop de paginação.


# --node_modules/ - arquivos do bootstrap, jquery e js instalados através do node.
