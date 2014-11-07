<?php
    echo "Valor Calculado: <b>".$valor."</b><br>";
    echo "Total Imputado: <b>".$totalImputado."</b><br>";
    echo "Saldo: <b>".$saldoAImputar."</b>";
?>
<div>
<?php
    if(isset($msj) && trim($msj)!='')
        echo "Error de Imputación: ".$msj;
?>
</div>
<?php
    if(count($cuotas)>0){
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
            <td> </td>     
        </tr>
    </thead>        
    <tbody>
        <?php 
            foreach($cuotas as $i => $cuota){ 
                $link = "";
                if(!isset($borrarEnabled)||($borrarEnabled==true)){
                    $link = "<td><a href=\"#\" onClick=\"borrarImputacionManual(".$cuota->id.");\">Borrar</a></td>";
                }
        ?>
            <tr>        
                <td><?php echo $cuota->nro_cuota; ?></td>                
                <td><?php echo $cuota->cuotaStr; ?></td>
                <td style="text-align: right;" ><?php echo $cuota->valorStr; ?></td>            
                <td style="text-align: right;" ><?php echo $cuota->canceladoStr; ?></td>                            
                <td style="text-align: right;" ><?php echo $cuota->saldoStr; ?></td>                                            
                <td style="text-align: right; font-weight: bold; " ><?php echo $cuota->valorAsignadoStr; ?></td>     
                <?php echo $link; ?>
            </tr>
        <?php } ?>        
    </tbody>
</table>    
<?php
    }
?>
