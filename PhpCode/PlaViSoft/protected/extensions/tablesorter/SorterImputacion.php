<?php

include "Sorter.php";

class SorterImputacion extends Sorter
{
    
        public function buttons($class, $data){
            //View, Edit and Delete Urls
            $view_url=Yii::app()->createAbsoluteUrl($class.'/view',array('id'=>$data->id));
            $delete_url='"'.Yii::app()->createAbsoluteUrl($class.'/delete',array('id'=>$data->id)).'"';
            $del_data='"'.$data->id.'"';
            //View, Edit, Delete Icons (bootstrap)
            $r = "
                <td>  
                    <a class='btn btn-small' href='".$view_url."'><i class='icon-search'></i></a>&nbsp; 
                    <a class='btn btn-small' href='javascript:void(0);' onclick='del_data(".$delete_url.");'><i class='icon-trash'></i></a>
                </td>
            ";
            
            return $r;
        }
        
}
?>
