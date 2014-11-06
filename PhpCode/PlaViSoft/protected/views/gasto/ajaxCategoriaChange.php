<?php
    if(!isset($tituloEnabled))
        $tituloEnabled = TRUE;
    
    if(count($categorias)>0){
?>
<table>
<?php
    if($tituloEnabled){
?>
    <thead>
        <tr>
            <td>Categoría</td>
            <td> </td>
        </tr>
    </thead>    
<?php } ?>    
    <tbody>
<?php
        foreach ($categorias as $categoria){
            $link = "";
            if(!isset($borrarEnabled)||($borrarEnabled==true)){
                $link = "<td><a href=\"#\" onClick=\"AjaxCategoriaDelete(".$categoria->id.");\">Borrar</a></td>";
            }

            echo "
                <tr>
                    <td>".$categoria->descripcion."</td>
                    <td>".$link."</td>
                </tr>
            ";
        }
?>
    </tbody>
</table>
<?php        
    }
    else{
        echo "";
    }
?>