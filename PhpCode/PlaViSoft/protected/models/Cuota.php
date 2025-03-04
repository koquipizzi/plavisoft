<?php

/**
 * This is the model class for table "cuota".
 *
 * The followings are the available columns in table 'cuota':
 * @property string $id
 * @property integer $suscripcion_id
 * @property integer $nro_cuota
 * @property string $valor
 * @property string $valorLetras
 * @property integer $mes_id
 * @property integer $anio
 * @property string $saldada
 *
 * The followings are the available model relations:
 * @property Mes $mes
 * @property Suscripcion $suscripcion
 * @property Imputacion[] $imputacions
 */
class Cuota extends ActiveRecord
{
        
        const SALDADA = "Si";
        const NO_SALDADA = "No";
        const PARCIAL_SALDADA = "Pr";
        
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cuota';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('valor', 'required'),
			array('suscripcion_id, nro_cuota, mes_id, anio', 'numerical', 'integerOnly'=>true),
			array('valor', 'length', 'max'=>15),
			array('valorLetras', 'length', 'max'=>255),
			array('saldada', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, suscripcion_id, nro_cuota, valor, valorLetras, mes_id, anio, saldada', 'safe', 'on'=>'search'),
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
			'mes' => array(self::BELONGS_TO, 'Mes', 'mes_id'),
			'suscripcion' => array(self::BELONGS_TO, 'Suscripcion', 'suscripcion_id'),
			'imputacions' => array(self::HAS_MANY, 'Imputacion', 'cuota_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'suscripcion_id' => 'Suscripcion',
			'nro_cuota' => 'Nro Cuota',
			'valor' => 'Valor',
			'valorLetras' => 'Valor Letras',
			'mes_id' => 'Mes',
			'anio' => 'Anio',
			'saldada' => 'Saldada',
                        'personaStr' => 'Persona',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('suscripcion_id',$this->suscripcion_id);
		$criteria->compare('nro_cuota',$this->nro_cuota);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('valorLetras',$this->valorLetras,true);
		$criteria->compare('mes_id',$this->mes_id);
		$criteria->compare('anio',$this->anio);
		$criteria->compare('saldada',$this->saldada,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cuota the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getCuotaBySuscripcion($suscripcion_id){
            $sql = 
                'SELECT * 
                FROM cuota c
                WHERE 
                    c.suscripcion_id = :suscripcion_id';
            return Cuota::model()->findAllBySql($sql,array(':suscripcion_id'=>$suscripcion_id));
        }        
        
        
//	public function afterFind()
//	{
//		//$this->valor = Yii::app() -> format -> number($this -> valor);
//
//		return parent::afterFind();
//	}        
        
        public function beforeSave() {

                $conv  = Yii::app()->nombre2text;
                $this->valor = Yii::app()->format->unformatNumber($this->valor); 
                $this->valorLetras = $conv->toText($this->valor).' pesos';

                return parent::beforeSave();
        }        
        
        public function getValorStr(){
            return "$ ".$this -> valor;
        }
        
        public function getPersonaStr(){
            return $this->suscripcion->persona->Apellido.", ".$this->suscripcion->persona->Nombre;
        }
        

        public function getCuotaStr(){
            return $this->mes->mes." - ".$this->anio;
        }

        public function getValorImputado(){
            $imputaciones = $this->imputacions;
            $r = 0;
            foreach ($imputaciones as $key => $imputacion) {
                $r = $r + $imputacion->valor;
            }
            return $r;
        }

        public function getValorImputadoStr(){
            return '$ '.Yii::app() -> format -> number($this->getValorImputado());
        }
        
        public function getEstadoStr(){
            $r = "";
            
            if($this->saldada==self::SALDADA){
                $r .= 'Cancelada';
            }
            else if($this->saldada==self::PARCIAL_SALDADA){
                $r .= 'Cancelación Parcial';
            }            
            else {
                $r .= 'No Cancelada';
            }
            
            return $r;
        }
        
        
        
        
}