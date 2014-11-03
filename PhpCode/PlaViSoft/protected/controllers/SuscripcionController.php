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
				'actions'=>array('index','view','numeroChange'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','print'),
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
	//	$this->render('view',array(
	//		'model'=>$this->loadModel($id),
	//	));
		
	    $records=Persona::model()->findAllBySql('Select p.Nombre as Nombre, p.Apellido as Apellido from persona p join suscripcion s where s.persona_id = p.id and s.id ='.$id);
	  //  var_dump($records); die();
	    $pagos = $this->sumaPagos($id);
		$total = $this->sumaTotales($id);
	    $this->render('view',array(
	        'records'=>$records, /*'model'=>$records,*/'model'=>$this->loadModel($id),
	        'pagos'=> $pagos, 'total'=> $total
	    )); 
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$suscripcion=new Suscripcion;
                $anio = array();
                
                $persona = null;
                if (array_key_exists('idpersona',$_GET) && isset($_GET['idpersona'])) { 
                    $persona = Persona::model()->findByPk($_GET['idpersona']);
                    if (isset($persona)) 
                        $suscripcion->persona_id = $persona->id;                            
                }
                
                // No se permite crear suscripciones sin haber creado personas
                if(!isset($persona)){
                    Yii::log('Se intenta crear una suscripcion sin Persona','warning');
                    throw new CHttpException(null,"Se intenta crear una suscripcion sin Persona");
                }
                
                
                // Validaciones de Suscripciones

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Suscripcion']))
		{
                    $suscripcion->attributes = $_POST['Suscripcion'];
                        $suscripcion->mes = $_POST['Suscripcion']['mes'];
                        $suscripcion->anio = $_POST['Suscripcion']['anio'];
                    $suscripcion->estado_adjudicacion_id = EstadoAdjudicacion::NO_ADJUDICADO; 
                    
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
                            
                            $mes = $suscripcion->mes;
                            $anio = $suscripcion->anio;
                            
                            for($i=1;$i<=$financiacion->cant_cuotas;$i++){
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
                                $cuota->saldada = Cuota::NO_SALDADA;

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
                    $financiacion = Financiacion::model()->getFinanciacionByPersona($suscripcion->persona_id);
                    if ((count($financiacion)==0)||!isset($financiacion)){
                        Yii::log("No existe financiación disponible para la persona",'warning');
                        throw new CHttpException(null,"No existe financiación disponible para la persona");
                    }
                    $suscripcion->FechaAlta = date('d/m/Y');
                    $suscripcion->estado_adjudicacion_id = EstadoAdjudicacion::NO_ADJUDICADO;
                    $suscripcion->mes = 1;
                    $suscripcion->anio = 2014;
                    $anio = array(
                                array('id' => 2013,'Anio' => 2013),
                                array('id' => 2014,'Anio' => 2014),
                                array('id' => 2015,'Anio' => 2015),
                                array('id' => 2016,'Anio' => 2016),
                                array('id' => 2017,'Anio' => 2017),
                            );
                }

		$this->render('create',array(
			'model'=>$suscripcion,
                        'persona'=>$persona,
                        'financiacion'=>$financiacion,
                        'anio'=>$anio,
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
		$pagos = Cuota:: model()->findAllByAttributes(array('suscripcion_id' => (int)$suscripcionId));
		$total = 0;
		for($i=0; $i < count($pagos); $i++){
			if ($pagos[$i]->saldada == "Si")
		    	{
		    		$total = $total + $pagos[$i]->valor;
				}
		}		
		return $total;
	}
	
	public function sumaTotales($suscripcionId)
	{
		$pagos = Cuota:: model()->findAllByAttributes(array('suscripcion_id' => (int)$suscripcionId));
		$total = 0;
		for($i=0; $i < count($pagos); $i++){
		    $total = $total + $pagos[$i]->valor;
		}		
		return $total;
	}
        
        public function actionNumeroChange(){

            $html = "";
            $esta = FALSE;
            
            if(array_key_exists('numero', $_POST)&&array_key_exists('financiacion', $_POST)){
                
                $nro = trim($_POST['numero']);
                $financiacion = trim($_POST['financiacion']);
                
                $esta = TRUE;
                if($nro!=''){
                    $criteria = new CDbCriteria;
                        $criteria->compare('numero', $nro);
                        $criteria->compare('financiacion_id', $financiacion);
                    $aux = Suscripcion::model()->findAll($criteria);
                    $esta = (isset($aux)&&is_array($aux)&&(count($aux)>0));
                }
            
                $html = $this->renderPartial(
                        'numeroChange',
                        array(
                            'esta'=>$esta,
                        ),
                        true
                );
            }
            
            echo json_encode(
                    array(
                        'html'=>$html,
                        'error'=>$esta,
                    )
            );
            Yii::app()->end();            
        }
        
	   		   	
	public function actionPrint($id) 
	{ 
error_reporting(E_ALL);
ini_set("display_errors", 1); 
ini_set('max_execution_time', 300);
            $suscripcion = $this->loadModel($id);
            $valor = $suscripcion->financiacion->tipoVivienda->valor;            
            $criteria = new CDbCriteria;
            $criteria->addSearchCondition('suscripcion_id', $id);
//            $criteria->limit = 100;
            $cuotasSaldo = CuotaSaldo::model()->findAll($criteria);
                   
		
	    $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(15, 5, 15, 5));
            
////$stylesheet = file_get_contents('css/print.css'); /// here call you external css file 
////$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/print.css');
	    $html2pdf->WriteHTML($this->renderPartial(
                'printReporte', 
                array(
                    'suscripcion'=>$suscripcion, 
                    'cuotasSaldo'=>$cuotasSaldo,
                    'valor'=>$valor,
                ), true)
            );
	    $html2pdf->Output($suscripcion->persona->Apellido."-".'-Formuario:'.$suscripcion->id.'.pdf');
            
            
//	    $mpdf = Yii::app()->ePdf->mpdf('utf-8','A4','','',15,15,35,25,9,9,'P');
//            $mpdf->useOnlyCoreFonts = true;
//	    $mpdf->WriteHTML($this->renderPartial(
//                'printReporte', 
//                array(
//                    'suscripcion'=>$suscripcion, 
//                    'cuotasSaldo'=>$cuotasSaldo,
//                    'valor'=>$valorInicial,
//                ), true)
//            );
//	    $mpdf->Output($suscripcion->persona->Apellido."-".'-Formuario:'.$suscripcion->id.'.pdf');
//            exit();
            
//	    $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'es');
//            $html2pdf->setDefaultFont('Arial');
//            
//            // Encabezado
//            $r = 
//                '<table width=700>
//                    <tr class="grey size">
//                        <th colspan=12></th>
//                    </tr>
//                    <thead>
//                            <tr>
//                                    <td width="70" height="20">Nro. Cuota</td>
//                                    <td width="200" height="20">Cuota</td>
//                                    <td width="80" height="20" align="right" >Importe</td>
//                                    <td width="150" height="20" style="padding-left:15px;" >Cancelado</td>
//                                    <td width="80" height="20" align="right" >Saldo</td>
//                            </tr>
//                    </thead>';
//            
//            foreach ($cuotasSaldo as $cuota) {
//                $r .=
//                    '<tbody>
//                            <tr>
//                                    <td width="70"  height="20">'.$cuota->nro_cuota.'</td>
//                                    <td width="200" height="20">'.$cuota->cuotaStr.'</td>
//                                    <td width="100" height="20" align="right" >'.$cuota->valorStr.'</td>
//                                    <td width="150" height="20" style="padding-left:15px;" >'.$cuota->estadoStr.'</td>
//                                    <td width="80" height="20" align="right" >$ '.Yii::app() -> format -> number($valor).'</td>
//                            </tr>
//                    </tbody>'
//                ;                
//                $valor = $valor - $cuota->totalSaldado;
//            }
//            
//            $r .= '
//                </table>
//                <page>
//                  <page_footer>
//                    [[page_cu]]/[[page_nb]]
//                  </page_footer>
//                </page>                
//            ';
//            
//            $html2pdf->WriteHTML($r);
//            
//	    $html2pdf->Output(
//                    $suscripcion->persona->Apellido."-".'-Formuario:'.$suscripcion->id.'.pdf',
//                    EYiiPdf::OUTPUT_TO_BROWSER
//            );
//            exit();
            
	}  
       
}
