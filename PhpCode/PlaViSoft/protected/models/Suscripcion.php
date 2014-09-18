<?php

/**
 * This is the model class for table "suscripcion".
 *
 * The followings are the available columns in table 'suscripcion':
 * @property integer $id
 * @property string $FechaAlta
 * @property integer $Activo
 * @property integer $persona_id
 * @property integer $Borrado
 * @property integer $financiacion_id
 * @property string $Nota
 * @property integer $estado_adjudicacion_id
 *
 * The followings are the available model relations:
 * @property Pago[] $pagos
 * @property Persona $persona
 * @property Financiacion $financiacion
 * @property EstadoAdjudicacion $estadoAdjudicacion
 */
class Suscripcion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'suscripcion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('persona_id, financiacion_id, estado_adjudicacion_id', 'required'),
			array('Activo, persona_id, Borrado, financiacion_id, estado_adjudicacion_id', 'numerical', 'integerOnly'=>true),
			array('Nota', 'length', 'max'=>255),
			array('FechaAlta', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, FechaAlta, Activo, persona_id, Borrado, financiacion_id, Nota, estado_adjudicacion_id', 'safe', 'on'=>'search'),
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
			//'pagos' => array(self::HAS_MANY, 'Pago', 'suscripcion_id'),
			'persona' => array(self::BELONGS_TO, 'Persona', 'persona_id'),
			'financiacion' => array(self::BELONGS_TO, 'Financiacion', 'financiacion_id'),
			'estadoAdjudicacion' => array(self::BELONGS_TO, 'EstadoAdjudicacion', 'estado_adjudicacion_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'FechaAlta' => 'Fecha Alta',
			'Activo' => 'Activo',
			'persona_id' => 'Persona',
			'Borrado' => 'Borrado',
			'financiacion_id' => 'Financiacion',
			'Nota' => 'Nota',
			'estado_adjudicacion_id' => 'Estado Adjudicacion',
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
		$criteria->compare('FechaAlta',$this->FechaAlta,true);
		$criteria->compare('Activo',$this->Activo);
		$criteria->compare('persona_id',$this->persona_id);
		$criteria->compare('Borrado',$this->Borrado);
		$criteria->compare('financiacion_id',$this->financiacion_id);
		$criteria->compare('Nota',$this->Nota,true);
		$criteria->compare('estado_adjudicacion_id',$this->estado_adjudicacion_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Suscripcion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	public function beforeSave()
	{
		//PHP dates are displayed as dd/mm/yyyy
		//MYSQL dates are stored as yyyy-mm-dd
                //var_dump($this->FechaAlta);die();
		$fecha=DateTime::createFromFormat('d/m/Y',$this->FechaAlta);
                if(!$fecha){
                    throw new CHttpException(null, "Error al convertir Fecha de Suscripcion");
                }
                    
                
//		var_dump($fecha);die();
//		var_dump($from->format('yyyy-mm-dd')); die();
		$this->FechaAlta=$fecha->format('Y-m-d');		 
		parent::beforeSave();
		return true;
	}

	public function afterFind()
	{
		//PHP dates are displayed as dd/mm/yyyy
		//MYSQL dates are stored as yyyy-mm-dd
		//$fecha=DateTime::createFromFormat('Y-m-d',$this->fecha);
		//$this->$fecha=date_format($fecha, 'Y-m-d');
				
		$this->FechaAlta = strtotime ($this->FechaAlta);
                $this->FechaAlta = date ('d/m/Y', $this->FechaAlta);
		
		
		parent::afterFind();
		return true;
	}
}
