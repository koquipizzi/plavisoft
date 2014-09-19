<?php

/**
 * This is the model class for table "tipo_cuota".
 *
 * The followings are the available columns in table 'tipo_cuota':
 * @property integer $id
 * @property string $Descripcion
 * @property string $valor
 * @property string $ImporteLetras
 * @property integer $financiacion_id
 * @property string $tipo_cuota
 *
 * The followings are the available model relations:
 * @property Financiacion $financiacion
 */
class TipoCuota extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tipo_cuota';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('valor, ImporteLetras', 'required'),
			array('financiacion_id', 'numerical', 'integerOnly'=>true),
			array('Descripcion, tipo_cuota', 'length', 'max'=>45),
			array('valor', 'length', 'max'=>15),
			array('ImporteLetras', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, Descripcion, valor, ImporteLetras, financiacion_id, tipo_cuota', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'Descripcion' => 'Descripcion',
			'valor' => 'Valor',
			'ImporteLetras' => 'Importe Letras',
			'financiacion_id' => 'Financiacion',
			'tipo_cuota' => 'Tipo Cuota',
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
		$criteria->compare('Descripcion',$this->Descripcion,true);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('ImporteLetras',$this->ImporteLetras,true);
		$criteria->compare('financiacion_id',$this->financiacion_id);
		$criteria->compare('tipo_cuota',$this->tipo_cuota,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoCuota the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
