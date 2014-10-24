<?php $this->beginContent('//layouts/main'); ?>
      <div class="row-fluid">
        <div class="span3">
        	<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
        array('label'=>'PLAVISOFT - Entidades',  'active'=>true),
        array('label'=>'Viviendas', 'icon'=>'home', 'url'=>'index.php?r=tipoVivienda/admin'),
        array('label'=>'Suscripciones', 'icon'=>'book', 'url'=>'index.php?r=suscripcion/admin'),
        //array('label'=>'ANOTHER LIST HEADER'),
        array('label'=>'Personas', 'icon'=>'user', 'url'=>'index.php?r=persona/admin'),
        array('label'=>'Financiaciones', 'icon'=>'cog', 'url'=>'index.php?r=financiacion/admin'),
        array('label'=>'Cheques', 'icon'=>'barcode', 'url'=>'index.php?r=cheque/admin'),
       // array('label'=>'Adelantos', 'icon'=>'road', 'url'=>'index.php?r=adelanto/admin'),
     //   array('label'=>'Tipos de Cuotas', 'icon'=>'th-list', 'url'=>'index.php?r=tipocuota/admin'),
        array('label'=>'Ayuda', 'icon'=>'flag', 'url'=>'#'),
    ),
)); ?>
<br>
	
         <?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Operaciones',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'sidebar'),
			));
			$this->endWidget();
		?>

		<?php //var_dump($this->id);
				if(isset($this->susc) and ($this->id === "suscripcion")) 		
		 			$this->widget('Stats', array(
		 			'item'=>$this->susc,
		 			'htmlOptions'=>array('class'=>'white'),
					)); 
		 ?>
		 
		 <?php 
				if(isset($this->id) and ($this->id === "reportes")) 		
		 			$this->widget('StatsTotal', array(
		 			'item'=>$this,
		 			'htmlOptions'=>array('class'=>'white'),
					)); 
		 ?>
		</div><!-- sidebar span3 -->

	<div class="span9">
		<div class="main">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
</div>
<?php $this->endContent(); ?>
