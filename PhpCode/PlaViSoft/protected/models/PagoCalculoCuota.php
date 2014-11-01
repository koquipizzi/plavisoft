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
    
    private function asignarValorCuota($valor, &$cuota){
        $resto = 0;
        if ( ($valor - $cuota->saldo) > 0 ) {
            $resto = $valor - $cuota->saldo;
            $cuota->valorAsignado = $cuota->saldo;
        }
        else {
            $cuota->valorAsignado = $resto;
        }
        return $resto;
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
                $cuotaResto->valorAsignado = $resto;
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


class PagoCalculoCuota extends CFormModel 
{
    
    const TIPO_DEFAUT = 0;
    
    public $idTipo = self::TIPO_DEFAUT;
    
    
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
        );
    }
    
    public static function getTipoCalculo($idTipoSelect = self::TIPO_DEFAUT) {
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