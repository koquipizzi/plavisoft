<?php

include "Sorter.php";

class SorterPago extends Sorter
{
    
        public function buttons($class, $data){
            $r = '';
            //View, Edit and Delete Urls
            $view_url=Yii::app()->createAbsoluteUrl($class.'/view',array('id'=>$data->id));
            $ver_imputacion_url=Yii::app()->createAbsoluteUrl('imputacion/verImputacion',array('pago_id'=>$data->id));  
            $ver_imprimir_url=Yii::app()->createAbsoluteUrl('pago/print',array('id'=>$data->id));  
            $ver_imprimir_logo=Yii::app()->createAbsoluteUrl('pago/printLogo',array('id'=>$data->id));  
            $delete_url='"'.Yii::app()->createAbsoluteUrl($class.'/delete',array('id'=>$data->id)).'"';
            $del_data='"'.$data->id.'"';
            //View, Edit, Delete Icons (bootstrap)
            $r = "
                <td>  
                    <a class='btn btn-small' data-toggle='tooltip' title='Ver Detalles'  href='".$view_url."'><i class='icon-search'></i></a>&nbsp; 
                    <a class='btn btn-small' data-toggle='tooltip' title='Ver Imputación' href='".$ver_imputacion_url."'><i class='icon-retweet'></i></a>
                    <a class='btn btn-small' title='Imprimir' data-toggle='tooltip' target='_blank'  href='".$ver_imprimir_url."'>  <i class='icon-print'></i></a>
                    <a class='btn btn-small' title='Imprimir Logo CVI' data-toggle='tooltip' target='_blank'  href='".$ver_imprimir_logo."'>  <i class='icon-leaf'></i></a>
                    <a class='btn btn-small' data-toggle='tooltip' title='Eliminar' href='javascript:void(0);' onclick='del_data(".$delete_url.");'><i class='icon-trash'></i></a>
                </td>
            ";
			
  
            return $r;
			
			
        }
        
}
?>
