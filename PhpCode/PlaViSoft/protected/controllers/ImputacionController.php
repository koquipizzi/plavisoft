<?php

class ImputacionController extends Controller
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
				'actions'=>array('create','update','admin','delete','verImputacion'),
				'users'=>array('@'),
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
		$model=new Imputacion;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Imputacion']))
		{
			$model->attributes=$_POST['Imputacion'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->pago_id));
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

		if(isset($_POST['Imputacion']))
		{
			$model->attributes=$_POST['Imputacion'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->pago_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Borra la imputacion y actualiza la cuota
	 * @param integer $id Clave de Imputacion
	 */
	public function actionDelete($id)
	{
                // Imputacion a borrar
		$imputacion = $this->loadModel($id);

                // Suma otras imputaciones para evaluar si la Cuota queda saldada o no.
                $results = Yii::app()->db->createCommand()->
                    select('IFNULL(SUM(valor),0) as total')->
                    from('imputacion')->
                    where('cuota_id=:cuota_id and id<>:id',
                            array(
                                ':cuota_id'=>$imputacion->cuota_id,
                                ':id'=>$id                        
                            )
                    )->
                    queryAll();
                
                // Recupera cuota desde la imputacion
                $cuota = Cuota::model()->findByPk($imputacion->cuota_id);
		if($cuota===null){
                    throw new CHttpException(404,'La imputación se encuentra relacionada con una cuota no válida');
                }

                // Actualiza el Valor de la cuota
                if( $results[0]['total'] < $cuota->valor ){
                    $cuota->saldada = 'No';
                    $cuota->save();
                }
                
                // Borrado de la imputacion
                $imputacion->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Imputacion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Imputacion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Imputacion']))
			$model->attributes=$_GET['Imputacion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionVerImputacion()
	{       
                $susc_id = NULL;
                // Lista 1-N Imputaciones del pago
                if(array_key_exists('pago_id', $_GET) && !isset($_GET['pago_id'])){
                    throw new CHttpException(null,"Valor Pago Nulo");
                }
                elseif(array_key_exists('pago_id', $_GET) && isset($_GET['pago_id'])){
                    $criteria = new CDbCriteria;
                    $criteria->addSearchCondition('pago_id', $_GET['pago_id']);
                    $imputaciones = Imputacion::model()->findAll($criteria);            
                }
                // Lista 1-N Imputaciones de la cuota
                elseif(array_key_exists('cuota_id', $_GET) && !isset($_GET['cuota_id'])){
                    throw new CHttpException(null,"No se ha determinado Cuota");
                }
                elseif(array_key_exists('cuota_id', $_GET) && isset($_GET['cuota_id'])){
                    $cuota_id = $_GET['id'];

                    $criteria = new CDbCriteria;
                    $criteria->addSearchCondition('cuota_id', $cuota_id);
                    $imputaciones = Imputacion::model()->findAll($criteria);            

                    $modeloCuota=Cuota::model()->findByPk($cuota_id);
                    $susc_id= $modeloCuota->suscripcion->id;
                }

		$this->render('verImputacion',array(
			'imputaciones'=>$imputaciones, 'susc'=>$susc_id
		));
	}

        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Imputacion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Imputacion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Imputacion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='imputacion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	

}
