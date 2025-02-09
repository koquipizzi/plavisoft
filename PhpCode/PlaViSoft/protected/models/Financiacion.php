<?php

/**
 * This is the model class for table "financiacion".
 *
 * The followings are the available columns in table 'financiacion':
 * @property integer $id
 * @property string $Descripcion
 * @property integer $tipo_vivienda_id
 * @property integer $Tipo_Financiacion
 * @property integer $cant_cuotas
 * @property integer $posicion
 * @property integer $tipo_persona_id
 *
 * The followings are the available model relations:
 * @property TipoPersona $tipoPersona
 * @property TipoVivienda $tipoVivienda
 * @property Suscripcion[] $suscripcions
 * @property TipoCuota[] $tipoCuotas
 */
class Financiacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'financiacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo_vivienda_id, Tipo_Financiacion', 'required'),
			array('tipo_vivienda_id, Tipo_Financiacion, cant_cuotas, posicion, tipo_persona_id', 'numerical', 'integerOnly'=>true),
			array('Descripcion', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, Descripcion, tipo_vivienda_id, Tipo_Financiacion, cant_cuotas, posicion, tipo_persona_id', 'safe', 'on'=>'search'),
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
			'tipoPersona' => array(self::BELONGS_TO, 'TipoPersona', 'tipo_persona_id'),
			'tipoVivienda' => array(self::BELONGS_TO, 'TipoVivienda', 'tipo_vivienda_id'),
			'suscripcions' => array(self::HAS_MANY, 'Suscripcion', 'financiacion_id'),
			'tipoCuotas' => array(self::HAS_MANY, 'TipoCuota', 'financiacion_id'),
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
			'tipo_vivienda_id' => 'Tipo Vivienda',
			'Tipo_Financiacion' => 'Tipo Financiacion',
			'cant_cuotas' => 'Cant Cuotas',
			'posicion' => 'Posicion',
			'tipo_persona_id' => 'Tipo Persona',
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
		$criteria->compare('tipo_vivienda_id',$this->tipo_vivienda_id);
		$criteria->compare('Tipo_Financiacion',$this->Tipo_Financiacion);
		$criteria->compare('cant_cuotas',$this->cant_cuotas);
		$criteria->compare('posicion',$this->posicion);
		$criteria->compare('tipo_persona_id',$this->tipo_persona_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Financiacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getFinanciacionByPersonaNoCargadas($persona_id){
            $sql = 
                'SELECT * 
                FROM financiacion f
                WHERE 
                NOT EXISTS(
                        Select 1 from suscripcion
                        where persona_id = :persona_id and financiacion_id = f.id
                )
                AND EXISTS(
                        Select 1 from persona p 
                        where p.id = :persona_id and f.tipo_persona_id = p.tipo_persona_id  
                )';
            return Financiacion::model()->findAllBySql($sql,array(':persona_id'=>$persona_id));
        }
        
        public function getFinanciacionByPersona($persona_id){
            $sql = 
                'SELECT * 
                FROM financiacion f
                WHERE 
                EXISTS(
                        Select 1 from persona p 
                        where p.id = :persona_id and f.tipo_persona_id = p.tipo_persona_id  
                )';
            return Financiacion::model()->findAllBySql($sql,array(':persona_id'=>$persona_id));
        }
        
        
        public function getCantAsociados(){
            $sql = 
                'SELECT count(*) as cantidad
                FROM suscripcion s
                Join persona p on s.persona_id = p.id
                WHERE 
                    s.financiacion_id = :financiacion_id
                    and p.tipo_persona_id = :tipo_persona_id';

            $command = Yii::app()->db->createCommand($sql);
            $command->bindValue(':financiacion_id',$this->id);
            $command->bindValue(':tipo_persona_id',$this->tipo_persona_id);
            $result = $command->queryAll();
            
            if(is_array($result)&&  array_key_exists(0, $result)&&  array_key_exists('cantidad', $result[0]))
                return $result[0]['cantidad'];
            return 0;
        }
        
        
}
