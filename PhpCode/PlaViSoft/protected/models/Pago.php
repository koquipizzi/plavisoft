<?php

/**
 * This is the model class for table "pago".
 *
 * The followings are the available columns in table 'pago':
 * @property integer $id
 * @property string $FechaPago
 * @property string $valor
 * @property string $ImporteLetras
 * @property string $Descripcion
 * @property string $NroDeposito
 * @property integer $persona_id
 * @property string $talonario
 * @property string $nro_formulario
 * @property string $FechaAlta
 * @property integer $Borrado
 *
 * The followings are the available model relations:
 * @property Cheque[] $cheques
 * @property FormaPago[] $formaPagos
 * @property Imputacion[] $imputacions
 * @property Persona $persona
 */
class Pago extends ActiveRecord
{
        public $imputar_saldo_cuota_siguiente = 1;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pago';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ImporteLetras, persona_id', 'required'),
			array('persona_id, Borrado', 'numerical', 'integerOnly'=>true),
			array('valor', 'length', 'max'=>15),
			array('ImporteLetras, Descripcion', 'length', 'max'=>255),
			array('NroDeposito', 'length', 'max'=>20),
			array('talonario', 'length', 'max'=>4),
			array('nro_formulario', 'length', 'max'=>8),
			array('FechaPago, FechaAlta', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, FechaPago, valor, ImporteLetras, Descripcion, NroDeposito, persona_id, talonario, nro_formulario, FechaAlta, Borrado', 'safe', 'on'=>'search'),
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
			'cheques' => array(self::HAS_MANY, 'Cheque', 'pago_id'),
			'formaPagos' => array(self::MANY_MANY, 'FormaPago', 'forma_pago_pago(pago_id, forma_pago_id)'),
			'imputacion' => array(self::HAS_MANY, 'Imputacion', 'pago_id'),
			'persona' => array(self::BELONGS_TO, 'Persona', 'persona_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'FechaPago' => 'Fecha Pago',
			'valor' => 'Valor',
			'ImporteLetras' => 'Importe Letras',
			'Descripcion' => 'Descripcion',
			'NroDeposito' => 'Nro Deposito',
			'persona_id' => 'Persona',
			'talonario' => 'Nro. Talonario',
			'nro_formulario' => 'Nro. Formulario',
                        'valorStr' => 'Valor',
                        'personaStr' => 'Persona',
			'FechaAlta' => 'Fecha Alta',
			'Borrado' => 'Borrado',
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
		$criteria->compare('FechaPago',$this->FechaPago,true);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('ImporteLetras',$this->ImporteLetras,true);
		$criteria->compare('Descripcion',$this->Descripcion,true);
		$criteria->compare('NroDeposito',$this->NroDeposito,true);
		$criteria->compare('persona_id',$this->persona_id);
		$criteria->compare('talonario',$this->talonario,true);
		$criteria->compare('nro_formulario',$this->nro_formulario,true);
		$criteria->compare('FechaAlta',$this->FechaAlta,true);
		$criteria->compare('Borrado',$this->Borrado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pago the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
	public function afterFind()
	{
                $this->FechaPago = Yii::app()->format->date($this->FechaPago);
		return parent::afterFind();
}
        
        public function getValorStr(){
                return "$ ".Yii::app() -> format -> number($this -> valor);
        }

	public function beforeSave()
	{
		$fecha=DateTime::createFromFormat('d/m/Y',$this->FechaPago);
		$this->FechaPago=$fecha->format('y-m-d');		 
                
		parent::beforeSave();
                
		return true;
	}
        
        public function getPersonaStr(){
            return $this->persona->Apellido.", ".$this->persona->Nombre;
        }
        
        
        public function getNroPagoStr(){
            return $this->talonario."-".$this->nro_formulario;
        }
        
        public function getCuotasNombreSuscripcion(){
            if(count($this->imputacion)>0) {
                return $this->imputacion[0]->cuota->suscripcion->nombreStr;
            }
            return "";
        }
  
        
}
