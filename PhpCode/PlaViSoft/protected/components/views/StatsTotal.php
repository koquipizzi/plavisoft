<style type="text/css">
.white {
	background: #FFF;
}
.white {
	margin: 10px;
}
</style>

<div class="datos">
<?php

	//	echo "<strong>TOTAL: ".$total."\n";
		$resto = $total - $pagos;
	//	echo " <br><span style:'color:green;'>CANCELADO: ".$pagos."</span><br>";
//		echo "<span style:'color:red;'>RESTANTE: ".$resto."</span></strong>";
		
?>		
</div>		
<?php		
		$this->widget('ext.highcharts.HighchartsWidget', array(
		   'options' => array(
		   			    'title'=> array('text'=> 'Estado General') ,
		   			     'chart' => array(
					        'plotBackgroundColor' => '#ffffff',
					        'plotBorderWidth' => null,
					        'plotShadow' => false,
					        'width' => 150,
					      ),
		                'series' => array(array(
		                        'type' => 'pie', 'name' => 'Total',
		                        'data' => array(
		                                array('RESTO', $resto),
		                                array('CANCELADO', $pagos)									
		                        ),
		                         'dataLabels' => array(
              						'enabled' => false,
            					),
            					'showInLegend'=>true,
           					//	'size'=>'50',
		                ))
		        )
		
		));
	

?>
<?php

		echo "<strong>TOTAL: ".$total."\n";
		$resto = $total - $pagos;
		echo " <br><span style:'color:green;'>CANCELADO: ".$pagos."</span><br>";
		echo "<span style:'color:red;'>RESTANTE: ".$resto."</span></strong>";
		
?>	