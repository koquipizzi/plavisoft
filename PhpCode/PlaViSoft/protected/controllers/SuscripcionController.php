<?php

class SuscripcionController extends Controller
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
	//	$this->render('view',array(
	//		'model'=>$this->loadModel($id),
	//	));
		
	    $records=Pago::model()->findAllBySql('Select PERSON.Nombre as Nombre, PERSON.Apellido as Apellido, PAGO_SUS.* from persona as person join ((SELECT P.*,S.persona_id
												FROM pago AS p
												JOIN suscripcion AS s ON p.suscripcion_id = s.id
												WHERE p.suscripcion_id ='.$id.') as PAGO_SUS) on	 person.id = PAGO_SUS.persona_id ');
	    
	    $pagosTotales = $this->sumaPagos($id);
	    $this->render('view',array(
	        'records'=>$records, /*'model'=>$records,*/'model'=>$this->loadModel($id),
	        'pagosTotales'=> $pagosTotales 
	    )); 
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$suscripcion=new Suscripcion;
                
                
                // Validaciones de Suscripciones

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Suscripcion']))
		{
                    $suscripcion->attributes = $_POST['Suscripcion'];
                    $persona = Persona::model()->findByPk($suscripcion->persona_id);
                    $financiacion = Financiacion::model()->findByPk($suscripcion->financiacion_id);
                    $precio = 0;
                    if ($financiacion != NULL){
                        $tipo = TipoCuota::model()->find(
                                'financiacion_id=:financiacion_id AND tipo_cuota=:tipo_cuota',
                                array(
                                    ':financiacion_id' => $financiacion->id,
                                    ':tipo_cuota' => 'MENSUAL', 
                                ));
                        if($tipo != NULL){
                            $precio = $tipo->valor;
                        }
                        else{
                            Yii::log('No se encontro Tipo_Cuota MENSUAL para id='.$financiacion->id,'error');
                        }                                
                    }
                    else{
                        Yii::log('No se encontro Financiación para id='.$suscripcion->financiacion_id,'error');
                    }
                    
                    $transaction = Yii::app()->db->beginTransaction();
                    try{

                            if(!$suscripcion->save()){
                                throw new CHttpException(null, "Error al guardar Suscripción");
                            }
                            
                            $mes = 1;
                            $anio = 2014;
                            
                            for($i=0;$i<$financiacion->cant_cuotas;$i++){
                                $cuota = new Cuota();
                                $cuota->suscripcion_id = $suscripcion->id;
                                $cuota->nro_cuota = $i;
                                
                                // Importe
                                $cuota->valor = $precio;// aca depende del tipo financiacion elegido
                                $conv = Yii::app()->nombre2text;
                                $cuota->valorLetras = $conv->toText($cuota->valor).' pesos';

                                // Mes y Año
                                $cuota->mes_id = $mes;
                                $mes = $mes+1;
                                if($mes == 13){
                                    $mes = 1;
                                }                                    
                                $cuota->anio = $anio;
                                if($mes == 1){
                                    $anio++;
                                }
                                
                                // Saldada
                                $cuota->saldada = 'No';

                                if(!$cuota->save()){
                                    Yii::log($cuota->getErrors(),'error');
                                    throw new CHttpException(null, "Error al guardar cuota");
                                }

                            }

                            $transaction->commit();
                            $this->redirect(array('Persona/view','id'=>$persona->id));
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
                else{
                    $suscripcion->FechaAlta = date('d/m/Y');
                }

		$this->render('create',array(
			'model'=>$suscripcion,
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

		if(isset($_POST['Suscripcion']))
		{
			$model->attributes=$_POST['Suscripcion'];
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
		$dataProvider=new CActiveDataProvider('Suscripcion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
/*	public function actionAdmin()
	{
		$model=new Suscripcion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Suscripcion']))
			$model->attributes=$_GET['Suscripcion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
*/
	public function actionAdmin()
	{
	    $records=Suscripcion::model()->findAll();
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
		$model=Suscripcion::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='suscripcion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function sumaPagos($suscripcionId)
	{
		$pagos = Pago:: model()->findAllByAttributes(array('suscripcion_id' => (int)$suscripcionId));
		$total = 0;
		for($i=0; $i < count($pagos); $i++){
		//	$model=Adelanto::model()->findByPk($arreglo[$i]);
		//	var_dump($model);
			
		    $total = $total + $pagos[$i]->Importe;
		}		
		return $total;
	}
}
