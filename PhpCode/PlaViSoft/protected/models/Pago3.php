<?php

/**
 * This is the model class for table "pago".
 *
 * The followings are the available columns in table 'pago':
 * @property integer $id
 * @property string $FechaPago
 * @property string $FormaPago
 * @property integer $suscripcion_id
 * @property integer $financiacion_id
 * @property integer $NroDeposito
 * @property integer $NroCuota
 * @property integer $forma_pago_id
 * @property integer $Importe
 * @property string $ImporteLetras
 * @property string $Descripcion
 * @property integer $Anio
 * @property integer $Mes
 * @property integer $planpago_id
 *
 * The followings are the available model relations:
 * @property Planpago $planpago
 * @property Financiacion $financiacion
 * @property Suscripcion $suscripcion
 */
class Pago3 extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pago';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('suscripcion_id, financiacion_id, NroCuota, forma_pago_id, ImporteLetras, planpago_id', 'required'),
			array('suscripcion_id, financiacion_id, NroDeposito, forma_pago_id, Importe, Anio, planpago_id', 'numerical', 'integerOnly'=>true),
			array('ImporteLetras', 'length', 'max'=>255),
			array('Descripcion', 'length', 'max'=>100),
			array('FechaPago', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, FechaPago, suscripcion_id, NroCuota, financiacion_id, NroDeposito, forma_pago_id, Importe, ImporteLetras, Descripcion, Anio, Mes, planpago_id', 'safe', 'on'=>'search'),
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
			'planpago' => array(self::BELONGS_TO, 'Planpago', 'planpago_id'),
			'financiacion' => array(self::BELONGS_TO, 'Financiacion', 'financiacion_id'),
			'formaPago' => array(self::BELONGS_TO, 'FormaPago', 'forma_pago_id'),
			'suscripcion' => array(self::BELONGS_TO, 'Suscripcion', 'suscripcion_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'FechaPago' => 'Fecha Pago',
			'suscripcion_id' => 'Suscripcion',
			'financiacion_id' => 'Financiacion',
			'NroDeposito' => 'Nro Deposito',
			'forma_pago_id' => 'Forma Pago',
			'Importe' => 'Importe',
			'ImporteLetras' => 'Importe Letras',
			'Descripcion' => 'Descripcion',
			'Anio' => 'Año',
			'Mes' => 'Mes',
			'planpago_id' => 'Planpago',
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
		$criteria->compare('FechaPago',$this->FechaPago,true);
		$criteria->compare('suscripcion_id',$this->suscripcion_id);
		$criteria->compare('financiacion_id',$this->financiacion_id);
		$criteria->compare('NroDeposito',$this->NroDeposito);
		$criteria->compare('forma_pago_id',$this->forma_pago_id);
		$criteria->compare('Importe',$this->Importe);
		$criteria->compare('ImporteLetras',$this->ImporteLetras,true);
		$criteria->compare('Descripcion',$this->Descripcion,true);
		$criteria->compare('Anio',$this->Anio);
		$criteria->compare('Mes',$this->Mes);
		$criteria->compare('planpago_id',$this->planpago_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pago the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	function getCuotas($f, $s){
		
		$sql='select id, CONCAT(Mes, " ", Anio) as mess from planpago where not exists 
		(select * from (SELECT planpago_id from pago where suscripcion_id ='.$s.' and financiacion_id ='.$f.') as ttt 
		where planpago.id = ttt.planpago_id) and financiacion_id ='.$f.' LIMIT 1';
	//	echo $sql; die();
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$results=$command->queryAll(); 
	//	var_dump($results); die();
		
	//	foreach($results AS $result){
		 //  echo $result['month'];
		//   echo $result['m'];
	//	}
					

	//	var_dump($dataProvider); die();
        $cuotas = $results;//Planpago::model()->findAll(array('condition' => $condition));
		
		return $cuotas;
	}
	
	 protected function afterFind ()
    {
            // convert to display format
        $this->FechaPago = strtotime ($this->FechaPago);
        $this->FechaPago = date ('d/m/Y', $this->FechaPago);

        parent::afterFind ();
    }

    protected function beforeValidate ()
    {
            // convert to storage format
        $this->FechaPago = strtotime ($this->FechaPago);
        $this->FechaPago = date ('d/m/Y', $this->FechaPago);

        return parent::beforeValidate ();
    }
	
	function getCuotaDesc(){
		return $this->Mes." ".$this->Anio;
	}
	
	public function getConcate()
	{
		return $this->Mes." ".$this->Anio;	
	} 
	
	public function adelantos()
	{
		return  $rawData=Yii::app()->db->createCommand('SELECT * FROM adelanto where persona_id ='.$this->suscripcion->persona->id.' and pago_id is null')->queryAll();
		

	
		var_dump($rawData); die();
	} 
	
		public function beforeSave()
	{
		//PHP dates are displayed as dd/mm/yyyy
		//MYSQL dates are stored as yyyy-mm-dd
		$fecha=DateTime::createFromFormat('d/m/Y',$this->FechaPago);
		//var_dump($this->fecha);
	//	var_dump($from->format('yyyy-mm-dd')); die();
		$this->FechaPago=$fecha->format('y-m-d');		 
		parent::beforeSave();
		return true;
	}

	/* public function afterFind()
	{
		//PHP dates are displayed as dd/mm/yyyy
		//MYSQL dates are stored as yyyy-mm-dd
		//$fecha=DateTime::createFromFormat('Y-m-d',$this->fecha);
		//$this->$fecha=date_format($fecha, 'Y-m-d');
				
		$this->FechaPago = strtotime ($this->FechaPago);
        $this->FechaPago = date ('d/m/Y', $this->FechaPago);
		
		parent::afterFind();
		return true;
	}*/
}
