<?php

include "Sorter.php";

class SorterVivienda extends Sorter
{
    
        public function buttons($class, $data){
            $r = '';
            //View, Edit and Delete Urls
            $view_url=Yii::app()->createAbsoluteUrl($class.'/view',array('id'=>$data->id));
            $r = "
                <td>  
                    <a class='btn btn-small' href='".$view_url."' data-toggle='tooltip' title='Ver Detalles'  ><i class='icon-search'></i></a>&nbsp; 
                </td>
            ";
            
            return $r;
        }
        
        
        public function footer(){
            $r =  ' 
                <tfoot>\n
                    <tr>
                        <th colspan="7" class="pager form-horizontal">
                        </th>
                    </tr>
                </tfoot>\n';
            return $r;
        }
        
        
}
?>
