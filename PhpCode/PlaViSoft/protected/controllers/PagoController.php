<?php

class PagoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','agregarCheque', 'borrarCheque', 'valorChange', 'nro_formularioChange', 'getComboItemsImputacionManual', 'imputacionManual', 'borrarImputacionManual'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','print'),
				'users'=>array('@'),
			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('saldar'),
//				'users'=>array('admin'),
//			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Muestra los pagos con su forma de pago e imputaciones. 
	 * @param integer $id Clave de Pago
	 */
	public function actionView($id)
        {
                $model = $this->loadModel($id);
                
                $formaPagoCheque = FormaPagoPago::model()->findByAttributes(array(
                                    'pago_id'=>$model->id,
                                    'forma_pago_id'=>FormaPagoCheque::getIDType(),
                                ));
                
                $cheques = NULL;
                if(isset($formaPagoCheque)){
                    $criteria = new CDbCriteria;
                    $criteria->compare('pago_id', $formaPagoCheque->pago_id);
                    $cheques = Cheque::model()->findAll($criteria);
                }
                
		$this->render('view',array(
			'model'=>$model,
                        'formaPagoContado' => FormaPagoPago::model()->findByAttributes(array(
                            'pago_id'=>$model->id,
                            'forma_pago_id'=>FormaPagoContado::getIDType(),
                        )),
                        'formaPagoCheque'  => $formaPagoCheque,
                        'cheques' => $cheques,
                        'formaPagoDeposito'=> FormaPagoPago::model()->findByAttributes(array(
                            'pago_id'=>$model->id,
                            'forma_pago_id'=>FormaPagoDeposito::getIDType(),
                        )),
		));
	}

        private function existeNro_Formulario($nro_talonario,$nro_formulario){
                $esta = FALSE;
                if($nro_formulario!=''){
                    $criteria = new CDbCriteria;
                        $criteria->compare('talonario', $nro_talonario);
                        $criteria->compare('nro_formulario', $nro_formulario);
                    $aux = Pago::model()->findAll($criteria);
                    $esta = (isset($aux)&&is_array($aux)&&(count($aux)>0));
                }            
                return $esta;
        }
        
        
        public function actionNro_formularioChange(){

            $html = "";
            if(array_key_exists('talonario', $_POST)&&array_key_exists('nro_formulario', $_POST)){
                
                $nro_talonario = trim($_POST['talonario']);
                $nro_formulario = trim($_POST['nro_formulario']);
                
                $esta = $this->existeNro_Formulario($nro_talonario, $nro_formulario);
            
                $html = $this->renderPartial(
                        'listarTalonario',
                        array(
                            'esta'=>$esta,
                            'nro_talonario'=>$nro_talonario." - ".$nro_formulario
                        ),
                        true
                );
            }
            
            echo json_encode(
                    array(
                        'html'=>$html,
                    )
            );
            Yii::app()->end();            
            
        }
        
        public function actionBorrarImputacionManual() {
            
            $msj = "";
            $html = "";
            $comboBox = "";
            $error = FALSE;
            
            if(
                    array_key_exists('valorPago', $_POST)&&
                    array_key_exists('suscripcion_id', $_POST)&&
                    array_key_exists('imputaciones_ids', $_POST)&&                    
                    array_key_exists('cuota_id', $_POST)
            ){
                $cuota_id = $_POST['cuota_id'];
                $imputaciones_ids = $_POST['imputaciones_ids'];
                $suscripcion_id = $_POST['suscripcion_id'];
                $valorPago = $_POST['valorPago'];

                $calculo = PagoCalculoCuota::getTipoCalculo(3);
                $calculo->setImputationsIDs($imputaciones_ids);
                $calculo->borraImputation($cuota_id);
                $totalImputado = $calculo->getTotalImputation();

                $imputaciones_ids = $calculo->getImputationsIDs();

                $html = $this->renderPartial(
                    'listarCuotasImputacionManual',
                    array(
                        'cuotas'=>$calculo->calcularCuotas($suscripcion_id, $valorPago),
                        'valor'=>'$ '.Yii::app() -> format -> number($valorPago),
                        'totalImputado'=>'$ '.Yii::app() -> format -> number($totalImputado),
                        'saldoAImputar'=>'$ '.Yii::app() -> format -> number($valorPago-$totalImputado),
                        'msj'=>$msj,
                    ),
                    true
                );            
                $comboBox = $this->renderPartial(
                    'comboItemsImputacionManual',
                    array(
                        'cuotas'=>$calculo->calcularCuotasPosibles($suscripcion_id),
                    ),
                    true
                );
            }
            else {
                $msj = "Error en los parámetros del requerimiento";
                $error = TRUE;
            }
            
            echo json_encode(
                    array(
                        'html'=>$html,
                        'error'=>$error,
                        'imputaciones_ids'=>$imputaciones_ids,
                        'comboBox'=>$comboBox,
                        'msj'=>$msj,
                    )
            );
            Yii::app()->end();                        
        }
        
        
        
        
        
        public function actionImputacionManual() {
            
            $msj = "";
            $html = "";
            $comboBox = "";
            $error = FALSE;
            
            if(
                    array_key_exists('valorPago', $_POST)&&
                    array_key_exists('suscripcion_id', $_POST)&&
                    array_key_exists('imputaciones_ids', $_POST)&&                    
                    array_key_exists('cuota_id', $_POST)&&
                    array_key_exists('valorImputacion', $_POST)
            ){
                $cuota_id = $_POST['cuota_id'];
                $valorImputacion = $_POST['valorImputacion'];
                $valorPago = $_POST['valorPago'];
                $imputaciones_ids = $_POST['imputaciones_ids'];
                $suscripcion_id = $_POST['suscripcion_id'];

                $criteria = new CDbCriteria;
                $criteria->compare('id', $cuota_id);
                $cuota = CuotaCalculada::model()->findAll($criteria);
                if(!isset($cuota)||empty($cuota)){
                    $msj = "La cuota no existe";
                    $error = TRUE;
                }
                else{
                    if($valorImputacion > $cuota[0]->saldo)
                        $valorImputacion = $cuota[0]->saldo;
                }

                $calculo = PagoCalculoCuota::getTipoCalculo(3);
                $calculo->setImputationsIDs($imputaciones_ids);

                $imputacion = $calculo->getImputacionPorCuota_id($cuota_id);
                if(!isset($imputacion)){
                    $imputacion = new ImputacionRuntime();
                    $imputacion->valor = 0;
                }
                $totalImputado = $calculo->getTotalImputado();

                if(($totalImputado + $valorImputacion)<=$valorPago){
                    $imputacion->valor = $imputacion->valor + $valorImputacion;
                    $totalImputado = $totalImputado + $valorImputacion;
                    $imputacion->cuota_id = $cuota_id;
                    
                    $imputacion->save();
                    $calculo->imputar($imputacion);

                    $imputaciones_ids = $calculo->getImputationsIDs();
                }
                else {
                    $msj = "El total del importe imputado es mayor al importe del Pago";
                    $error = TRUE;
                }
                $html = $this->renderPartial(
                    'listarCuotasImputacionManual',
                    array(
                        'cuotas'=>$calculo->calcularCuotas($suscripcion_id, $valorPago),
                        'valor'=>'$ '.Yii::app() -> format -> number($valorPago),
                        'totalImputado'=>'$ '.Yii::app() -> format -> number($totalImputado),
                        'saldoAImputar'=>'$ '.Yii::app() -> format -> number($valorPago-$totalImputado),
                        'msj'=>$msj,
                    ),
                    true
                );            
                $comboBox = $this->renderPartial(
                    'comboItemsImputacionManual',
                    array(
                        'cuotas'=>$calculo->calcularCuotasPosibles($suscripcion_id),
                    ),
                    true
                );
            }
            else {
                $msj = "Error en los parámetros del requerimiento";
                $error = TRUE;
            }
            
            echo json_encode(
                    array(
                        'html'=>$html,
                        'error'=>$error,
                        'imputaciones_ids'=>$imputaciones_ids,
                        'comboBox'=>$comboBox,
                        'msj'=>$msj,
                    )
            );
            Yii::app()->end();                        
        }
        
        public function actionGetComboItemsImputacionManual(){
            $suscripcion_id = 0;
            $imputaciones_ids="";
            
            if(
                    array_key_exists('suscripcion_id', $_POST)&&
                    array_key_exists('imputaciones_ids', $_POST)
            ){
                $suscripcion_id = $_POST['suscripcion_id'];
                $calculo = PagoCalculoCuota::getTipoCalculo(3);
                
                $imputaciones_ids = $_POST['imputaciones_ids'];
                $calculo->setImputationsIDs($imputaciones_ids);
            }//if parametros $_POST   
            
            $html = $this->renderPartial(
                'comboItemsImputacionManual',
                array(
                    'cuotas'=>$calculo->calcularCuotasPosibles($suscripcion_id),
                ),
                true
            );            
            
            echo json_encode(
                    array(
                        'html'=>$html,
                    )
            );
            Yii::app()->end();            

            
        }
        
        
        public function actionValorChange(){
            $valor = 0;
            $cuotas = NULL;
            $imputaciones_ids="";
            $vista = 'listarCuotas';
            $params = NULL;
            
            if(
                    array_key_exists('valor', $_POST)&&
                    array_key_exists('suscripcion_id', $_POST)&&
                    array_key_exists('idTipoCalculoCuota', $_POST)
            ){
                
                $valor = Yii::app()->format->unformatNumber($_POST['valor']);
                $suscripcion_id = $_POST['suscripcion_id'];
                $idTipoCalculoCuota = isset($_POST['idTipoCalculoCuota'])?$_POST['idTipoCalculoCuota']:PagoCalculoCuota::TIPO_DEFAULT;
                $calculo = PagoCalculoCuota::getTipoCalculo($idTipoCalculoCuota);
                
                if($calculo->isManualImputation() && array_key_exists('imputaciones_ids', $_POST)) {
                    // Manual Imputation
                    $imputaciones_ids = $_POST['imputaciones_ids'];
                    $calculo->setImputationsIDs($imputaciones_ids);
                    $vista = 'listarCuotasImputacionManual';
                    $totalImputado = $calculo->getTotalImputation();
                    $params = 
                        array(
                            'cuotas'=>$calculo->calcularCuotas($suscripcion_id, $valor),
                            'valor'=>'$ '.Yii::app() -> format -> number($valor),
                            'totalImputado'=>'$ '.Yii::app() -> format -> number($totalImputado),
                            'saldoAImputar'=>'$ '.Yii::app() -> format -> number($valor-$totalImputado),
                            'msj'=>'',
                        );
                    
                }

                
                
            }//if parametros $_POST   
            
            if(!isset($params)){
                $params = 
                    array(
                        'cuotas'=>$calculo->calcularCuotas($suscripcion_id, $valor),
                        'valor'=>'$ '.Yii::app() -> format -> number($valor),
                    );
            }
            
            $html = $this->renderPartial(
                $vista,
                $params,
                true
            );            
            
            echo json_encode(
                    array(
                        'html'=>$html,
                        'imputaciones_ids'=>$imputaciones_ids
                    )
            );
            Yii::app()->end();            

        }
        
        public function salvarPago($pago,$param){
            $pago->attributes = $param;
            if(trim($pago->nro_formulario)=='')
                throw new Exception("Nro. Formulario no puede ser vacio");

            $pago->valor = Yii::app()->format->unformatNumber($param['valor']);
            
            if( is_null($pago->ImporteLetras) || (trim($pago->ImporteLetras)=='')){
                $nombreText = Yii::app()->nombre2text;
                $pago->ImporteLetras = $nombreText->toText($pago->valor);
            }
            
            $pago->save();
        }

	/**
	 * La creaciono de todo Pago requiere el ID_SUSCRIPCION
	 */
	public function actionCreate()
	{
                    
		$pago=new Pago;
                $imputacion = new Imputacion;
                $forma_pago_pago = new FormaPagoPago;
                $forma_pago_contado = new FormaPagoContado;
                $forma_pago_cheque = new FormaPagoCheque;
                $forma_pago_deposito = new FormaPagoDeposito;
                $tipoCalculo = new PagoCalculoCuota;
                $cheque = new Cheque;
                $suscripcion = NULL;
                $persona = NULL;        
                $imputacion_runtime = new ImputacionRuntime();
                

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation();
                
		if(isset($_REQUEST['Pago']))
		{
                    $transaction = Yii::app()->db->beginTransaction();
                    $suscripcion_id = NULL;
                    try{
                            $this->salvarPago($pago, $_POST['Pago']);
                            if(array_key_exists('Imputacion', $_POST)) {
                                $imputacion->attributes = $_POST['Imputacion'];
                                $imputacion->pago_id = $pago->id;
                                $imputacion->valor = Yii::app()->format->unformatNumber($_POST['Imputacion']['valor']);
                                $imputacion->save();
                                $cuota = Cuota::model()->findByPk($imputacion->cuota_id);
                                $cuota->saldada = Cuota::SALDADA;
                                $cuota->save();
                                $suscripcion_id = $cuota->suscripcion_id;
                            }
                            else {
                                
                                $valor = Yii::app()->format->unformatNumber($pago->valor);
                                $suscripcion_id = $_POST['Suscripcion']['suscripcion_id'];
                                $idTipoCalculoCuota = $_REQUEST['PagoCalculoCuota']['idTipo'];
                                $calculo = PagoCalculoCuota::getTipoCalculo($idTipoCalculoCuota);   
                
                                if($calculo->isManualImputation() && array_key_exists('imputaciones_ids', $_REQUEST)) {
                                    $imputaciones_ids = $_REQUEST['imputaciones_ids'];
                                    $calculo->setImputationsIDs($imputaciones_ids);
                                }
                                $cuotas = $calculo->calcularCuotas($suscripcion_id, $valor);

                                foreach($cuotas as $i => $cuotaCalculada) {
                                    $cuota = Cuota::model()->findByPk($cuotaCalculada->id);
                                    $imputacion = new Imputacion;
                                        $imputacion->cuota_id = $cuota->id;
                                        $imputacion->pago_id = $pago->id;
                                        $imputacion->valor = $cuotaCalculada->valorAsignado;
                                    $imputacion->save();
                                    
                                    if ($cuotaCalculada->saldo == 0) {
                                        $cuota->saldada = Cuota::SALDADA;
                                    }
                                    elseif(($cuotaCalculada->saldo > 0)&&($cuotaCalculada->saldo < $cuotaCalculada->valor)){
                                        $cuota->saldada = Cuota::PARCIAL_SALDADA;
                                    }
                                    $cuota->save();
                                }
                                
                            }
                            
                            if(
                                    array_key_exists('forma_pago_id', $_POST['FormaPagoPago'])
                                    &&(is_array($_POST['FormaPagoPago']['forma_pago_id']))                                    
                                    &&(count($_POST['FormaPagoPago']['forma_pago_id'])>0)
                            ){
                                if(array_key_exists('forma_pago_id', $_POST['FormaPagoPago']) ){
                                    foreach ($_POST['FormaPagoPago']['forma_pago_id'] as $k => $FormaPagoID){
                                        
                                        // Contado
                                        if($FormaPagoID == FormaPagoContado::getIDType()){
                                            $forma_pago_contado->attributes = $_POST['FormaPagoContado'];
                                            $forma_pago_contado->pago_id = $pago->id;
                                            $forma_pago_contado->save();
                                        }
                                        // Cheque
                                        else if($FormaPagoID == FormaPagoCheque::getIDType()){
                                            $forma_pago_cheque->attributes = $_POST['FormaPagoCheque'];
                                            $forma_pago_cheque->pago_id = $pago->id;
                                            $forma_pago_cheque->save();

                                            $total = 0;
                                            if(trim($_POST['cheques_agregados'])!=''){
                                                $total = $this->copyChequeRuntime($_POST['cheques_agregados'], $pago->id);
                                            }

                                            if(trim($_POST['Cheque']['valor'])!=''){
                                                $cheque->attributes = $_POST['Cheque'];
                                                $cheque->pago_id = $pago->id;
                                                $cheque->save();
                                                $total = $total + $cheque->valor;
                                            }

                                            $forma_pago_cheque->valor = $total;   
                                            $forma_pago_cheque->save();
                                        }
                                        // Deposito
                                        else if($FormaPagoID == FormaPagoDeposito::getIDType()){
                                            $forma_pago_deposito->attributes = $_POST['FormaPagoDeposito'];
                                            $forma_pago_deposito->pago_id = $pago->id;
                                            $forma_pago_deposito->save();
                                        }
                                        
                                    }
                                }// if Forma de Pago
                            }
                            else{
                                $forma_pago_contado->pago_id = $pago->id;
                                $forma_pago_contado->valor = $pago->valor;
                                $forma_pago_contado->save();
                            }

                            $transaction->commit();
                            //$this->redirect(array('cuota/admin&suscripcion_id='.$suscripcion_id));
                            echo json_encode(array(
                                "error"=>FALSE,
                                "url" => Yii::app()->createAbsoluteUrl('cuota/admin&suscripcion_id='.$suscripcion_id)
                            ));
                            Yii::app()->end();
                    }
                    catch(CDbException $e){
                            $transaction->rollBack();
                            throw new CHttpException(null,$e->errorInfo[2]);
                    }
                    catch(Exception $e){
                            $transaction->rollBack();
                            throw new CHttpException(null,"catch transaction, ".$e->getMessage());
                    }                    
                }
                // Toma el ID de la cuota a ser saldada
                $cuota = NULL;
                $pago->FechaPago = date('d/m/Y');
                if (array_key_exists('cuota_id',$_REQUEST) && isset($_REQUEST['cuota_id'])) { 
                    $cuota = Cuota::model()->findByPk($_REQUEST['cuota_id']);
                    $cuotaSaldo = CuotaSaldo::model()->findByPk($_REQUEST['cuota_id']);
                    $cuota->valor = $cuotaSaldo->saldo;
                    if (!isset($cuota)){
                        Yii::log('No se encuentra Cuota a Saldar','warning');
                        throw new CHttpException(null,'No se encuentra Cuota a Saldar');
                    }
                    $persona = $cuota->suscripcion->persona;
                    $suscripcion = $cuota->suscripcion;
                }  
                else if(array_key_exists('suscripcion_id', $_REQUEST)&& isset($_REQUEST['suscripcion_id'])){
                    $suscripcion = Suscripcion::model()->findByPk($_REQUEST['suscripcion_id']);
                    if(!isset($suscripcion)||(is_array($suscripcion)&&(count($suscripcion)==0))){
                        Yii::log('No existen suscripciones','warning');
                        throw new CHttpException(null,'No existen suscripciones');
                    }
                    $persona = $suscripcion->persona;
                    if(!isset($persona)){
                        Yii::log('Intenta crear un pago con una persona que no existe','warning');
                        throw new CHttpException(null,'Intenta crear un pago con una persona que no existe');
                    }
                }
                $criteria = new CDbCriteria;
                    $criteria->order = 'FechaAlta desc';
                    $criteria->limit = 1;
                $ultimoPago = Pago::model()->findAll($criteria);
                if(count($ultimoPago) == 0){
                    $ultimoPago = NULL;
                }
                else{
                    $ultimoPago = $ultimoPago[0];
                }

                
		$this->render('create',array(
			'pago'=>$pago,
                        'persona'=>$persona,                    
                        'cuota'=>$cuota,
                        'imputacion'=>$imputacion,
                        'suscripcion'=>$suscripcion,
                        'forma_pago_pago'=>$forma_pago_pago,
                        'forma_pago_contado'=>$forma_pago_contado,
                        'forma_pago_cheque'=>$forma_pago_cheque,
                        'cheque'=>$cheque,
                        'forma_pago_deposito'=>$forma_pago_deposito,
                        'ultimoPago'=>$ultimoPago,
                        'tipoCalculo' => $tipoCalculo,
                        'imputacion_runtime'=>$imputacion_runtime,
		));                
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 *
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pago']))
		{
			$model->attributes=$_POST['Pago'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{   
error_reporting(E_ALL);
ini_set("display_errors", 1);

            $transaction = Yii::app()->db->beginTransaction();
            try{
                    $pago = $this->loadModel($id);
                    
                    $imputaciones = $pago->imputacion;
                    foreach($imputaciones as $imputacion){
                        $cuota = $imputacion->cuota;
                        if($cuota){
                            if(count($cuota->imputacions)>1)
                                $cuota->saldada = Cuota::PARCIAL_SALDADA;
                            else
                                $cuota->saldada = Cuota::NO_SALDADA;
                            if(!$cuota->save()){
                                throw new Exception('No se puede guardar Cuota');
                            }
                        }
                        $imputacion->delete();
                    }
                    $formaPagoPagos = $pago->formaPagoPago;
                    if($formaPagoPagos){
                        foreach ($formaPagoPagos as $formaPagoPago) {
                            $formaPagoPago->delete();
                        }
                    }
                    $pago->delete();

                    $transaction->commit();
            }
            catch(CDbException $e){
                    $transaction->rollBack();
                    throw new CHttpException(null,$e->errorInfo[2]);
            }
            catch(Exception $e){
                    $transaction->rollBack();
                    throw new CHttpException(null,"catch transaction, ".$e->getMessage());
            }               
            
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Pago');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
                $persona = NULL;
                $records = array();
                $suscripcion = NULL;
                $vista = 'admin';
                
                if(array_key_exists('persona_id', $_GET) && !isset($_GET['persona_id'])){
                    throw new CHttpException(null,"Persona no valida");
                }
                elseif(array_key_exists('persona_id', $_GET) && isset($_GET['persona_id'])){
                    $persona = $_GET['persona_id'];
                    $criteria = new CDbCriteria;
                    $criteria->compare('persona_id', $_GET['persona_id']);
                    $criteria->order = 'FechaPago desc';
                    $records=Pago::model()->findAll($criteria); 
                    $vista = 'adminPersona';
                }
                elseif(array_key_exists('suscripcion_id', $_GET) && !isset($_GET['suscripcion_id'])){
                    throw new CHttpException(null,"Suscripción no valida");
                }
                elseif(array_key_exists('suscripcion_id', $_GET) && isset($_GET['suscripcion_id'])){
                    $suscripcion = $_GET['suscripcion_id'];
                    $imputacionTable = Imputacion::model()->tableName();
                    $cuotaTable = Cuota::model()->tableName();
                            
                    $criteria = new CDbCriteria;
                        $criteria->join = " 
                            join ".$imputacionTable." i on i.pago_id = t.id 
                            join ".$cuotaTable." c on c.id = i.cuota_id 
                        ";
                        $criteria->compare('c.suscripcion_id', $_GET['suscripcion_id']);
                    
                    $records=Pago::model()->findAll($criteria);            
                }
                else {
                    $criteria = new CDbCriteria;
                    $criteria->order = 'FechaPago desc';
                    $records=Pago::model()->findAll($criteria); 
                    $vista = 'adminGeneral';
                }
                    
				
                
                $this->render($vista,array(
                    'records'=>$records,
                    'persona_id'=>$persona, 
                    'suscripcion_id'=>$suscripcion
                )); 
	 
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Pago the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pago::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Pago $model the model to be validated
	 */
	protected function performAjaxValidation($model=NULL)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='saldar-form')
		{
                        $error = false;
                        $mensaje = '';
                        try{
                            // Valida que todo el importe este imputado en cuotas
                            $valorPago = Yii::app()->format->unformatNumber($_REQUEST['Pago']['valor']);
                            $suscripcion_id = $_REQUEST['Suscripcion']['suscripcion_id'];

                            $idTipoCalculoCuota = $_REQUEST['PagoCalculoCuota']['idTipo'];
                            $calculo = PagoCalculoCuota::getTipoCalculo($idTipoCalculoCuota);   

                            if($calculo->isManualImputation() && array_key_exists('imputaciones_ids', $_REQUEST)) {
                                $imputaciones_ids = $_REQUEST['imputaciones_ids'];
                                $calculo->setImputationsIDs($imputaciones_ids);
                            }
                            $cuotas = $calculo->calcularCuotas($suscripcion_id, $valorPago);
                            $valorImputado = 0;
                            foreach($cuotas as $i => $cuotaCalculada) {
                                $valorImputado += $cuotaCalculada->valorAsignado;
                            }

                            if(($valorPago-$valorImputado)>0){
                                throw new Exception('Diferencia sin imputar $ '.Yii::app() -> format -> number($valorPago-$valorImputado));
                            }
                            
                            // Valida que el Nro de Formulario este completado
                            if(trim($_REQUEST['Pago']['nro_formulario']) == ''){
                                throw new Exception('El Numero de Formulario es Vacio');
                            }
                            else{
                                $nro_talonario = trim($_REQUEST['Pago']['talonario']);
                                $nro_formulario = trim($_REQUEST['Pago']['nro_formulario']);

                                if($this->existeNro_Formulario($nro_talonario, $nro_formulario)){
                                    throw new Exception('El Numero de Formulario esta ocupado');
                                }
                            }
                            
                        } catch (Exception $ex) {
                            $mensaje = $ex->getMessage();
                            $error = true;
                        }
                        
                        if($error){
                            echo json_encode(array(
                                "error"     =>  $error,
                                "mensaje"   =>  $mensaje
                            ));
                            Yii::app()->end();
                        }
		}
	}
        
        
        
        /**
         * Saldar Cuota Permite Acentar un Pago minimo para una cuota determinada
         * 
         */
        public function copyChequeRuntime($cheques_agregados, $pago_id){
            $total = 0;
            
            if(trim($_POST['cheques_agregados'])!=''){
                $cheques_id = explode('_', $_POST['cheques_agregados']);
                
                $criteria = new CDbCriteria;
                foreach ($cheques_id as $id){
                    $criteria->compare('id', $id, false, 'OR');
                }
                $cheques_runtime = ChequeRuntime::model()->findAll($criteria);            
                
                foreach ($cheques_runtime as $cheque_runtime){
                    $cheque = New Cheque;
                        $cheque->Cta_cte = $cheque_runtime->Cta_cte;
                        $cheque->NombreTitular = $cheque_runtime->NombreTitular;
                        $cheque->Nro_cheque = $cheque_runtime->Nro_cheque;
                        $cheque->banco_id = $cheque_runtime->banco_id;
                        $cheque->valor = $cheque_runtime->valor;
                        $cheque->pago_id = $pago_id;
                        $cheque->FechaVencimiento = $cheque_runtime->FechaVencimiento;
                    $cheque->save();    
                    $total = $total + $cheque->valor;
                }

            }

            
            return $total;
        }

        /**
	 * Accion que permite saldar una cuota. Saldar es acentar un pago por el total de la cuota. 
	 */
	public function actionSaldar()
	{
                $pago = new Pago;
                $imputacion = new Imputacion;
                $forma_pago_pago = new FormaPagoPago;
                $forma_pago_contado = new FormaPagoContado;
                $forma_pago_cheque = new FormaPagoCheque;
                $forma_pago_deposito = new FormaPagoDeposito;
                $cheque = new Cheque;
                
                
                if(isset($_POST['Pago'])){
                    
                    $transaction = Yii::app()->db->beginTransaction();
                    try{
                        
                            $this->salvarPago($pago, $_POST['Pago']);
                            
//                            $imputacion->attributes = $_POST['Imputacion'];
//                            $imputacion->pago_id = $pago->id;
//                            $imputacion->valor = Yii::app()->format->unformatNumber($_POST['Imputacion']['valor']);
//                            $imputacion->save();
                            
                            if(
                                    array_key_exists('forma_pago_id', $_POST['FormaPagoPago'])
                                    &&(is_array($_POST['FormaPagoPago']['forma_pago_id']))                                    
                                    &&(count($_POST['FormaPagoPago']['forma_pago_id'])>0)
                            ){
                                if(array_key_exists('forma_pago_id', $_POST['FormaPagoPago']) ){
                                    foreach ($_POST['FormaPagoPago']['forma_pago_id'] as $k => $FormaPagoID){
                                        
                                        // Contado
                                        if($FormaPagoID == FormaPagoContado::getIDType()){
                                            $forma_pago_contado->attributes = $_POST['FormaPagoContado'];
                                            $forma_pago_contado->pago_id = $pago->id;
                                            $forma_pago_contado->save();
                                        }
                                        // Cheque
                                        else if($FormaPagoID == FormaPagoCheque::getIDType()){
                                            $forma_pago_cheque->attributes = $_POST['FormaPagoCheque'];
                                            $forma_pago_cheque->pago_id = $pago->id;
                                            $forma_pago_cheque->save();

                                            $total = 0;
                                            if(trim($_POST['cheques_agregados'])!=''){
                                                $total = $this->copyChequeRuntime($_POST['cheques_agregados'], $pago->id);
                                            }

                                            if(trim($_POST['Cheque']['valor'])!=''){
                                                $cheque->attributes = $_POST['Cheque'];
                                                $cheque->pago_id = $pago->id;
                                                $cheque->save();
                                                $total = $total + $cheque->valor;
                                            }

                                            $forma_pago_cheque->valor = $total;   
                                            $forma_pago_cheque->save();
                                        }
                                        // Deposito
                                        else if($FormaPagoID == FormaPagoDeposito::getIDType()){
                                            $forma_pago_deposito->attributes = $_POST['FormaPagoDeposito'];
                                            $forma_pago_deposito->pago_id = $pago->id;
                                            $forma_pago_deposito->save();
                                        }
                                        
                                    }
                                }// if Forma de Pago
                            }
                            else{
                                $forma_pago_contado->pago_id = $pago->id;
                                $forma_pago_contado->valor = $pago->valor;
                                $forma_pago_contado->save();
                            }

                            $cuota = Cuota::model()->findByPk($imputacion->cuota_id);
                            $cuota->saldada = Cuota::SALDADA;
                            $cuota->save();

                            $transaction->commit();
                            $this->redirect(array('cuota/admin&suscripcion_id='.$cuota->suscripcion->id));
                    }
                    catch(CDbException $e){
                            $transaction->rollBack();
                            throw new CHttpException(null,$e->errorInfo[2]);
                    }
                    catch(Exception $e){
                            $transaction->rollBack();
                            throw new CHttpException(null,"catch transaction, ".$e->getMessage());
                    }                    
                    
                }
                
                // Toma el ID de la cuota a ser saldada
                if (array_key_exists('cuota_id',$_GET)&& isset($_GET['cuota_id'])) { 
                    $cuota = Cuota::model()->findByPk($_GET['cuota_id']);
                    if (!isset($cuota)){
                        Yii::log('No se encuentra Cuota a Saldar','warning');
                        throw new CHttpException(null,'No se encuentra Cuota a Saldar');
                    }
                    $pago->FechaPago = date('d/m/Y');
                }else{
                    Yii::log('No se encuentra Clave de Cuota a Saldar','warning');
                    throw new CHttpException(null,'No se encuentra Clave de Cuota a Saldar');
                }
                
                
                
		$this->render('saldar',array(
			'pago'=>$pago,
                        'cuota'=>$cuota,
                        'imputacion'=>$imputacion,
                        'forma_pago_pago'=>$forma_pago_pago,
                        'forma_pago_contado'=>$forma_pago_contado,
                        'forma_pago_cheque'=>$forma_pago_cheque,
                        'cheque'=>$cheque,
                        'forma_pago_deposito'=>$forma_pago_deposito,
		));
	}
        
        public function actionAgregarCheque(){
            $cheque = new ChequeRuntime();
            $cheque->Nro_cheque = $_POST['Nro_cheque'];
            $cheque->Cta_cte = $_POST['Cta_cte'];
            $cheque->valor = $_POST['valor'];
            $cheque->NombreTitular = $_POST['NombreTitular'];
            $cheque->banco_id = $_POST['banco_id'];
            $cheque->FechaVencimiento = $_POST['FechaVencimiento'];
            
            if($cheque->save()){
                if(trim($_POST['cheques_agregados'])!=''){
                    $cheques_id = explode('_', $_POST['cheques_agregados']);
                    $cheques_id[]=$cheque->id;
                }else{
                    $cheques_id=array($cheque->id);
                }
                
                $criteria = new CDbCriteria;
                foreach ($cheques_id as $id){
                    $criteria->addSearchCondition('id', $id, true, 'OR');
                }
                $cheques = ChequeRuntime::model()->findAll($criteria);
            }
            
            $cheques_agregados = implode('_',$cheques_id);
            $html = $this->renderPartial(
                    'listaChequesEdicion',
                    array(
                        'cheques'=>$cheques,
                        'cheques_agregados'=>$cheques_agregados,
                    ),
                    true
            );            
            
            echo json_encode(
                    array(
                        'html'=>$html,
                        'cheques_agregados'=>$cheques_agregados,
                    )
            );
            Yii::app()->end();
        }
        
        public function actionBorrarCheque(){
            $cheque = ChequeRuntime::model()->findByPk($_POST['id']);

            if($cheque->delete()){
                if(trim($_POST['cheques_agregados'])!=''){
                    $cheques_id = explode('_', $_POST['cheques_agregados']);
                    $criteria = new CDbCriteria;
                    foreach ($cheques_id as $id){
                        $criteria->addSearchCondition('id', $id, true, 'OR');
                    }
                    $cheques = ChequeRuntime::model()->findAll($criteria);
                }                
            }
            
            $cheques_agregados = implode('_',$cheques_id);
            $html = $this->renderPartial(
                    'listaChequesEdicion',
                    array(
                        'cheques'=>$cheques,
                        'cheques_agregados'=>$cheques_agregados,
                    ),
                    true
            );            
            
            echo json_encode(
                    array(
                        'html'=>$html,
                        'cheques_agregados'=>$cheques_agregados,
                    )
            );            
            Yii::app()->end();
        }        
        
       
	   		   	
	public function actionPrint($id) 
	{ 
		$model = $this->loadModel($id);
		
	    $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'es');
		//$stylesheet = file_get_contents('css/print.css'); /// here call you external css file 
	//	$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/print.css');
    
	    $html2pdf->WriteHTML($this->renderPartial('print', array('model'=>$model, 'persona'=>$model->persona), true));
	    $html2pdf->Output($model->persona->Apellido."-".'-Formuario:'.$model->nro_formulario.'.pdf');
	}  
}
