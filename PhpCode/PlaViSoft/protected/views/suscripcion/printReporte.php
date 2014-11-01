<table width=700>
<tr class="grey size">
    <th colspan=12></th>
</tr>
<thead>
	<tr>
		<td width="40" height="20"></td>
		<td width="200" height="20"><?php echo strtoupper(CHtml::encode($suscripcion->persona->getNombreCompletoCotitularDNI())); ?></td>
		<td width="80" height="20"></td>
		<td width="80" height="20"></td>
		<td width="80" height="20"><?php echo strtoupper(CHtml::encode($suscripcion->persona->getNombreCompletoCotitularDNI())); ?></td>
		<td width="80" height="20"></td>
	</tr>
</thead>
<?php 
    foreach ($cuotasSaldo as $cuota){
?>
<tbody>
	<tr>
		<td width="40"  height="20"><?php echo $cuota->nro_cuota; ?></td>
		<td width="200" height="20"><?php echo $cuota->cuotaStr; ?></td>
		<td width="80" height="20" align="left"><?php echo $cuota->valorStr; ?></td>
                <td width="80" height="20" align="left"><?php echo $cuota->canceladoStr; ?></td>
                <td width="80" height="20" align="left"><?php echo $cuota->saldoStr; ?></td>
                <td width="80" height="20" align="left">
                <?php 
                    echo $valor;
                    $valor = $valor - $cuota->totalSaldado;
                ?></td>
	</tr>
</tbody>
<?php        
    }
?>
</table>