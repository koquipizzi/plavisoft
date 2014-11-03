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
 $perc =intval(($pagos/$total)*100); //echo intval$perc;
 echo "<strong>PORC. TOTAL: ".$perc."\n";
 $this->widget(
                                'bootstrap.widgets.TbProgress',
                                array(
                                    'type' => 'success', 
                                    'percent' => $perc,
                                    'htmlOptions' => array(
                                        'data-toggle' => 'tooltip',
                                        'title' => 'Aproximadamente: '. intval($perc).'%'
                                    )                                
                                )
                            )
		
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
