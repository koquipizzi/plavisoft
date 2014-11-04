<?php

/**
 * This is the model class for table "gasto".
 *
 * The followings are the available columns in table 'gasto':
 * @property integer $id
 * @property string $descripcion
 * @property string $valor
 * @property string $fecha
 * @property integer $borrado
 * @property string $fecha_borrado
 *
 * The followings are the available model relations:
 * @property GastoCategorias[] $gastoCategoriases
 */
class Gasto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gasto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('borrado', 'numerical', 'integerOnly'=>true),
			array('descripcion', 'length', 'max'=>150),
			array('valor', 'length', 'max'=>15),
			array('fecha, fecha_borrado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, descripcion, valor, fecha, borrado, fecha_borrado', 'safe', 'on'=>'search'),
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
			'gastoCategoriases' => array(self::MANY_MANY, 'GastoCategorias', 'gasto_categorias_gasto(gasto_id, gasto_categorias_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'descripcion' => 'Descripcion',
			'valor' => 'Valor',
			'fecha' => 'Fecha',
			'borrado' => 'Borrado',
			'fecha_borrado' => 'Fecha Borrado',
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
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('borrado',$this->borrado);
		$criteria->compare('fecha_borrado',$this->fecha_borrado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Gasto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
