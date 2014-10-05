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
				'actions'=>array('index','view','agregarCheque', 'borrarCheque', 'valorChange'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','saldar'),
				'users'=>array('admin'),
			),
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
                    $criteria->addSearchCondition('pago_id', $formaPagoCheque->pago_id);
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
        
        public function actionValorChange(){
            $valor = 0;
            $cuotas = NULL;
            
            if(array_key_exists('valor', $_POST)&&array_key_exists('suscripcion_id', $_POST)){
                $cuotas = array();
                
                $valor = Yii::app()->format->unformatNumber($_POST['valor']);
                $resto = 0;
                $suscripcion = Persona::model()->findByPk($_POST['suscripcion_id']);
                
                $criteria = new CDbCriteria;
                    $criteria->compare('persona_id', $suscripcion->persona_id);
                    $criteria->compare('saldada', 'No');
                    $criteria->order = 'nro_cuota';
                $aux = Cuota::model()->findAll($criteria);
                
                // Toma la primer cuota
                if (
                    isset($aux)&&
                    is_array($aux)&&
                    (count($aux)>0)    
                ){
                    $cuotas[] = $aux[0];
                    $c = $aux[0];
                    $resto = $valor - $c->valor;
                }

                // Toma el resto de las cuotas
                if($resto > 0){
                    $criteria->order = 'nro_cuota DESC';
                    $aux = Cuota::model()->findAll($criteria);
                    if (
                        isset($aux)&&
                        is_array($aux)&&
                        (count($aux)>0)    
                    ){
                        $cuotas[] = $aux[0];
                        $c = $aux[0];
                        $valor = $valor - $c->valor;
                    }
                }
                
                
            }
            
            $html = $this->renderPartial(
                    'listarCuotas',
                    array(
                        'cuotas'=>$cuotas,
                        'valor'=>$valor,
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
                $cheque = new Cheque;
                $suscripcion = NULL;
                $persona = NULL;                
                

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_REQUEST['Pago']))
		{
                    $pago->attributes=$_REQUEST['Pago'];
                    if($pago->save())
                        $this->redirect(array('view','id'=>$pago->id));
		}

                // Toma el ID de la cuota a ser saldada
                $cuota = NULL;
                if (array_key_exists('cuota_id',$_REQUEST)&& isset($_REQUEST['cuota_id'])) { 
                    $cuota = Cuota::model()->findByPk($_REQUEST['cuota_id']);
                    if (!isset($cuota)){
                        Yii::log('No se encuentra Cuota a Saldar','warning');
                        throw new CHttpException(null,'No se encuentra Cuota a Saldar');
                    }
                    $pago->FechaPago = date('d/m/Y');
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
		));                
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
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
		$this->loadModel($id)->delete();

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
		$model=new Pago('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pago']))
			$model->attributes=$_GET['Pago'];

		$this->render('admin',array(
			'model'=>$model,
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
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pago-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
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
                    $criteria->addSearchCondition('id', $id, true, 'OR');
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
                            $pago->attributes = $_POST['Pago'];
                            if(trim($pago->nro_formulario)=='')
                                throw new Exception("Nro. Formulario no puede ser vacio");
                            
                            $pago->valor = Yii::app()->format->unformatNumber($_POST['Pago']['valor']);
                            $pago->save();

                            $imputacion->attributes = $_POST['Imputacion'];
                            $imputacion->pago_id = $pago->id;
                            $imputacion->valor = Yii::app()->format->unformatNumber($_POST['Imputacion']['valor']);
                            $imputacion->save();
                            
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
        
        
        
}
