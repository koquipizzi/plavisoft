<?php

/**
 * This is the model class for table "cheque".
 *
 * The followings are the available columns in table 'cheque':
 * @property integer $id
 * @property string $Nro_cheque
 * @property string $Cta_cte
 * @property string $valor
 * @property integer $pago_id
 * @property string $NombreTitular
 * @property integer $banco_id
 * @property string $FechaVencimiento
 * @property string $dadoA
 * @property string $dadoFecha
 * @property string $descripcion
 *
 * The followings are the available model relations:
 * @property Banco $banco
 * @property Pago $pago
 */
class Cheque extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cheque';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pago_id, banco_id', 'required'),
			array('pago_id, banco_id', 'numerical', 'integerOnly'=>true),
			array('Nro_cheque, Cta_cte', 'length', 'max'=>45),
			array('valor', 'length', 'max'=>15),
			array('NombreTitular', 'length', 'max'=>100),
			array('dadoA, descripcion', 'length', 'max'=>255),
			array('FechaVencimiento, dadoFecha', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, Nro_cheque, Cta_cte, valor, pago_id, NombreTitular, banco_id, FechaVencimiento, dadoA, dadoFecha, descripcion', 'safe', 'on'=>'search'),
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
			'banco' => array(self::BELONGS_TO, 'Banco', 'banco_id'),
			'pago' => array(self::BELONGS_TO, 'Pago', 'pago_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'Nro_cheque' => 'Nro Cheque',
			'Cta_cte' => 'Cta Cte',
			'valor' => 'Valor',
			'pago_id' => 'Pago',
			'NombreTitular' => 'Nombre Titular',
			'banco_id' => 'Banco',
			'FechaVencimiento' => 'Fecha Vencimiento',
			'dadoA' => 'Dado A',
			'dadoFecha' => 'Dado Fecha',
			'descripcion' => 'Descripcion',
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
		$criteria->compare('Nro_cheque',$this->Nro_cheque,true);
		$criteria->compare('Cta_cte',$this->Cta_cte,true);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('pago_id',$this->pago_id);
		$criteria->compare('NombreTitular',$this->NombreTitular,true);
		$criteria->compare('banco_id',$this->banco_id);
		$criteria->compare('FechaVencimiento',$this->FechaVencimiento,true);
		$criteria->compare('dadoA',$this->dadoA,true);
		$criteria->compare('dadoFecha',$this->dadoFecha,true);
		$criteria->compare('descripcion',$this->descripcion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cheque the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	        
        public function getValorStr(){
            return "$ ".Yii::app()->format->number($this->valor);
        }
        
	public function afterFind()
	{
                if(!is_null($this->dadoFecha)){
                    $this->dadoFecha = Yii::app()->format->date($this->dadoFecha);
                }
		$this->FechaVencimiento = Yii::app()->format->date($this->FechaVencimiento);
		return parent::afterFind();
	}       
        
	public function beforeSave()
	{
                if (!is_null($this->FechaVencimiento)){
                    $fecha = DateTime::createFromFormat('d/m/Y',$this->FechaVencimiento);
                    $this->FechaVencimiento = $fecha?$fecha->format('y-m-d'):NULL;		 
                }

                if (!is_null($this->dadoFecha)){
                    $fechaDado = DateTime::createFromFormat('d/m/Y',$this->dadoFecha);
                    $this->dadoFecha = $fecha?$fechaDado->format('y-m-d'):NULL;
                }
		
		parent::beforeSave();
                
		return true;
	}
        
        
       
}
