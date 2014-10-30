<?php

/**
 * This is the model class for table "tipo_vivienda".
 *
 * The followings are the available columns in table 'tipo_vivienda':
 * @property integer $id
 * @property string $Descripcion
 * @property string $valor
 * @property string $Nombre
 * @property integer $MtrosCubiertos
 * @property integer $MtrosDescubiertos
 * @property integer $CantHabitaciones
 * @property integer $CantPisos
 * @property integer $SobreCalle
 * @property string $Fotos
 * @property integer $cantidad
 *
 * The followings are the available model relations:
 * @property Financiacion[] $financiacions
 */
class TipoVivienda extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tipo_vivienda';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MtrosCubiertos, MtrosDescubiertos, CantHabitaciones, CantPisos, SobreCalle, cantidad', 'numerical', 'integerOnly'=>true),
			array('Descripcion, Nombre, Fotos', 'length', 'max'=>45),
			array('valor', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, Descripcion, valor, Nombre, MtrosCubiertos, MtrosDescubiertos, CantHabitaciones, CantPisos, SobreCalle, Fotos, cantidad', 'safe', 'on'=>'search'),
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
			'financiacions' => array(self::HAS_MANY, 'Financiacion', 'tipo_vivienda_id'),
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
			'Nombre' => 'Nombre',
			'MtrosCubiertos' => 'Mtros Cubiertos',
			'MtrosDescubiertos' => 'Mtros Descubiertos',
			'CantHabitaciones' => 'Cant Habitaciones',
			'CantPisos' => 'Cant Pisos',
			'SobreCalle' => 'Sobre Calle',
			'Fotos' => 'Fotos',
			'cantidad' => 'Cantidad',
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
		$criteria->compare('Nombre',$this->Nombre,true);
		$criteria->compare('MtrosCubiertos',$this->MtrosCubiertos);
		$criteria->compare('MtrosDescubiertos',$this->MtrosDescubiertos);
		$criteria->compare('CantHabitaciones',$this->CantHabitaciones);
		$criteria->compare('CantPisos',$this->CantPisos);
		$criteria->compare('SobreCalle',$this->SobreCalle);
		$criteria->compare('Fotos',$this->Fotos,true);
		$criteria->compare('cantidad',$this->cantidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoVivienda the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getValorStr(){
                return "$ ".Yii::app() -> format -> number($this -> valor);
        }
        
}
