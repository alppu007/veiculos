<?php
//////==========> CLASSE DA PAGINAÇÃO DOS VEICULOS
class Utili{
  
    public function getPaging($page, $total_rows, $records_per_page, $page_url){
  
//////==========> ARRAY DA PAGINAÇÃO
        $paging_arr=array();
  
//////==========> BOTÃO DA PRIMEIRA PÁGINA
        $paging_arr["first"] = $page>1 ? "{$page_url}page=1" : "";
  
//////==========> CALCULO DE TODOS OS VEÍCULOS PAR SABER O NUMERO DE PAGIANS
        $total_pages = ceil($total_rows / $records_per_page);
  
//////==========> NÚMERO DE LINHAS PARA SEREM MOSTRADAS
        $range = 5;
  
//////==========> MOSTRA LINK DO NÚMERO DE PÁGINAS EM VOLTA DA PÁGINA ATUAL
        $initial_num = $page - $range;
        $condition_limit_num = ($page + $range)  + 1;

//////==========> ARRAY DAS PÁGINAS  
        $paging_arr['pages']=array();
        $page_count=0;

//////==========> LOOP DO PAGINADOR COM NÚMERO DE PÁGINAS     
        for($x=$initial_num; $x<$condition_limit_num; $x++){
            if(($x > 0) && ($x <= $total_pages)){
                $paging_arr['pages'][$page_count]["page"]=$x;
                $paging_arr['pages'][$page_count]["url"]="{$page_url}page={$x}";
                $paging_arr['pages'][$page_count]["current_page"] = $x==$page ? "yes" : "no";
  
                $page_count++;
            }
        }
  
//////==========> BOTÃO DA ULTIMA PÁGINA
        $paging_arr["last"] = $page<$total_pages ? "{$page_url}page={$total_pages}" : "";
  
        return $paging_arr;
    }
  
}
?>
