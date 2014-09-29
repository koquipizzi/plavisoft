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
 *
 * The followings are the available model relations:
 * @property Cheque[] $cheques
 * @property FormaPago[] $formaPagos
 * @property Imputacion $imputacion
 * @property Persona $persona
 */
class Pago extends ActiveRecord
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
			array('ImporteLetras, persona_id', 'required'),
			array('persona_id', 'numerical', 'integerOnly'=>true),
			array('valor', 'length', 'max'=>15),
			array('ImporteLetras, Descripcion', 'length', 'max'=>255),
			array('NroDeposito', 'length', 'max'=>20),
			array('talonario', 'length', 'max'=>4),
			array('nro_formulario', 'length', 'max'=>8),
			array('FechaPago', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, FechaPago, valor, ImporteLetras, Descripcion, NroDeposito, persona_id, talonario, nro_formulario', 'safe', 'on'=>'search'),
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
			'imputacion' => array(self::HAS_ONE, 'Imputacion', 'pago_id'),
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
			'talonario' => 'Talonario',
			'nro_formulario' => 'Nro Formulario',
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
		$this->valor = Yii::app() -> format -> number($this -> valor);

		return parent::afterFind();
	}        

	public function getFechaPago()
	{
//		$fecha=DateTime::createFromFormat('y-m-d',$this->FechaPago);
//		return $fecha->format('d/m/Y');		 
            
                return Yii::app()->format->formatDate($this->fechaPago);
	}        
        
}
