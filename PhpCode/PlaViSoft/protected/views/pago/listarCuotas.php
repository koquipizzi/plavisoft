<?php
    echo "Valor Calculado: ".$valor;
?>
<table width="100%" >
    <thead>
        <tr>
            <td>Nro Cuota</td>            
            <td>Cuota</td>
            <td>Valor</td>            
            <td>Cancelado</td>                        
            <td>Saldo</td>                                    
            <td>Valor Imputado</td>                        
        </tr>
    </thead>        
    <tbody>
        <?php 
            foreach($cuotas as $i => $cuota){ 
        ?>
            <tr>        
                <td><?php echo $cuota->nro_cuota; ?></td>                
                <td><?php echo $cuota->cuotaStr; ?></td>
                <td style="text-align: right;" ><?php echo $cuota->valorStr; ?></td>            
                <td style="text-align: right;" ><?php echo $cuota->canceladoStr; ?></td>                            
                <td style="text-align: right;" ><?php echo $cuota->saldoStr; ?></td>                                            
                <td style="text-align: right; font-weight: bold; " ><?php echo $cuota->valorAsignadoStr; ?></td>                        
            </tr>
        <?php } ?>        
    </tbody>
</table>    
