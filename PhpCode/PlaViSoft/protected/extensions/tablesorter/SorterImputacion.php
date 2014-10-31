<?php

include "Sorter.php";

class SorterImputacion extends Sorter
{
    
        public function buttons($class, $data){

            $ver_imprimir_url=Yii::app()->createAbsoluteUrl('pago/print',array('id'=>$data->pago_id));  
            $delete_url='"'.Yii::app()->createAbsoluteUrl($class.'/delete',array('id'=>$data->id)).'"';
            $del_data='"'.$data->id.'"';
		//	var_dump($data->pago_id); die();
            $r = "
                <td>  
                    <a class='btn btn-small' href='javascript:void(0);' onclick='del_data(".$delete_url.");'><i class='icon-trash'></i></a>
                    <a class='btn btn-small' href='".$ver_imprimir_url."'><i class='icon-print'></i></a>
                </td>
            ";
            
            return $r;
        }
        
}
?>
