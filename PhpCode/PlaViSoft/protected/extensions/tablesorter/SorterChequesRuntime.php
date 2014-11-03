<?php

include "Sorter.php";

class SorterChequesRuntime extends Sorter
{
    
        //Register CSS and Jquery
	public function registerClientScript()
	{
		$bu = Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets/');
                //Intialize CSS
                echo '<link rel="stylesheet" type="text/css" href="'.$bu . '/css/tablesorter.css'.'">';
                echo '<link rel="stylesheet" type="text/css" href="'.$bu . '/css/tablesorter.pager.css'.'">';
                echo '<link rel="stylesheet" type="text/css" href="'.$bu . '/css/bootstrap.css'.'">';
		//Intialize Jquery
                echo CHtml::scriptFile($bu . '/js/tablesorter.js');
                echo CHtml::scriptFile($bu . '/js/tablesorter.pager.js');
                echo CHtml::scriptFile($bu . '/js/tablesorter.widgets.js');
                echo CHtml::scriptFile($bu . '/js/tablesorter.widgets-filter-formatter.js');
                echo CHtml::scriptFile($bu . '/js/scripts.js');
	}    
    
        public function buttons($class, $data){
            $r = '';
            $delete_url='"'.Yii::app()->createAbsoluteUrl('Cuota/borrarCheque',array('id'=>$data->id)).'"';
            $del_data='"'.$data->id.'"';
            $r = "
                <td>  
                    <a class='btn btn-small' href='javascript:void(0);' data-toggle='tooltip' title='Borrar Cheque' onclick='borrarCheque(".$data->id.");'><i class='icon-trash'></i></a>
                </td>
            ";
            
            return $r;
        }
        
      
}
?>
