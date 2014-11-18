<?php

abstract class CalculoCuota {
    
    abstract protected function getCuotasCancelar($cuotasDisponibes);
    
    abstract protected function getCuotaSaldo($cuotasRestantes);
    
    protected function obtenerCuotasDisponibles($suscripcion_id) {
        $criteria = new CDbCriteria;
            $criteria->compare('suscripcion_id', $suscripcion_id);
            $criteria->compare('saldada', '<>'.Cuota::SALDADA);
            $criteria->order = 'nro_cuota';
           
        $aux = CuotaCalculada::model()->findAll($criteria);
        if (isset($aux)&&is_array($aux)&&(count($aux)>0)) {
            return $aux;
        }
        throw new CHttpException(null,'No se encuentra Cuota a Saldar');
    }

    protected function getCuotaVigente(&$cuotasDisponibes) {
        if (isset($cuotasDisponibes)&&is_array($cuotasDisponibes)&&(count($cuotasDisponibes)>0)) {
            return array_shift($cuotasDisponibes);
        }
        throw new CHttpException(null,'No se encuentra Cuota a Saldar');
    }
    
    protected function asignarValorCuota($valor, &$cuota){
        $resto = 0;
        $importe = $valor;
        if ( ($valor - $cuota->saldo) >= 0 ) {
            $importe = $cuota->saldo;
            $resto = $valor - $cuota->saldo;
        }
        
        $cuota->totalSaldado = $cuota->totalSaldado + $importe;
        $cuota->saldo = $cuota->valor - $cuota->totalSaldado;
        $cuota->valorAsignado = $importe;
        
        return $resto;
    }
    
    public function isManualImputation(){
        return FALSE;
    }
    
    public function calcularCuotas($suscripcion_id, $valor = 0) {
        
        $cuotas = array();                
        
        $cuotasDisponibes = $this->obtenerCuotasDisponibles($suscripcion_id);

        // Obtiene la cuota vigente de las cuotas disponibles y la quita del arreglo 
        $cuotaVigente = $this->getCuotaVigente($cuotasDisponibes);
        
        // Asigna el valor a la cuota y agrega la cuota al resultado
        $resto = $this->asignarValorCuota($valor, $cuotaVigente);
        $cuotas[] = $cuotaVigente;

        // Toma el resto de las cuotas
        if($resto > 0) {
            $cuotasRestantes = $this->getCuotasCancelar($cuotasDisponibes);
            if (isset($cuotasRestantes)&&is_array($cuotasRestantes)) {
                while(count($cuotasRestantes)>0) {
                    $cuota = $cuotasRestantes[0];
                    if ( ($resto - $cuota->saldo) > 0 ) {
                        $cuota = array_shift($cuotasRestantes);
                        $resto = $this->asignarValorCuota($resto, $cuota);
                        $cuotas[] = $cuota;
                    }
                    else {
                        break;
                    }
                }
            }
            if($resto>0) {
                $cuotaResto = $this->getCuotaSaldo($cuotasRestantes);
                $resto = $this->asignarValorCuota($resto, $cuotaResto);
                $cuotas[] = $cuotaResto;
            }
        }//if resto

        return $cuotas;        
    }
}

class VigenteUtimasCalculoCuota extends CalculoCuota {
    
    protected function getCuotaSaldo($cuotasDisponibes) {
        return array_shift($cuotasDisponibes);
    }
    
    protected function getCuotasCancelar($cuotasDisponibes) {
        return array_reverse($cuotasDisponibes);
    }    
    
}

class SaldoSiguienteCalculoCuota extends VigenteUtimasCalculoCuota {
    
    protected function getCuotaSaldo($cuotasDisponibes) {
        $aux = array_reverse($cuotasDisponibes);
        return array_shift($aux);
    }
  
}

class VigenteSiguientesCalculoCuota extends CalculoCuota {

    protected function getCuotaSaldo($cuotasDisponibes) {
        return array_shift($cuotasDisponibes);
    }
    
    protected function getCuotasCancelar($cuotasDisponibes) {
        return $cuotasDisponibes;
    }    

}

class ImputarCuotaManualmente extends CalculoCuota {
    
    private $imputaciones_ids = NULL;
    
    private $array_imputaciones_ids = array();
    
    public function getTotalImputado(){
        $totalImputado = 0;
        foreach ($this->getImputacionesRuntime() as $aux){
            $totalImputado = $totalImputado + $aux->valor;
        }
        return $totalImputado;
    }
    
    public function getImputacionPorCuota_id($cuota_id){
        foreach ($this->getImputacionesRuntime() as $aux){
            if($aux->cuota_id == $cuota_id){
                return $aux;
            }
        }
        return NULL;
    }
    
    public function setImputationsIDs($imputaciones_ids) {
        $this->imputaciones_ids = $imputaciones_ids;
        $this->array_imputaciones_ids = explode('#', $imputaciones_ids);
    }
    
    public function getImputationsIDs() {
        return $this->imputaciones_ids;
    }

    public function getImputacionesRuntime() {
        $criteria = new CDbCriteria;
        $criteria->addInCondition('id', $this->array_imputaciones_ids);
        return ImputacionRuntime::model()->findAll($criteria);
    }
    
    public function imputar($imputacion) {
        $encontrado = array_search($imputacion->id,$this->array_imputaciones_ids);
        if(is_null($encontrado)||($encontrado == FALSE)) {
            $this->array_imputaciones_ids[] = $imputacion->id;
            $this->imputaciones_ids = implode('#', $this->array_imputaciones_ids);
        }
    }
    
    private function cuotaImputadaRuntime($cuota, $imputacionesRuntime){
        foreach ($imputacionesRuntime as $imputacion) {
            if($cuota->id == $imputacion->cuota_id)
                return $imputacion;
        }
        return FALSE;
    }
    
    protected function getCuotaSaldo($cuotasDisponibes) {
        return NULL;
    }
    
    protected function getCuotasCancelar($cuotasDisponibes) {
        return NULL;
    }    
    
    public function calcularCuotas($suscripcion_id, $valor = 0) {
        $cuotasDisponibes = $this->obtenerCuotasDisponibles($suscripcion_id);
        $imputacionesRuntime = $this->getImputacionesRuntime();
        
        $r = array();
        
        foreach ($cuotasDisponibes as $cuota){
            $imputacion = $this->cuotaImputadaRuntime($cuota, $imputacionesRuntime);
            if ($imputacion){
                $this->asignarValorCuota($imputacion->valor, $cuota);
                $r[] = $cuota;
            }
        }
        return $r;      
    }    
    
    public function isManualImputation(){
        return TRUE;
    }
    
    public function calcularCuotasPosibles($suscripcion_id){
        $cuotasDisponibes = $this->obtenerCuotasDisponibles($suscripcion_id);
        $imputacionesRuntime = $this->getImputacionesRuntime();
        
        $r = array();
        
        foreach ($cuotasDisponibes as $i => $cuota){
            $imputacion = $this->cuotaImputadaRuntime($cuota, $imputacionesRuntime);
            if ($imputacion){
                $this->asignarValorCuota($imputacion->valor, $cuota);
                if($cuota->saldo != 0)
                    $r[] = $cuota;
            }
            else
                $r[] = $cuota;
        }
        return $r;      
    }
    
    public function borraImputation($cuota_id) {
        $imputacionesRuntime = $this->getImputacionesRuntime();

        foreach ($imputacionesRuntime as $imputacion ){
            if ($imputacion->cuota_id == $cuota_id){
                $id = $imputacion->id;
                $imputacion->delete();
                $encontrado = array_search($id,  $this->array_imputaciones_ids);
                if(!is_null($encontrado)&&($encontrado != FALSE)) {
                    unset($this->array_imputaciones_ids[$encontrado]);
                }
                return TRUE;
            }
        }
        return FALSE;
    }
    
    public function getTotalImputation() {
        $imputacionesRuntime = $this->getImputacionesRuntime();
        $r = 0;
        foreach ($imputacionesRuntime as $imputacion ){
            $r += $imputacion->valor;
        }
        return $r;
    }   
    
}


class PagoCalculoCuota extends CFormModel 
{
    
    const TIPO_DEFAULT = 0;
    
    public $idTipo = self::TIPO_DEFAULT;
    
    
    public function rules() {
        return array(
            array('idTipo','required'),
            
        );
    }
    
    public function attributeLabels()
    {
        return array(
            'idTipo' => 'Tipo Cálculo Imputación',
        );
    }
    
    public static function getValues() {
        return array(
            array(
                'id' => 0,
                'Descripcion' => 'Asignar Cuota Vigente y a partir de la ultima - Saldo Ultima Cuota',
                'class' => 'VigenteUtimasCalculoCuota',
            ),
            array(
                'id' => 1,
                'Descripcion' => 'Asignar Cuota Vigente y a partir de la ultima - Saldo Siguiente Cuota',
                'class' => 'SaldoSiguienteCalculoCuota',
            ),
            array(
                'id' => 2,
                'Descripcion' => 'Asignar Cuota Vigente y siguientes',
                'class' => 'VigenteSiguientesCalculoCuota',
            ),
            array(
                'id' => 3,
                'Descripcion' => 'Imputar Manualmente',
                'class' => 'ImputarCuotaManualmente',
            ),
        );
    }
    
    public static function getTipoCalculo($idTipoSelect = self::TIPO_DEFAULT) {
        $tipo = self::getValues();
        foreach ($tipo as $tipo) {
            if($tipo['id'] == $idTipoSelect) {
                if(class_exists($tipo['class']))
                    return new $tipo['class']; 
                break;
            }
        }
        throw new Exception('Clase de CalculoCuota no encontrado');
    }
    
}