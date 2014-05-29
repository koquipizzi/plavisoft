<?php

/**
 * This is the model class for table "persona".
 *
 * The followings are the available columns in table 'persona':
 * @property integer $id
 * @property string $Apellido
 * @property string $Nombre
 * @property string $Domicilio
 * @property string $DNI
 * @property string $Mail
 * @property integer $IngresosMensules
 * @property integer $CantHijos
 * @property string $FechaAlta
 * @property string $Borrado
 * @property string $Nota
 * @property integer $IdSocio
 * @property integer $tipo_persona_id
 *
 * The followings are the available model relations:
 * @property TipoPersona $tipoPersona
 * @property Suscripcion[] $suscripcions
 */
class Persona extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'persona';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo_persona_id', 'required'),
			array('IngresosMensules, CantHijos, IdSocio, tipo_persona_id', 'numerical', 'integerOnly'=>true),
			array('Apellido, Domicilio', 'length', 'max'=>100),
			array('Nombre, Mail, Borrado', 'length', 'max'=>45),
			array('DNI', 'length', 'max'=>10),
			array('Nota', 'length', 'max'=>255),
			array('FechaAlta','default',
              'value'=>new CDbExpression('NOW()'),
              'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, Apellido, Nombre, Domicilio, DNI, Mail, IngresosMensules, CantHijos, FechaAlta, Borrado, Nota, IdSocio, tipo_persona_id', 'safe', 'on'=>'search'),
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
			'suscripcions' => array(self::HAS_MANY, 'Suscripcion', 'persona_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'Apellido' => 'Apellido',
			'Nombre' => 'Nombre',
			'Domicilio' => 'Domicilio',
			'DNI' => 'Dni',
			'Mail' => 'Mail',
			'IngresosMensules' => 'Ingresos Mensules',
			'CantHijos' => 'Cant Hijos',
			'FechaAlta' => 'Fecha Alta',
			'Borrado' => 'Borrado',
			'Nota' => 'Nota',
			'IdSocio' => 'Id Socio',
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
		$criteria->compare('Apellido',$this->Apellido,true);
		$criteria->compare('Nombre',$this->Nombre,true);
		$criteria->compare('Domicilio',$this->Domicilio,true);
		$criteria->compare('DNI',$this->DNI,true);
		$criteria->compare('Mail',$this->Mail,true);
		$criteria->compare('IngresosMensules',$this->IngresosMensules);
		$criteria->compare('CantHijos',$this->CantHijos);
		$criteria->compare('FechaAlta',$this->FechaAlta,true);
		$criteria->compare('Borrado',$this->Borrado,true);
		$criteria->compare('Nota',$this->Nota,true);
		$criteria->compare('IdSocio',$this->IdSocio);
		$criteria->compare('tipo_persona_id',$this->tipo_persona_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Persona the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getConcate()
	{
	return $this->Apellido.", ".$this->Nombre." (".$this->DNI.")";
	
	} 
	
	public function getValoresNulos($valor)
	{
	    switch($valor)
	    {
	        case NULL:
	            return 'No establecidos';
	            break;
	        default:
	            return ($valor);
	            break;
	    }
	}
	
	public function getTipoPersona($valor)
	{   
	    switch($valor)
	    {
	        case '1':
	            return 'SOCIO';
	            break;
			case '2':
	            return 'ADHERENTE';
	            break;			
	        default:
	            return ($valor);
	            break;
	    }
	}

}
