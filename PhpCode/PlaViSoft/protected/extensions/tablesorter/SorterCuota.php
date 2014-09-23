<?php

include "Sorter.php";

class SorterCuota extends Sorter
{
    
        public function buttons($class, $data){
            $r = '';
            //View, Edit and Delete Urls
            $view_url=Yii::app()->createAbsoluteUrl($class.'/view',array('id'=>$data->id));
            $edit_url=Yii::app()->createAbsoluteUrl($class.'/update',array('id'=>$data->id));
            $asentar_cuota_url=Yii::app()->createAbsoluteUrl($class.'/saldar',array('id'=>$data->id));    
            //View, Edit, Delete Icons (bootstrap)
            $r = "
                <td>  
                    <a class='btn btn-small' title='Ver Cuota' href='".$view_url."'><i class='icon-search'></i></a>&nbsp; 
                    <a class='btn btn-small' title='Modificar Cuota' href='".$edit_url."'><i class='icon-edit'></i></a>&nbsp; 
                    <a class='btn btn-small' title='Saldar Cuota' href='".$asentar_cuota_url."'><i class='icon-shopping-cart'></i></a>
                </td>
            ";
            
            return $r;
        }
        
}
?>
