<?php

include "Sorter.php";

class SorterPersona extends Sorter
{
    
        public function buttons($class, $data){
            $r = '';
            //View, Edit and Delete Urls
            $view_url=Yii::app()->createAbsoluteUrl($class.'/view',array('id'=>$data->id));
            $edit_url=Yii::app()->createAbsoluteUrl($class.'/update',array('id'=>$data->id));
            $delete_url='"'.Yii::app()->createAbsoluteUrl($class.'/delete',array('id'=>$data->id)).'"';
            $del_data='"'.$data->id.'"';
            //View, Edit, Delete Icons (bootstrap)
            $r = "
                <td>  
                    <a class='btn btn-small' data-toggle='tooltip' title='Ver Persona' href='".$view_url."'><i class='icon-search'></i></a>&nbsp; 
                    <a class='btn btn-small' data-toggle='tooltip' title='Modificar' href='".$edit_url."'><i class='icon-edit'></i></a>&nbsp; 
                    <a class='btn btn-small' data-toggle='tooltip' title='Eliminar' href='javascript:void(0);' onclick='del_data(".$delete_url.");'><i class='icon-trash'></i></a>
            ";
            if($data->existePagos == TRUE){
                $ver_pagos_url='"'.Yii::app()->createAbsoluteUrl('pago/admin' ,array('persona_id'=>$data->id)).'"';                        
                $r .= "<a class='btn btn-small' title='Pagos'  data-toggle='tooltip' title='Ver Pagos'   href=".$ver_pagos_url."><i class='icon-thumbs-up'></i></a>";
            }
            $r .= " 
                </td>
            ";
            
            return $r;
        }
        
}
?>
