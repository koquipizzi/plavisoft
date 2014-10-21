<?php

/**
 * This is the model class for table "imputacion".
 *
 * The followings are the available columns in table 'imputacion':
 * @property integer $id
 * @property integer $pago_id
 * @property string $valor
 * @property string $cuota_id
 *
 * The followings are the available model relations:
 * @property Pago $pago
 * @property Cuota $cuota
 */
class Imputacion extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'imputacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pago_id, cuota_id', 'required'),
			array('pago_id', 'numerical', 'integerOnly'=>true),
			array('valor', 'length', 'max'=>15),
			array('cuota_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pago_id, valor, cuota_id', 'safe', 'on'=>'search'),
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
			'pago' => array(self::BELONGS_TO, 'Pago', 'pago_id'),
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
			'pago_id' => 'Pago',
			'valor' => 'Valor',
			'cuota_id' => 'Cuota',
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
		$criteria->compare('pago_id',$this->pago_id);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('cuota_id',$this->cuota_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Imputacion the static model class
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
        
        public function getPago_field(){
            return 
                '<a href="index.php?r=pago/view&id='.$this->pago->id.'">'.
                $this->pago->talonario." - ".$this->pago->nro_formulario." (".$this->pago->FechaPago.") ".
                '</a>';
        }
        
        public function getCuota_field(){
            $r = $this->cuota->cuotaStr . " (" . $this->cuota->estadoStr . ")";
            
            return 
                '<a href="index.php?r=cuota/view&id='.$this->cuota->id.'">'.
                    $r .
                '</a>';
        }

        public function getValorStr(){
                return "$ ".$this -> valor;
        }
        
        
}
