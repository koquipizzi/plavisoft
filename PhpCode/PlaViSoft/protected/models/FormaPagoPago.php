<?php

/**
 * This is the model class for table "forma_pago_pago".
 *
 * The followings are the available columns in table 'forma_pago_pago':
 * @property integer $forma_pago_id
 * @property integer $pago_id
 * @property string $valor
 */
class FormaPagoPago extends CActiveRecord
{
    
        const ID_CONTADO = 1;
        const ID_CHEQUE = 2;
        const ID_DEPOSITO = 3;
        
        
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'forma_pago_pago';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('forma_pago_id, pago_id', 'required'),
			array('forma_pago_id, pago_id', 'numerical', 'integerOnly'=>true),
			array('valor', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('forma_pago_id, pago_id, valor', 'safe', 'on'=>'search'),
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
			'forma_pago_id' => 'Forma Pago',
			'pago_id' => 'Pago',
			'valor' => 'Valor',
                        'valorStr' => 'Valor',
                        'nroDepositoStr'=> 'Nro. Deposito',
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

		$criteria->compare('forma_pago_id',$this->forma_pago_id);
		$criteria->compare('pago_id',$this->pago_id);
		$criteria->compare('valor',$this->valor,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FormaPagoPago the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public function getValorStr(){
                return "$ ".Yii::app() -> format -> number($this -> valor);
        }
        
        
        public function getNroDepositoStr(){
            $pago = Pago::model()->findByPk($this->pago_id);
            if($pago)
                return $pago->NroDeposito;
            return "";
        }
        

        
}

abstract class FormaPagoEspecifico extends FormaPagoPago
{
    abstract public static function getIDType();
    
    public function __construct($scenario='insert') {
        parent::__construct($scenario);
        $this->forma_pago_id = $this->getIDType();
    }
    
    public function beforesave(){
        if(parent::beforeSave())
        {
             $this->forma_pago_id = $this->getIDType();
             return true;
        }
        return false;
    }
}

class FormaPagoContado extends FormaPagoEspecifico
{
    public static function getIDType(){
        return self::ID_CONTADO;
    }
}

class FormaPagoCheque extends FormaPagoEspecifico
{
    public static function getIDType(){
        return self::ID_CHEQUE;
    }
}

class FormaPagoDeposito extends FormaPagoEspecifico
{
    public static function getIDType(){
        return self::ID_DEPOSITO;
    }    
}
