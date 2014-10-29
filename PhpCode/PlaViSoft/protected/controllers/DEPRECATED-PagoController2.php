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
				'actions'=>array('admin','delete','print'),
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
		$model=new Pago;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		Yii::import('application.controllers.AdelantoController'); 
	//	$total = AdelantoController::sumaAdelantos($_POST['adelantos']);
				
		$suscripcion = Suscripcion::model()->findByPk($_GET['suscripcion']);
		$id_persona = $suscripcion['persona_id']; 	

		if(isset($_POST['Pago']))
		{
			$model->attributes=$_POST['Pago'];
			//var_dump($model); die();
			$condition = 'id = "'.$_POST['Pago']['planpago_id'].'"';			
			$planpago = Planpago::model()->findAll(array('condition' => $condition));
			
			$ea =$suscripcion['estado_adjudicacion_id']; 			
			$condition = 'Adjudicado = "'.$ea.'" and financiacion_id = "'.$model->financiacion_id.'"';			
			$tipoCuota = TipoCuota::model()->findAll(array('condition' => $condition));
			
			$model->Importe = $tipoCuota[0]['Importe']; 
						
			$model->ImporteLetras = $tipoCuota[0]['ImporteLetras']; 
			$model->Mes = $planpago[0]['mes']; 
			$model->Anio = $planpago[0]['anio']; 
			$model->NroCuota = $planpago[0]['nro_cuota']; 
			//var_dump($tipoCuota); die();
		//	$model[''] = 
				
			
			$importe = $tipoCuota[0]['Importe'];
			
			if($model->save()){
				AdelantoController::registrarAdelantos($_POST['adelantos'], $model->id, $importe);
				//$this->redirect(array('view','id'=>$model->id));
			    //	$this->redirect(array('print','id'=>$model->id));
			    $this->redirect(array('suscripcion/view','id'=>$model->suscripcion->id));
			}
		}

		$condition = 'persona_id = "'.$id_persona.'" and pago_id IS NULL';		
		$records = Adelanto::model()->findAll(array('condition' => $condition));
		//var_dump($records); die();


	    
	//    $records = Adelanto::model()->findByAttributes(array('persona_id'=>$id_persona));
		
	//		var_dump($records); die();
		Yii::app()->user->setFlash('success', '<strong>Well done!</strong> You successfully read this important alert message.');
		$this->render('create',array(
			'model'=>$model,'records'=>$records,
		));
	//	$this->redirect(array('print','id'=>$model->id));

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
		$dataProvider=new CActiveDataProvider('Pago');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 
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
	*/
	
	public function actionAdmin()
	{
	    $records=Pago::model()->findAll();
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
		$model=Pago::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='pago-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
		
	public function actionPrint($id) {
        $model = $this->loadModel($id);
        $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'es');
		$stylesheet = file_get_contents('css/print.css'); /// here call you external css file 
        $html2pdf->WriteHTML($this->renderPartial('print', array('model'=>$model, 'persona'=>$model->suscripcion->persona), true));
        $html2pdf->Output($model->suscripcion->persona->Apellido."-".$model->suscripcion->persona->Nombre.'-Cuota'.$model->NroCuota.'.pdf');

}
}
