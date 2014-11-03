<?php

include "Sorter.php";

class SorterCheque extends Sorter
{
    
        public function buttons($class, $data){
            $r = '';
            //View, Edit and Delete Urls
            $view_url=Yii::app()->createAbsoluteUrl($class.'/view',array('id'=>$data->id));
            $r = "
                <td>  
                    <a class='btn btn-small' href='".$view_url."'><i class='icon-search'></i></a>&nbsp; 
            ";
            
            if(is_null($data->dadoFecha)){
                $edit_url=Yii::app()->createAbsoluteUrl($class.'/update',array('id'=>$data->id));                
                $r .= "<a class='btn btn-small'  data-toggle='tooltip' title='Modificar' href='".$edit_url."'><i class='icon-check'></i></a>&nbsp;";
            }
            $r .= "
                </td>
            ";
            
            
            return $r;
        }
        
}
?>
