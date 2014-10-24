<?php
$this->breadcrumbs=array(
	'Cheques',
);

$this->menu=array(
	array('label'=>'Nuevo Cheque','url'=>array('create')),
	array('label'=>'Administrar Cheques','url'=>array('admin')),
);
?>

<h1>PlaViSoft - Plan de Vivienda de SICHOCA</h1>
<?php	

	//	var_dump($meses);die();
		
		$this->Widget('ext.highcharts.HighchartsWidget', array(
'scripts' => array(
      'highcharts-more',   // enables supplementary chart types (gauge, arearange, columnrange, etc.)
      'modules/exporting', // adds Exporting button/menu to chart
      'themes/grid-light'        // applies global 'grid' theme to all charts
    ),
    'options' => array(
      'title' => array('text' => 'Patient Visits By Day (Last Two Weeks)'),
      'xAxis' => array(
         'categories' => $meses
      ),
      'yAxis' => array(
         'title' => array('text' => 'Number of Visits')
      ),
      'colors'=>array('#0563FE', '#6AC36A', '#FFD148', '#FF2F2F'),
      'gradient' => array('enabled'=> true),
      'credits' => array('enabled' => false),
      /*'exporting' => array('enabled' => false),*/ //to turn off exporting uncomment
      'chart' => array(
        'plotBackgroundColor' => '#ffffff',
        'plotBorderWidth' => null,
        'plotShadow' => false,
        'height' => 400,
      ),
      'title' => false,
       'series' => array(
          array('type'=>'column','name' => 'Hampton Office', 'data' => array(20, 25, 25,35, 30, 28, 27, 23, 24, 25, 26,27)),
          array('type'=>'column','name' => 'Hampton Office', 'data' => array(20, 25, 25,35, 30, 28, 27, 23, 24, 25, 26,27)),
          array('type'=>'spline','name' => 'Richmond Office', 'data' => array(5, 7, 8,9, 7, 10,11, 12, 13,15, 17,15)),
          array(
            'type'=>'pie',
            'name' => 'Richmond Office',
            'data' => array(5, 7, 8),
            'dataLabels' => array(
              'enabled' => false,
            ),
            'showInLegend'=>false,
            'size'=>'10',
            'center'=>[20, 20],
          ),
      ),
    )
  ));
		
		
			$this->widget('ext.highcharts.HighchartsWidget', array(
		   'options' => array(
		   			    'title'=> array('text'=> 'Estado de Suscripción') ,
		   			     'chart' => array(
					        'plotBackgroundColor' => '#ffffff',
					        'plotBorderWidth' => null,
					        'plotShadow' => false,
					        'width' => 400,
					      ),
		                'series' => array(array(
		                        'type' => 'pie', 'name' => 'Total',
		                        'data' => array(
		                                array('RESTO: $', 32000),
		                                array('CANCELADO: $', 25000)
		                        )
		                ))
		        )
		
		));
		

		$this->Widget('ext.highcharts.HighchartsWidget', array(
		   'options'=>array(
		      'title' => array('text' => 'Fruit Consumption'),
		      'xAxis' => array(
		         'categories' => array('Apples', 'Bananas', 'Oranges')
		      ),
		      'yAxis' => array(
		         'title' => array('text' => 'Fruit eaten')
		      ),
		      'series' => array(
		         array('name' => 'Jane', 'data' => array(1, 3, 0, 4)),
		         array('name' => 'John', 'data' => array(5, 4, 7, 3))
		      )
		   )
		));
		
		
		$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
      'title' => array('text' => 'Patient Visits By Day (Last Two Weeks)'),
      'xAxis' => array(
         'categories' => array('14th','15th','16th','17th','18th','19th','20th','21th','22th','23th','24th','25th','26th','27th','28th')
      ),
      'yAxis' => array(
         'title' => array('text' => 'Number of Visits')
      ),
      'credits' => array('enabled' => false),
      'series' => array(
         array('name' => 'Hampton Office', 'data' => array(20, 25, 25,35, 30, 28,25, 27, 23, 24, 25, 26,27,28,33)),
         array('name' => 'Newport News Office', 'data' => array(15, 17, 14, 15, 18,21, 22, 26, 33, 28, 30, 28, 25, 36,40)),
         array('name' => 'Richmond Office', 'data' => array(5, 7, 8,9, 7, 10,11, 12, 13,15, 17, 14,15,16,18)),
         array('name' => 'Virgina Beach Office', 'data' => array(25, 27, 23, 22, 24,20, 25, 26, 30, 27, 30, 28, 25, 26,28)),
      )
   )
));
		
		
?>

