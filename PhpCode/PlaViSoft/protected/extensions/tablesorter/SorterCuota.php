<?php

include "Sorter.php";

class SorterCuota extends Sorter
{
    
        public function buttons($class, $data){
            //View, Edit and Delete Urls
            $view_url=Yii::app()->createAbsoluteUrl('Cuota/view',array('id'=>$data->id));
            $edit_url=Yii::app()->createAbsoluteUrl('Cuota/update',array('id'=>$data->id));
            //$asentar_pago_url=Yii::app()->createAbsoluteUrl('pago/saldar',array('cuota_id'=>$data->id));
            $asentar_pago_url=Yii::app()->createAbsoluteUrl('pago/create',array('cuota_id'=>$data->id));
            $ver_imputacion_url=Yii::app()->createAbsoluteUrl('imputacion/verImputacion',array('id'=>$data->id));    
            //View, Edit, Delete Icons (bootstrap)
            $r = "
                <td>  
                    <a class='btn btn-small' title='Ver Cuota' href='".$view_url."'><i class='icon-search'></i></a>&nbsp; 
            ";
            if($data->saldada==Cuota::NO_SALDADA){
                $r .= "
                    <a class='btn btn-small' title='Modificar Cuota' href='".$edit_url."'><i class='icon-edit'></i></a>&nbsp; 
                ";                
            }
            if(($data->saldada==Cuota::NO_SALDADA)||($data->saldada==Cuota::PARCIAL_SALDADA)){
                $r .= "
                    <a class='btn btn-small' title='Saldar Cuota' href='".$asentar_pago_url."'><i class='icon-shopping-cart'></i></a>
                ";                
            }
            if(($data->saldada==Cuota::SALDADA)||($data->saldada==Cuota::PARCIAL_SALDADA)){
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
                        .tablesorter-bootstrap tr.parcial_saldada td {
                            background-color: #E8E8FF;
                            color: blue;
                        }
                        
                ');
	}
        
        
        public function getRowStyle($data){
                if($data->saldada==Cuota::SALDADA){
                    return 'class="saldada"';
                }
                else if($data->saldada==Cuota::PARCIAL_SALDADA){
                    return 'class="parcial_saldada"';
                }
                else 
                return 'class="no_saldada"';                   
        }
        
}
?>
