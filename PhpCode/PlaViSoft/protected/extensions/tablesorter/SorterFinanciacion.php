<?php

include "Sorter.php";

class SorterFinanciacion extends Sorter
{
    
        public function buttons($class, $data){
            $r = '';
            //View, Edit and Delete Urls
            $view_url=Yii::app()->createAbsoluteUrl($class.'/view',array('id'=>$data->id));
            //View, Edit, Delete Icons (bootstrap)
            $r = "
                <td>  
                    <a class='btn btn-small'  data-toggle='tooltip' title='Ver Financiación'  href='".$view_url."'><i class='icon-search'></i></a>&nbsp; 
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
