<?php
//////==========> MOSTRA RETORNO DE ERROS
ini_set('display_errors', 1);
error_reporting(E_ALL);
  
//////==========> PÁGINA INICIAL
$home_url="https://localhost/veiculos/";
  
//////==========> PAGINA PASSADA POR QUERYSTRING, DEFAULT É 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;
  
//////==========> NÚMERO DE REGISTROS POR PÁGINA A SEREM MOSTRADAS
$records_per_page = 5;
  
//////==========> LIMITE DA QUERY RETORNADA
$from_record_num = ($records_per_page * $page) - $records_per_page;
?>
