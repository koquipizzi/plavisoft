<?php

include "Sorter.php";

class SorterSuscripcion extends Sorter
{
    
        public function buttons($class, $data){
            $r = '';
            //View, Edit and Delete Urls
            $view_url=Yii::app()->createAbsoluteUrl($class.'/view',array('id'=>$data->id));
      //      $edit_url=Yii::app()->createAbsoluteUrl($class.'/update',array('id'=>$data->id));
      //      $delete_url='"'.Yii::app()->createAbsoluteUrl($class.'/delete',array('id'=>$data->id)).'"';
            $del_data='"'.$data->id.'"';            
            $asentar_pago_url='"'.Yii::app()->createAbsoluteUrl('pago/create',array('suscripcion_id'=>$data->id)).'"';
            $ver_cuotas_url  ='"'.Yii::app()->createAbsoluteUrl('cuota/admin',array('suscripcion_id'=>$data->id)).'"';
            $ver_imprimir_url=Yii::app()->createAbsoluteUrl('suscripcion/print',array('id'=>$data->id));              
            //View, Edit, Delete Icons (bootstrap)
            $r = "
                <td>  
                    <a class='btn btn-small' data-toggle='tooltip' title='Ver Detalles' href='".$view_url."'><i class='icon-search'></i></a>&nbsp; 
                    <a class='btn btn-small' title='Imprimir' data-toggle='tooltip' title='Imprimir'  href='".$ver_imprimir_url."'>  <i class='icon-print'></i></a>                            
                    <a class='btn btn-small'  data-toggle='tooltip' title='Asentar Pago' href=".$asentar_pago_url."><i class='icon-shopping-cart'></i></a>                       
                    <a class='btn btn-small'  data-toggle='tooltip' title='Ver Cuotas' href=".$ver_cuotas_url."><i class='icon-eye-open'></i></a>
            ";
            if($data->existePagos == TRUE){
                $ver_pagos_url = '"'.Yii::app()->createAbsoluteUrl('pago/admin' ,array('suscripcion_id'=>$data->id)).'"';                            
                $r .= "<a class='btn btn-small' data-toggle='tooltip' title='Ver Pagos' href=".$ver_pagos_url."><i class='icon-thumbs-up'></i></a>";
            }
            $r .= " 
                </td>
            ";
            
            return $r;
        }
        
        
        
}
?>
