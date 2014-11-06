<?php
    if(count($categorias)>0){
?>
<table>
    <thead>
        <tr>
            <td>Categoría</td>
            <td> </td>
        </tr>
    </thead>    
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