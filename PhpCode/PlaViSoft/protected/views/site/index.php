<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<!--h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p-->

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
    'heading'=>'PlaViSoft',
)); ?>
 
    <p>Bienvenidos al Sistema de Gestión de Viviendas Online de ADAMUCHOTA TANDIL.</p>
    <p><?php $this->widget('bootstrap.widgets.TbButton', array(
    	'url'=>'index.php?r=site/login',
        'type'=>'primary',
        'size'=>'large',
        'label'=>'Acceso',
    )); ?></p>
 
<?php $this->endWidget(); ?>