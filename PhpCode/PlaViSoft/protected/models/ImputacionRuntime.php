<?php

/**
 * This is the model class for table "imputacion_runtime".
 *
 * The followings are the available columns in table 'imputacion_runtime':
 * @property integer $id
 * @property string $valor
 * @property string $cuota_id
 * @property string $ins_time
 *
 * The followings are the available model relations:
 * @property Cuota $cuota
 */
class ImputacionRuntime extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'imputacion_runtime';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('valor', 'length', 'max'=>15),
			array('cuota_id', 'length', 'max'=>20),
			array('ins_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, valor, cuota_id, ins_time', 'safe', 'on'=>'search'),
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
			'cuota' => array(self::BELONGS_TO, 'Cuota', 'cuota_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'valor' => 'Valor Imputación',
			'cuota_id' => 'Cuota',
			'ins_time' => 'Ins Time',
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
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('cuota_id',$this->cuota_id,true);
		$criteria->compare('ins_time',$this->ins_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ImputacionRuntime the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
