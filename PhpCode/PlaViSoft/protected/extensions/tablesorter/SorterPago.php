<?php

include "Sorter.php";

class SorterPago extends Sorter
{
    
        public function buttons($class, $data){
            $r = '';
            //View, Edit and Delete Urls
            $view_url=Yii::app()->createAbsoluteUrl($class.'/view',array('id'=>$data->id));
            $ver_imputacion_url=Yii::app()->createAbsoluteUrl('imputacion/verImputacion',array('pago_id'=>$data->id));  
            //View, Edit, Delete Icons (bootstrap)
            $r = "
                <td>  
                    <a class='btn btn-small' href='".$view_url."'><i class='icon-search'></i></a>&nbsp; 
                    <a class='btn btn-small' title='Ver Imputación' href='".$ver_imputacion_url."'><i class='icon-retweet'></i></a>
                </td>
            ";
            
            return $r;
        }
        
}
?>
