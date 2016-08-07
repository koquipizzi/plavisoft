<style type="text/css">


table tbody tr{
    font-size:11pt;
}
body
{
  margin: 0mm 0mm 0mm 0mm;
}

</style>

<body>
<?php 
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<table style="border: solid 1px #000; background: #FFFFFF; width: 100%; text-align: center; margin-top: 20px;">
	<tr>
            <td style="border: solid 0px #000;width: 50%; height: 90px; float:left; vertical-align: bottom; text-align: left; padding-left: 10px; ">
                <img src="<?=Yii::getPathOfAlias('webroot').'/img/cvi.jpg'?>" width="180" alt="logo" style="float: left; margin: 10px; "/>
                <span style="font-size: 10px; margin-top: 40px;"><br><br>
                    C.V.I. CONSTRUCTORA S.A. <br>
                    Rodriguez 1154 - Tandil <br>
                    Tel: (0249) 442-9002<br>
                    cviconstructorasa@gmail.com
                </span>
            </td>
            <td style="border: solid 0px #000;width: 50%; height: 90px; text-align: center">
                <h4>COMPROBANTE DE CUOTA</h4><?php //echo $model->getNroPagoStr() ?>
                Fecha: <?php echo $model->FechaPago; ?>
            </td>
	</tr>
	<!--tr>
	<td style="border: solid 1px #000;width: 50%"></td>
	<th style="border: solid 1px #000;width: 50%; text-align: right">Fecha: <?php echo $model->FechaPago; ?></th>
	</tr>
	<tr>
	<th style="border: solid 1px #000;width: 50%;  height: 60px;">ffff</th>
	<td style="border: solid 1px #FFFFFF;width: 50%">hhh</td>
	</tr-->
</table>
<table style="border: solid px #000; border-top: 0px; border-bottom: 0px; background: #E6E7E8; width: 100%; text-align: center">
	<tr style="background: #E6E7E8; border:0;">
            <td style="width: 70%; text-align: left; height: 10px; padding-left: 10px; padding-top: 5px;"><strong>SUSCRIPTOR</strong></td>
            <td style="width: 10%;text-align: left; padding-top: 5px;"><strong>SUSC. N°</strong></td>
            <td style="width: 20%; text-align: left; padding-top: 5px;"><strong>CUIT</strong></td>
	</tr>
	<tr style="border:0;">
            <td style="width: 70%; height: 50px;text-align: left; padding-left: 10px; "><?php echo strtoupper(CHtml::encode($persona->getNombreCompletoDNI())); ?>
            <?php if ($persona->getNombreCompletoCotitularDNI() !== "")
                    echo ",<br>". strtoupper(CHtml::encode($persona->getNombreCompletoCotitularDNI())); 
            ?></td>
	<td style="width: 10%; height: 50px;text-align: left; vertical-align: middle; "><?php echo $model->cuotasNombreSuscripcion; ?></td>
	<td style="width: 20%; height: 50px; text-align: left; vertical-align: middle; "><?php echo $persona->DNI; ?></td>
	</tr>
</table>
<table style="border: solid 1px #000; background: #FFFFFF; width: 100%; text-align: center; padding-top: 10px;">
        <tr style="border-top: 0px; ">
            <td style="width: 20%; height: 15px;text-align: left; padding-left: 10px;"><strong>RECIBIMOS DE: </strong></td>
	<td style="width: 80%; height: 15px;text-align: left; vertical-align: center;"><?php echo strtoupper(CHtml::encode($persona->getNombreCompleto())); ?></td>
	</tr>
		<tr>
	<td style="border: solid 1px #FFFFFF;width: 20%; height: 15px;text-align: left; padding-left: 10px;"><strong>EN CONCEPTO DE: </strong></td>
	<td style="border: solid 1px #FFFFFF;width: 80%; height: 15px;text-align: left; vertical-align: center;"><?php echo "Pago de Cuotas: ".$model->descripcionCuotasPagas(); ?></td>
	</tr>
</table>
<table style="border: solid 1px #000;  border-top: 0px; background: #FFFFFF; width: 100%; text-align: center">
	<tr>
	<td style="border: solid 1px #FFFFFF;width: 15%;  border-top: 0px;height: 150px;text-align: left; vertical-align: top; padding-left: 10px; padding-top: 10px; "><strong>SON PESOS: </strong></td>
	<td style="border: solid 1px #FFFFFF;width: 45%; height: 150px;text-align: left; vertical-align: top; padding-top: 10px; "><?php echo $model->ImporteLetras; ?></td>
	<td style="border: solid 1px #FFFFFF;width: 40%; height: 150px;text-align: center; vertical-align: top;padding-top: 10px;  "><?php echo " $ ".$model->valor. " "; ?></td>
        
        </tr>

</table>
    <br><br><br>
<table style="border: solid 1px #000; background: #FFFFFF; width: 100%; text-align: center; margin-top: 20px;">
	<tr>
            <td style="border: solid 0px #000;width: 50%; height: 90px; float:left; vertical-align: bottom; text-align: left; padding-left: 10px; ">
                <img src="<?=Yii::getPathOfAlias('webroot').'/img/cvi.jpg'?>" width="180" alt="logo" style="float: left; margin: 10px; "/>
                <span style="font-size: 10px; margin-top: 40px;"><br><br>
                    C.V.I. CONSTRUCTORA S.A. <br>
                    Rodriguez 1154 - Tandil <br>
                    Tel: (0249) 442-9002<br>
                    cviconstructorasa@gmail.com
                </span>
            </td>
            <td style="border: solid 0px #000;width: 50%; height: 90px; text-align: center">
                <h4>COMPROBANTE DE CUOTA</h4><?php //echo $model->getNroPagoStr() ?>
                Fecha: <?php echo $model->FechaPago; ?>
            </td>
	</tr>
	<!--tr>
	<td style="border: solid 1px #000;width: 50%"></td>
	<th style="border: solid 1px #000;width: 50%; text-align: right">Fecha: <?php echo $model->FechaPago; ?></th>
	</tr>
	<tr>
	<th style="border: solid 1px #000;width: 50%;  height: 60px;">ffff</th>
	<td style="border: solid 1px #FFFFFF;width: 50%">hhh</td>
	</tr-->
</table>
<table style="border: solid px #000; border-top: 0px; border-bottom: 0px; background: #E6E7E8; width: 100%; text-align: center">
	<tr style="background: #E6E7E8; border:0;">
            <td style="width: 70%; text-align: left; height: 10px; padding-left: 10px; padding-top: 5px;"><strong>SUSCRIPTOR</strong></td>
            <td style="width: 10%;text-align: left; padding-top: 5px;"><strong>SUSC. N°</strong></td>
            <td style="width: 20%; text-align: left; padding-top: 5px;"><strong>CUIT</strong></td>
	</tr>
	<tr style="border:0;">
            <td style="width: 70%; height: 50px;text-align: left; padding-left: 10px; "><?php echo strtoupper(CHtml::encode($persona->getNombreCompletoDNI())); ?>
            <?php if ($persona->getNombreCompletoCotitularDNI() !== "")
                    echo ",<br>". strtoupper(CHtml::encode($persona->getNombreCompletoCotitularDNI())); 
            ?></td>
	<td style="width: 10%; height: 50px;text-align: left; vertical-align: middle; "><?php echo $model->cuotasNombreSuscripcion; ?></td>
	<td style="width: 20%; height: 50px; text-align: left; vertical-align: middle; "><?php echo $persona->DNI; ?></td>
	</tr>
</table>
<table style="border: solid 1px #000; background: #FFFFFF; width: 100%; text-align: center; padding-top: 10px;">
        <tr style="border-top: 0px; ">
            <td style="width: 20%; height: 15px;text-align: left; padding-left: 10px;"><strong>RECIBIMOS DE: </strong></td>
	<td style="width: 80%; height: 15px;text-align: left; vertical-align: center;"><?php echo strtoupper(CHtml::encode($persona->getNombreCompleto())); ?></td>
	</tr>
		<tr>
	<td style="border: solid 1px #FFFFFF;width: 20%; height: 15px;text-align: left; padding-left: 10px;"><strong>EN CONCEPTO DE: </strong></td>
	<td style="border: solid 1px #FFFFFF;width: 80%; height: 15px;text-align: left; vertical-align: center;"><?php echo "Pago de Cuotas: ".$model->descripcionCuotasPagas(); ?></td>
	</tr>
</table>
<table style="border: solid 1px #000;  border-top: 0px; background: #FFFFFF; width: 100%; text-align: center">
	<tr>
	<td style="border: solid 1px #FFFFFF;width: 15%;  border-top: 0px;height: 150px;text-align: left; vertical-align: top; padding-left: 10px; padding-top: 10px; "><strong>SON PESOS: </strong></td>
	<td style="border: solid 1px #FFFFFF;width: 45%; height: 150px;text-align: left; vertical-align: top; padding-top: 10px; "><?php echo $model->ImporteLetras; ?></td>
	<td style="border: solid 1px #FFFFFF;width: 40%; height: 150px;text-align: center; vertical-align: top;padding-top: 10px;  "><?php echo " $ ".$model->valor. " "; ?></td>
        
        </tr>

</table>