<?php

/**
 * This is the model class for table "view_res_cuotas".
 *
 * The followings are the available columns in table 'view_res_cuotas':
 * @property integer $mes_id
 * @property integer $anio
 * @property string $saldada
 * @property string $cantidad_cuotas
 * @property string $total_valor
 * @property string $total_saldado
 * @property string $total_saldo
 */
class ResCuotas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'view_res_cuotas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mes_id', 'required'),
			array('mes_id, anio', 'numerical', 'integerOnly'=>true),
			array('saldada', 'length', 'max'=>2),
			array('cantidad_cuotas', 'length', 'max'=>21),
			array('total_valor', 'length', 'max'=>37),
			array('total_saldado', 'length', 'max'=>59),
			array('total_saldo', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('mes_id, anio, saldada, cantidad_cuotas, total_valor, total_saldado, total_saldo', 'safe', 'on'=>'search'),
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
			'mes_id' => 'Mes',
			'anio' => 'Anio',
			'saldada' => 'Saldada',
			'cantidad_cuotas' => 'Cantidad Cuotas',
			'total_valor' => 'Total Valor',
			'total_saldado' => 'Total Saldado',
			'total_saldo' => 'Total Saldo',
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

		$criteria->compare('mes_id',$this->mes_id);
		$criteria->compare('anio',$this->anio);
		$criteria->compare('saldada',$this->saldada,true);
		$criteria->compare('cantidad_cuotas',$this->cantidad_cuotas,true);
		$criteria->compare('total_valor',$this->total_valor,true);
		$criteria->compare('total_saldado',$this->total_saldado,true);
		$criteria->compare('total_saldo',$this->total_saldo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ResCuotas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
