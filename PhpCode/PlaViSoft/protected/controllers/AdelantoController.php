<?php

class AdelantoController extends Controller
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
				'actions'=>array('admin','delete'),
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
		$model=new Adelanto;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Adelanto']))
		{
			$model->attributes=$_POST['Adelanto'];
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

		if(isset($_POST['Adelanto']))
		{
			$model->attributes=$_POST['Adelanto'];
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Adelanto');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
	/*	$model=new Adelanto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Adelanto']))
			$model->attributes=$_GET['Adelanto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	 */
	  $records=Adelanto::model()->findAll();
	    $this->render('admin',array(
	        'records'=>$records,
	    )); 
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Adelanto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='adelanto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function sumaAdelantos($arreglo)
	{
		$model=Adelanto::model()->findByPk($id);
		echo("entra");
		if (isset($arreglo)) 
		{ 
		    print_r($arreglo); 
		} 
		//die();
		$total = 0;
		for($i=0; $i < count($arreglo); $i++){
			$model=Adelanto::model()->findByPk($arreglo[$i]);
			var_dump($model);
		    $total = $total + $model->importe;
		}
		return $total;
	}
	
	public function registrarAdelantos($arreglo, $pago, $importe)
	{
		$total = 0;
		for($i=0; $i < count($arreglo); $i++){
			$model=Adelanto::model()->findByPk($arreglo[$i]);
		//	var_dump($model);
		    $total = $total + $model->importe;
		}
		
		$aimputar = $importe;	
		$adelanto_id = Adelanto::model()->findByPk($arreglo[0])->adelanto_id;
		for($i=0; $i < count($arreglo); $i++){
			$model=Adelanto::model()->findByPk($arreglo[$i]);
			$total = $total -  $importe;
			//echo($total);
			$model->pago_id= $pago;
			$model->importe_imputado = $importe;
			$model->adelanto_id =$adelanto_id;
			$adelanto_id = $model->adelanto_id;	
			$model->save(); 
			
			/*else {
				$add = new Adelanto;
				$add->pago_id = $pago;
				$add->importe_imputado = -($aimputar);
				$add->persona_id = $model->persona_id;
				$add->forma_pago_id = 1;
				$add->adelanto_id = 0;		
				$model->save();		
			}*/	    
		}
		if ($total > 0)
		 {
				$add = new Adelanto;
				$add->pago_id = NULL;
				$add->importe = $total;
				$add->persona_id = $model->persona_id;
				$add->forma_pago_id = 1;
				$add->adelanto_id = $model->id;		
				$add->save(false);					
			}
		
	}


}
