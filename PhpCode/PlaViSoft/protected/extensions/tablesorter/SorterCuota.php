<?php

include "Sorter.php";

class SorterCuota extends Sorter
{
    
        public function buttons($class, $data){
            //View, Edit and Delete Urls
            $view_url=Yii::app()->createAbsoluteUrl($class.'/view',array('id'=>$data->id));
            $edit_url=Yii::app()->createAbsoluteUrl($class.'/update',array('id'=>$data->id));
            $asentar_cuota_url=Yii::app()->createAbsoluteUrl($class.'/saldar',array('id'=>$data->id));
            $ver_imputacion_url=Yii::app()->createAbsoluteUrl('imputacion/verImputacion',array('id'=>$data->id));    
            //View, Edit, Delete Icons (bootstrap)
            $r = "
                <td>  
                    <a class='btn btn-small' title='Ver Cuota' href='".$view_url."'><i class='icon-search'></i></a>&nbsp; 
            ";
            if($data->saldada!='Si'){
                $r .= "
                    <a class='btn btn-small' title='Modificar Cuota' href='".$edit_url."'><i class='icon-edit'></i></a>&nbsp; 
                    <a class='btn btn-small' title='Saldar Cuota' href='".$asentar_cuota_url."'><i class='icon-shopping-cart'></i></a>
                ";                
            }
            else{
                $r .= "<a class='btn btn-small' title='Ver Imputación' href='".$ver_imputacion_url."'><i class='icon-retweet'></i></a>";                
            }
            $r .= "
                </td>
            ";
            
            return $r;
        }
        
	//Register CSS and Jquery
	public function registerClientScript()
	{
                parent::registerClientScript();
                
                $cs = Yii::app()->clientScript;

                $cs->registerCss('1',' 
                        .tablesorter-bootstrap tr.saldada td {
                            background-color: #E8E8E8;
                            color: #B8B8B8;
                        }
                        .tablesorter-bootstrap tr.no_saldada td {
                            color: red;
                        }
                ');
	}
        
        
        public function getRowStyle($data){
                if($data->saldada == 'Si'){
                    return 'class="saldada"';
                }
                return 'class="no_saldada"';                   
        }
        
}
?>
