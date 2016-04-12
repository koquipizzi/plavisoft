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

<table style="border: solid 1px #FFFFFF; background: #FFFFFF; width: 100%; text-align: center; margin-top: 20px;">
	<tr>
	<th style="border: solid 1px #FFFFFF;width: 50%; height: 90px;"></th>
	<td style="border: solid 1px #FFFFFF;width: 50%; height: 90px; text-align: right"><?php echo $model->getNroPagoStr() ?></td>
	</tr>
	<tr>
	<td style="border: solid 1px #FFFFFF;width: 50%"></td>
	<th style="border: solid 1px #FFFFFF;width: 50%; text-align: right"><?php echo $model->FechaPago; ?></th>
	</tr>
	<tr>
	<th style="border: solid 1px #FFFFFF;width: 50%;  height: 60px;"></th>
	<td style="border: solid 1px #FFFFFF;width: 50%"></td>
	</tr>
</table>
<table style="border: solid 1px #FFFFFF; background: #FFFFFF; width: 100%; text-align: center">
	<tr>
            <td style="border: solid 1px #FFFFFF;width: 70%;"></td>
            <td style="border: solid 1px #FFFFFF;width: 10%;text-align: left;"></td>
            <td style="border: solid 1px #FFFFFF;width: 20%; text-align: right; vertical-align: bottom;"></td>
	</tr>
	<tr>
            <th style="border: solid 1px #FFFFFF;width: 70%; height: 70px;text-align: left; "><?php echo strtoupper(CHtml::encode($persona->getNombreCompletoDNI())); ?>
            <?php if ($persona->getNombreCompletoCotitularDNI() !== "")
                    echo ",<br>". strtoupper(CHtml::encode($persona->getNombreCompletoCotitularDNI())); 
            ?></th>
	<td style="border: solid 1px #FFFFFF;width: 10%; height: 70px;text-align: left;"><?php echo $model->cuotasNombreSuscripcion; ?></td>
	<td style="border: solid 1px #FFFFFF;width: 20%; height: 70px; text-align: right; vertical-align: bottom;"><?php echo $persona->DNI; ?></td>
	</tr>
</table>
<table style="border: solid 1px #FFFFFF; background: #FFFFFF; width: 100%; text-align: center">
	<tr>
	<td style="border: solid 1px #FFFFFF;width: 20%; height: 15px;text-align: left; "></td>
	<td style="border: solid 1px #FFFFFF;width: 80%; height: 15px;text-align: left; vertical-align: bottom;"><?php echo strtoupper(CHtml::encode($persona->getNombreCompleto())); ?></td>
	</tr>
		<tr>
	<td style="border: solid 1px #FFFFFF;width: 20%; height: 15px;text-align: left; "></td>
	<td style="border: solid 1px #FFFFFF;width: 80%; height: 15px;text-align: left; vertical-align: bottom;"><?php echo "Pago de Cuotas: ".$model->descripcionCuotasPagas(); ?></td>
	</tr>
</table>
<table style="border: solid 1px #FFFFFF; background: #FFFFFF; width: 100%; text-align: center">
	<tr>
	<td style="border: solid 1px #FFFFFF;width: 15%; height: 60px;text-align: left; "></td>
	<td style="border: solid 1px #FFFFFF;width: 45%; height: 60px;text-align: left; "><?php echo $model->ImporteLetras; ?></td>
	<td style="border: solid 1px #FFFFFF;width: 40%; height: 60px;text-align: right; "><?php echo " $ ".$model->valor. " "; ?></td>
	</tr>

</table>
