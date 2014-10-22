<?php

/**
 * This is the model class for table "view_cuota_saldo".
 *
 * The followings are the available columns in table 'view_cuota_saldo':
 * @property string $id
 * @property integer $suscripcion_id
 * @property integer $nro_cuota
 * @property string $valor
 * @property string $valorLetras
 * @property integer $mes_id
 * @property string $mes
 * @property integer $anio
 * @property string $saldada
 * @property string $totalSaldado
 * @property string $saldo
 */
class CuotaSaldo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'view_cuota_saldo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('suscripcion_id, mes_id', 'required'),
			array('suscripcion_id, nro_cuota, mes_id, anio', 'numerical', 'integerOnly'=>true),
			array('id, mes', 'length', 'max'=>20),
			array('valor', 'length', 'max'=>15),
			array('valorLetras', 'length', 'max'=>255),
			array('saldada', 'length', 'max'=>2),
			array('totalSaldado', 'length', 'max'=>37),
			array('saldo', 'length', 'max'=>38),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, suscripcion_id, nro_cuota, valor, valorLetras, mes_id, mes, anio, saldada, totalSaldado, saldo', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'suscripcion_id' => 'Suscripcion',
			'nro_cuota' => 'Nro Cuota',
			'valor' => 'Valor',
			'valorLetras' => 'Valor Letras',
			'mes_id' => 'Mes',
			'mes' => 'Mes',
			'anio' => 'Anio',
			'saldada' => 'Saldada',
			'totalSaldado' => 'Total Saldado',
			'saldo' => 'Saldo',
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
		$criteria->compare('mes',$this->mes,true);
		$criteria->compare('anio',$this->anio);
		$criteria->compare('saldada',$this->saldada,true);
		$criteria->compare('totalSaldado',$this->totalSaldado,true);
		$criteria->compare('saldo',$this->saldo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CuotaSaldo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getCanceladoStr(){
            return '$ '.Yii::app() -> format -> number($this->totalSaldado);
        }
        
        public function getSaldoStr(){
            return '$ '.Yii::app() -> format -> number($this->saldo);
        }

        public function getCuotaStr(){
            return $this->mes ." - ". $this->anio;
        }
        
        public function getValorStr(){
            return "$ ". Yii::app() -> format -> number($this -> valor);
        }
        
        public function getEstadoStr(){
            $r = "";
            
            if($this->saldada==Cuota::SALDADA){
                $r .= 'Cancelada';
            }
            else if($this->saldada==Cuota::PARCIAL_SALDADA){
                $r .= 'Cancelación Parcial';
            }            
            else {
                $r .= 'No Cancelada';
            }
            
            return $r;
        }
        
        
        
}
