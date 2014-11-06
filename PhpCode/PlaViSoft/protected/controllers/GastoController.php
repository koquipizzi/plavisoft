<?php

class GastoController extends Controller
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
				'actions'=>array('index','view','ajaxCategoriaChange', 'ajaxCategoriaDelete'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete'),
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
		$model=new Gasto;
                $gastoCategoria=new GastoCategorias;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Gasto']))
		{
			$model->attributes=$_POST['Gasto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
                
                $model->fecha = date('d/m/Y');
                

		$this->render('create',array(
			'model'=>$model,
                        'gastoCategoria'=>$gastoCategoria,
		));
	}
        
        public function actionAjaxCategoriaChange() {
            
            if(
                (!array_key_exists('id', $_REQUEST) ||  is_null($_REQUEST['id']))
                ||
                (!array_key_exists('categorias_ids', $_REQUEST) ||  is_null($_REQUEST['categorias_ids']))
            ) {
                throw new Exception('Error en Requerimiento Ajax AjaxCategoriaChange');
            }
            
            $id = $_REQUEST['id'];
            $categorias_ids = $_REQUEST['categorias_ids'];
            $cat_array = explode('#', $categorias_ids);
            $encontrado = array_search($id,$cat_array);
            
            if(!is_null($encontrado)&&($encontrado !== FALSE)) {
                echo json_encode(
                        array(
                            'html'=>'<div>La categoría ya esta agregada</div>',
                            'error'=>TRUE,
                            'categorias_ids'=>$categorias_ids,
                        )
                );
                Yii::app()->end();
            }
            // Agrego el ID
            $cat_array[] = $id;
            
            $criteria = new CDbCriteria;
            $criteria->addInCondition('id', $cat_array);
            $categorias = GastoCategorias::model()->findAll($criteria);

            $html = $this->renderPartial(
                    'ajaxCategoriaChange',
                    array(
                        'categorias'=>$categorias,
                        'borrarEnabled'=>TRUE,
                    ),
                    true
            );
            
            echo json_encode(
                    array(
                        'html'=>$html,
                        'error'=>FALSE,
                        'categorias_ids'=>implode('#',$cat_array),
                    )
            );
            Yii::app()->end();                        
        }

        public function actionAjaxCategoriaDelete() {
            
            if(
                (!array_key_exists('id', $_REQUEST) ||  is_null($_REQUEST['id']))
                ||
                (!array_key_exists('categorias_ids', $_REQUEST) ||  is_null($_REQUEST['categorias_ids']))
            ) {
                throw new Exception('Error en Requerimiento Ajax AjaxCategoriaDelete');
            }
            
            $id = $_REQUEST['id'];
            $categorias_ids = $_REQUEST['categorias_ids'];
            $cat_array = explode('#', $categorias_ids);
            $encontrado = array_search($id,$cat_array);
            
            if(is_null($encontrado)||($encontrado == FALSE)) {
                echo json_encode(
                        array(
                            'html'=>'<div>La categoría NO esta agregada</div>',
                            'error'=>TRUE,
                            'categorias_ids'=>$categorias_ids,
                        )
                );
                Yii::app()->end();
            }
            // Elimina el ID
            unset($cat_array[$encontrado]);
            
            $criteria = new CDbCriteria;
            $criteria->addInCondition('id', $cat_array);
            $categorias = GastoCategorias::model()->findAll($criteria);

            $html = $this->renderPartial(
                    'ajaxCategoriaChange',
                    array(
                        'categorias'=>$categorias,
                        'borrarEnabled'=>TRUE,
                    ),
                    true
            );
            
            echo json_encode(
                    array(
                        'html'=>$html,
                        'error'=>FALSE,
                        'categorias_ids'=>implode('#',$cat_array),
                    )
            );
            Yii::app()->end();                        
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

		if(isset($_POST['Gasto']))
		{
			$model->attributes=$_POST['Gasto'];
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
        //public function actionDelete()
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
		$dataProvider=new CActiveDataProvider('Gasto');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

       
	public function actionAdmin()
	{
	    $gastos=Gasto::model()->findAll();
	    $this->render('admin',array(
	        'gastos'=>$gastos,
	    )); 
	}
        

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Gasto the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Gasto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Gasto $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='gasto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
