<?php

Yii::import('zii.widgets.CPortlet');
Yii::import("application.controllers.SuscripcionController");


class StatsTotal extends CPortlet
{	
	public $item;
	public $htmlOptions=array();
	
    public function init()
    {
   ///     $this->title="Estadísticas";		
        parent::init(); 
    }
 
    protected function renderContent()
    {	if(isset($this->htmlOptions))
		{
			echo CHtml::openTag('div',$this->htmlOptions)."\n";
		/*	$id_susc = Yii::app()->controller->susc;
	    	$suscripcion=new SuscripcionController($this->item);
			$pagos = $suscripcion->sumaPagos($this->item);
			$total = $suscripcion->sumaTotales($this->item);
			if ($this->item != NULL)*/
			$total = 23000;
			$pagos = 3000;
        	$this->render('StatsTotal', array('total'=> $total, 'pagos'=> $pagos) ); 
			echo CHtml::closeTag('div');
		}
    	
    }
}

?>