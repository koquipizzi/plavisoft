<?php

class CuotaController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','saldar','agregarCheque', 'borrarCheque'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Cuota;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cuota']))
		{
			$model->attributes=$_POST['Cuota'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['Cuota']))
		{
			$model->attributes=$_POST['Cuota'];
//                        var_dump($model);
//                        die();
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
		$dataProvider=new CActiveDataProvider('Cuota');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionSaldar()
	{
                $pago = new Pago;
                $imputacion = new Imputacion;
                
//print_r($_POST);
//die();

                if(isset($_POST['Pago'])){
                    
                    $transaction = Yii::app()->db->beginTransaction();
                    try{
                            $pago->attributes = $_POST['Pago'];
                            $pago->save();

                            $imputacion->attributes = $_POST['Imputacion'];
                            $imputacion->pago_id = $pago->id;
                            $imputacion->save();

                            $cuota = Cuota::model()->findByPk($imputacion->cuota_id);

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
                if (array_key_exists('id',$_GET)&& isset($_GET['id'])) { 
                    $cuota = Cuota::model()->findByPk($_GET['id']);
                    if (!isset($cuota)){
                        Yii::log('No se encuentra Cuota a Saldar','warning');
                        throw new CHttpException(null,'No se encuentra Cuota a Saldar');
                    }
                    $pago->FechaPago = date('d/m/Y');
                }else{
                    Yii::log('No se encuentra Clave de Cuota a Saldar','warning');
                    throw new CHttpException(null,'No se encuentra Clave de Cuota a Saldar');
                }
                
                $forma_pago_pago = new FormaPagoPago;

                $forma_pago_contado = new FormaPagoContado;
                $forma_pago_cheque = new FormaPagoCheque;
                $forma_pago_deposito = new FormaPagoDeposito;
                
                $cheque = new Cheque;
                
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
            
            $this->renderPartial(
                    'listaChequesEdicion',
                    array(
                        'cheques'=>$cheques,
                        'cheques_agregados'=>implode('_',$cheques_id),
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
            
            $this->renderPartial(
                    'listaChequesEdicion',
                    array(
                        'cheques'=>$cheques,
                        'cheques_agregados'=>implode('_',$cheques_id),
                    )
            );            
            Yii::app()->end();
        }        
        
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
            $suscripcion = null;
            
            if (array_key_exists('suscripcion_id',$_GET)&& isset($_GET['suscripcion_id'])) { 
                $suscripcion = Suscripcion::model()->findByPk($_GET['suscripcion_id']);
                if (!isset($suscripcion)){
                    Yii::log('No se encuentra Suscripción','warning');
                    throw new CHttpException(null,'No se encuentra Suscripción');
                }
                                              
            }
            else{
                Yii::log('Listado de cuotas sin suscripcion_id','warning');
                throw new CHttpException(null,'Listado de cuotas sin suscripcion_id');
            }
            
	    $records=Cuota::model()->getCuotaBySuscripcion($suscripcion->id);
	    $this->render('admin',array(
	        'records'=>$records,
                'suscripcion'=>$suscripcion,
	    )); 
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Cuota the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Cuota::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Cuota $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cuota-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
