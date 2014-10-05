<?php

include "Sorter.php";

class SorterSuscripcion extends Sorter
{
    
        public function buttons($class, $data){
            $r = '';
            //View, Edit and Delete Urls
            $view_url=Yii::app()->createAbsoluteUrl($class.'/view',array('id'=>$data->id));
            $edit_url=Yii::app()->createAbsoluteUrl($class.'/update',array('id'=>$data->id));
            $delete_url='"'.Yii::app()->createAbsoluteUrl($class.'/delete',array('id'=>$data->id)).'"';
            $del_data='"'.$data->id.'"';            
            $asentar_pago_url='"'.Yii::app()->createAbsoluteUrl('pago/create',array('suscripcion_id'=>$data->id)).'"';
            //View, Edit, Delete Icons (bootstrap)
            $r = "
                <td>  
                    <a class='btn btn-small' href='".$view_url."'><i class='icon-search'></i></a>&nbsp; 
                    <a class='btn btn-small' href='".$edit_url."'><i class='icon-edit'></i></a>&nbsp; 
                    <a class='btn btn-small' href='javascript:void(0);' onclick='del_data(".$delete_url.");'><i class='icon-trash'></i></a>&nbsp; 
                    <a class='btn btn-small' href=".$asentar_pago_url."><i class='icon-shopping-cart'></i></a>                       
                </td>
            ";
            
            return $r;
        }
        
}
?>
