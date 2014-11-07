<?php 
    foreach($cuotas as $i => $cuota){ 
?>
    <option value="<?php echo $cuota->id; ?>" data-valor="<?php echo trim($cuota->saldo); ?>">
        <?php echo $cuota->nro_cuota." - ".$cuota->cuotaStr." (".$cuota->saldoStr.")"; ?>      
    </option>
<?php } ?>        
