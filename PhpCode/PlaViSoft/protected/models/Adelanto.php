<?php

/**
 * This is the model class for table "adelanto".
 *
 * The followings are the available columns in table 'adelanto':
 * @property integer $id
 * @property string $fecha
 * @property integer $persona_id
 * @property integer $forma_pago_id
 * @property integer $importe
 * @property integer $pago_id
 * @property integer $adelanto_id
 * @property integer $importe_imputado
 *
 * The followings are the available model relations:
 * @property Persona $persona
 * @property Pago $formaPago
 */
class Adelanto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'adelanto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, persona_id, forma_pago_id, importe', 'required'),
			array('persona_id, forma_pago_id, importe, pago_id, adelanto_id, importe_imputado', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha, persona_id, forma_pago_id, importe, pago_id, adelanto_id, importe_imputado', 'safe', 'on'=>'search'),
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
			'persona' => array(self::BELONGS_TO, 'Persona', 'persona_id'),
			'formaPago' => array(self::BELONGS_TO, 'FormaPago', 'forma_pago_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha' => 'Fecha',
			'persona_id' => 'Persona',
			'forma_pago_id' => 'Forma Pago',
			'importe' => 'Importe',
			'pago_id' => 'Pago',
			'adelanto_id' => 'Adelanto',
			'importe_imputado' => 'Importe Imputado',
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
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('persona_id',$this->persona_id);
		$criteria->compare('forma_pago_id',$this->forma_pago_id);
		$criteria->compare('importe',$this->importe);
		$criteria->compare('pago_id',$this->pago_id);
		$criteria->compare('adelanto_id',$this->adelanto_id);
		$criteria->compare('importe_imputado',$this->importe_imputado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Adelanto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave()
	{
		//PHP dates are displayed as dd/mm/yyyy
		//MYSQL dates are stored as yyyy-mm-dd
		$fecha=DateTime::createFromFormat('d/m/Y',$this->fecha);
		//var_dump($this->fecha);
	//	var_dump($from->format('yyyy-mm-dd')); die();
		$this->fecha=$fecha->format('y-m-d');		 
		parent::beforeSave();
		return true;
	}
	
	 public function afterFind()
	{
		//PHP dates are displayed as dd/mm/yyyy
		//MYSQL dates are stored as yyyy-mm-dd
		//$fecha=DateTime::createFromFormat('Y-m-d',$this->fecha);
		//$this->$fecha=date_format($fecha, 'Y-m-d');
				
		$this->fecha = strtotime ($this->fecha);
        $this->fecha = date ('d/m/Y', $this->fecha);
		
		parent::afterFind();
		return true;
	}
	
}
