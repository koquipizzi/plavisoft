<?php

/**
 * This is the model class for table "pago".
 *
 * The followings are the available columns in table 'pago':
 * @property integer $id
 * @property string $FechaPago
 * @property string $FormaPago
 * @property integer $suscripcion_id
 * @property integer $financiacion_id
 * @property integer $NroDeposito
 * @property integer $forma_pago_id
 * @property integer $Importe
 * @property string $ImporteLetras
 * @property string $Descripcion
 * @property integer $Anio
 * @property integer $Mes
 * @property integer $planpago_id
 *
 * The followings are the available model relations:
 * @property Financiacion $financiacion
 * @property FormaPago $formaPago
 * @property Suscripcion $suscripcion
 */
class Pago extends CActiveRecord
{
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
			array('suscripcion_id, financiacion_id, forma_pago_id, ImporteLetras, planpago_id', 'required'),
			array('suscripcion_id, financiacion_id, NroDeposito, forma_pago_id, Importe, Anio, Mes, planpago_id', 'numerical', 'integerOnly'=>true),
			array('FormaPago', 'length', 'max'=>45),
			array('ImporteLetras', 'length', 'max'=>255),
			array('Descripcion', 'length', 'max'=>100),
			array('FechaPago', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, FechaPago, FormaPago, suscripcion_id, financiacion_id, NroDeposito, forma_pago_id, Importe, ImporteLetras, Descripcion, Anio, Mes, planpago_id', 'safe', 'on'=>'search'),
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
			'financiacion' => array(self::BELONGS_TO, 'Financiacion', 'financiacion_id'),
			'formaPago' => array(self::BELONGS_TO, 'FormaPago', 'forma_pago_id'),
			'suscripcion' => array(self::BELONGS_TO, 'Suscripcion', 'suscripcion_id'),
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
			'FormaPago' => 'Forma Pago',
			'NroCuota' => 'Nro Cuota',
			'suscripcion_id' => 'Suscripcion',
			'financiacion_id' => 'Financiacion',
			'NroDeposito' => 'Nro Deposito',
			'forma_pago_id' => 'Forma Pago',
			'Importe' => 'Importe',
			'ImporteLetras' => 'Importe Letras',
			'Descripcion' => 'Descripcion',
			'Anio' => 'Anio',
			'Mes' => 'Mes',
			'planpago_id' => 'Cuota',
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
		$criteria->compare('FormaPago',$this->FormaPago,true);
		$criteria->compare('suscripcion_id',$this->suscripcion_id);
		$criteria->compare('financiacion_id',$this->financiacion_id);
		$criteria->compare('NroDeposito',$this->NroDeposito);
		$criteria->compare('forma_pago_id',$this->forma_pago_id);
		$criteria->compare('Importe',$this->Importe);
		$criteria->compare('ImporteLetras',$this->ImporteLetras,true);
		$criteria->compare('Descripcion',$this->Descripcion,true);
		$criteria->compare('Anio',$this->Anio);
		$criteria->compare('Mes',$this->Mes);
		$criteria->compare('planpago_id',$this->planpago_id);

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
	
	function getCuotas($f, $s){
	
		$condition = 'financiacion_id = "'.$f.'"';
        $cuotas = Planpago::model()->findAll(array('condition' => $condition));
		
		return $cuotas;
	}
}
