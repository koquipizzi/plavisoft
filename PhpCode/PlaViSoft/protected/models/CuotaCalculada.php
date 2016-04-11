<?php

/** 
 * La clase extiende la funcionalidad del modelo cuota para contemplar el valor 
 * asignado al crear pagos.
 */

class CuotaCalculada extends CuotaSaldo{
        
        public $valorAsignado = 0;
        
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
//        public function rules()
//	{
//		$r = parent::rules();
//                
//                $r[] = array('valorAsignado', 'safe', 'on'=>'search');
//                
//                return $r;
//	}        
    
        public function getValorAsignadoStr(){
            return '$ '.Yii::app() -> format -> number($this->valorAsignado);
        }
        
        public function getDescription(){
            return $this->nro_cuota." - ".$this->cuotaStr." (".$this->saldoStr.")";
        }
          
    
    
}
