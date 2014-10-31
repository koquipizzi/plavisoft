<?php

class VigenteUtimasCalculoCuota {
    
}

class SaldoSiguienteCalculoCuota extends VigenteUtimasCalculoCuota {
    
}

class VigenteSiguientesCalculoCuota {
    
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