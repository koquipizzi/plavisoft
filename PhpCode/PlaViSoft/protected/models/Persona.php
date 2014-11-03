<?php

/**
 * This is the model class for table "persona".
 *
 * The followings are the available columns in table 'persona':
 * @property integer $id
 * @property string $Apellido
 * @property string $Nombre
 * @property string $Domicilio
 * @property string $DNI
 * @property string $Mail
 * @property string $Telefono
 * @property string $TelefonoCelular
 * @property integer $IngresosMensuales
 * @property integer $CantHijos
 * @property string $FechaAlta
 * @property integer $Borrado
 * @property string $Nota
 * @property integer $IdSocio
 * @property integer $tipo_persona_id
 * @property string $Apellido2
 * @property string $Nombre2
 * @property string $CUIT1
 * @property string $CUIT2
 * @property string $DNI2
 */
class Persona extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'persona';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Telefono, TelefonoCelular, tipo_persona_id', 'required'),
			array('Borrado, IngresosMensuales, CantHijos, IdSocio, tipo_persona_id', 'numerical', 'integerOnly'=>true),
			array('Apellido, Domicilio, Apellido2', 'length', 'max'=>100),
			array('Nombre, Mail, Nombre2, CUIT2', 'length', 'max'=>45),
			array('DNI, DNI2', 'length', 'max'=>10),
			array('Telefono, TelefonoCelular', 'length', 'max'=>50),
			array('Nota', 'length', 'max'=>255),
			array('CUIT1', 'length', 'max'=>15),
			array('FechaAlta','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, Apellido, Nombre, Domicilio, DNI, Mail, Telefono, TelefonoCelular, IngresosMensuales, CantHijos, FechaAlta, Borrado, Nota, IdSocio, tipo_persona_id, Apellido2, Nombre2, CUIT1, CUIT2, DNI2', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tipoPersona' => array(self::BELONGS_TO, 'TipoPersona', 'tipo_persona_id'),
			'suscripcions' => array(self::HAS_MANY, 'Suscripcion', 'persona_id'),
                        'pagos' => array(self::HAS_MANY, 'Pago', 'persona_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'Apellido' => 'Apellido',
			'Nombre' => 'Nombre',
			'Domicilio' => 'Domicilio',
			'DNI' => 'Dni',
			'Mail' => 'Mail',
			'Telefono' => 'Teléfono',
			'TelefonoCelular' => 'Teléfono Celular',
			'IngresosMensuales' => 'Ingresos Mensuales',
			'CantHijos' => 'Cant Hijos',
			'FechaAlta' => 'Fecha Alta',
			'Borrado' => 'Borrado',
			'Nota' => 'Nota',
			'IdSocio' => 'Id Socio',
			'tipo_persona_id' => 'Tipo Persona',
			'Apellido2' => 'Apellido Cotitular',
			'Nombre2' => 'Nombre Cotitular',
			'CUIT1' => 'CUIT',
			'CUIT2' => 'CUIT Cotitular',
			'DNI2' => 'Dni Cotitular',
                        'tipoPersonaStr' => 'Tipo de Persona',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('Apellido',$this->Apellido,true);
		$criteria->compare('Nombre',$this->Nombre,true);
		$criteria->compare('Domicilio',$this->Domicilio,true);
		$criteria->compare('DNI',$this->DNI,true);
		$criteria->compare('Mail',$this->Mail,true);
		$criteria->compare('Telefono',$this->Telefono,true);
		$criteria->compare('TelefonoCelular',$this->TelefonoCelular,true);
		$criteria->compare('IngresosMensuales',$this->IngresosMensuales);
		$criteria->compare('CantHijos',$this->CantHijos);
		$criteria->compare('FechaAlta',$this->FechaAlta,true);
		$criteria->compare('Borrado',$this->Borrado);
		$criteria->compare('Nota',$this->Nota,true);
		$criteria->compare('IdSocio',$this->IdSocio);
		$criteria->compare('tipo_persona_id',$this->tipo_persona_id);
		$criteria->compare('Apellido2',$this->Apellido2,true);
		$criteria->compare('Nombre2',$this->Nombre2,true);
		$criteria->compare('CUIT1',$this->CUIT1,true);
		$criteria->compare('CUIT2',$this->CUIT2,true);
		$criteria->compare('DNI2',$this->DNI2,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Persona the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getNombreDNI()
	{
            return $this->Apellido.", ".$this->Nombre.($this->DNI!=NULL?" (DNI: ".$this->DNI.")":"");
}
	
	public function getValoresNulos($valor)
	{
	    switch($valor)
	    {
	        case NULL:
	            return 'No establecidos';
	            break;
	        default:
	            return ($valor);
	            break;
	    }
	}
        
        public function getNombreCompleto(){
            $nombre = (!isset($this->Nombre)||(trim($this->Nombre)=="")?"":", ".$this->Nombre);
            return $this->Apellido.$nombre;
        }

        public function getNombreCompletoDNI(){
            $nombre = $this->getNombreCompleto();
            $dni = (!isset($this->DNI)||(trim($this->DNI)=="")?"":" (".$this->DNI.")");
            return $nombre.$dni;
        }

        public function getNombreCompletoCotitular(){
            $nombre = (!isset($this->Nombre2)||(trim($this->Nombre2)=="")?"":", ".$this->Nombre2);
            return $this->Apellido2.$nombre;
        }

        public function getNombreCompletoCotitularDNI(){
            $nombre = $this->getNombreCompletoCotitular();
            $dni = (!isset($this->DNI2)||(trim($this->DNI2)=="")?"":" (".$this->DNI2.")");
            return $nombre.$dni;
        }

        public function getSuscripcionesCantidad(){
            return count($this->suscripcions);
        }
        
        public function getExistePagos() {
            $r = FALSE;
            $result = $this->pagos;

            if(is_array($result)&&(count($result)>0))
                $r = TRUE;

            return $r;
        }
        
        public function getTipoPersonaStr() {
            return $this->tipoPersona->Descripcion;
        }
        
	
}
