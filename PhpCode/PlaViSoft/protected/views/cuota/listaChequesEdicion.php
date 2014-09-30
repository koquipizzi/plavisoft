<table>
    <thead>
        <tr>
            <td>Nro Cheque</td>
            <td>Cta Cte</td>
            <td>Valor</td>
            <td>Nombre Titular</td>
            <td>Banco</td>
        </tr>
    </thead>    
    <tbody>
<?php
    foreach ($cheques as $cheque){
        echo "
        <tr>
            <td>".$cheque->Nro_cheque."</td>
            <td>".$cheque->Cta_cte."</td>
            <td>".$cheque->valor."</td>
            <td>".$cheque->NombreTitular."</td>
            <td>".$cheque->banco->Banco."</td>
            <td><a href=\"#\" onClick=\"borrarCheque(".$cheque->id.");\">Borrar</a></td>    
        </tr>
        ";
    }
    
?>
    </tbody>
</table>

