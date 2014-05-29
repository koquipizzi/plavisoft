<?php

/**
 * This is the model class for table "planpago".
 *
 * The followings are the available columns in table 'planpago':
 * @property integer $id
 * @property integer $financiacion_id
 * @property integer $nro_cuota
 * @property string $mes
 * @property integer $anio
 */
class Planpago extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'planpago';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('financiacion_id, nro_cuota, mes, anio', 'required'),
			array('financiacion_id, nro_cuota, anio', 'numerical', 'integerOnly'=>true),
			array('mes', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, financiacion_id, nro_cuota, mes, anio', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'financiacion_id' => 'Financiacion',
			'nro_cuota' => 'Nro Cuota',
			'mes' => 'Mes',
			'anio' => 'Año',
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
		$criteria->compare('financiacion_id',$this->financiacion_id);
		$criteria->compare('nro_cuota',$this->nro_cuota);
		$criteria->compare('mes',$this->mes,true);
		$criteria->compare('anio',$this->anio);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Planpago the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	function getDatosCuota(){
		return $this->nro_cuota." (".$this->mes." ".$this->anio.")";
	}
}
