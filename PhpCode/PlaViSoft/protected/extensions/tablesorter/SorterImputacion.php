<?php

include "Sorter.php";

class SorterImputacion extends Sorter
{
    
        public function buttons($class, $data){

            $delete_url='"'.Yii::app()->createAbsoluteUrl($class.'/delete',array('id'=>$data->id)).'"';
            $del_data='"'.$data->id.'"';
            $r = "
                <td>  
                    <a class='btn btn-small' href='javascript:void(0);' onclick='del_data(".$delete_url.");'><i class='icon-trash'></i></a>
                </td>
            ";
            
            return $r;
        }
        
}
?>
