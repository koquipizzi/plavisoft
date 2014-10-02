<?php

Yii::import('zii.widgets.CPortlet');
Yii::import("application.controllers.SuscripcionController");


class Stats extends CPortlet
{	
	public $item;
    public function init()
    {
        $this->title="Estadísticas";		
        parent::init(); 
    }
 
    protected function renderContent()
    {   $id_susc = Yii::app()->controller->susc;
    	$suscripcion=new SuscripcionController($this->item);
		$pagos = $suscripcion->sumaPagos($this->item);
		$total = $suscripcion->sumaTotales($this->item);
		if ($this->item != NULL)
        	$this->render('Stats', array('total'=> $total, 'pagos'=> $pagos) ); 
    }
}

?>