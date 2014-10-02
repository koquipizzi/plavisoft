
<?php


		echo "<strong>TOTAL: ".$total."\n";
		$resto = $total - $pagos;
		echo " <br><span style:'color:green;'>CANCELADO: ".$pagos."</span><br>";
		echo "<span style:'color:red;'>RESTANTE: ".$resto."</span></strong>";
		
		
		$this->widget('ext.highcharts.HighchartsWidget', array(
		   'options' => array(
		   			    'title'=> array('text'=> 'Estado de Suscripción') ,
		   			     'chart' => array(
					        'plotBackgroundColor' => '#ffffff',
					        'plotBorderWidth' => null,
					        'plotShadow' => false,
					        'width' => 300,
					      ),
		                'series' => array(array(
		                        'type' => 'pie', 'name' => 'Total',
		                        'data' => array(
		                                array('RESTO: $'.$resto, $resto),
		                                array('CANCELADO: $'.$pagos, $pagos)
		                        )
		                ))
		        )
		
		));
	

?>
