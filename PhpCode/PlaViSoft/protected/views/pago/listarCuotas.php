<?php
    echo "Valor Calculado: ".$valor;
?>
<table>
    <thead>
        <tr>
            <td>Cuota</td>
            <td>Valor</td>            
            <td>Valor Imputado</td>                        
        </tr>
    </thead>        
    <tbody>
        <?php 
            foreach($cuotas as $i => $cuota){ 
        ?>
            <tr>        
                <td><?php echo $cuota->cuota->cuotaStr; ?></td>
                <td><?php echo $cuota->cuota->valorStr; ?></td>            
                <td><?php echo $cuota->valorImputado; ?></td>                        
            </tr>
        <?php } ?>        
    </tbody>
</table>    
