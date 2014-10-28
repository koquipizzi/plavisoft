<style>
    .mensajeError {
        color: red;
        margin-left: 10px;
        margin-top: 5px;
    }
    .mensajeOk {
        color: green;
        margin-left: 10px;
        margin-top: 5px;
    }
    #div_nro_suscripcion{
        float: left;
        width: 260px;
    }
</style>    
<?php 
    if(!$esta){
        echo '<div class="mensajeOk" >Número de Formulario Libre</div>';
    } 
    else {
        echo '<div class="mensajeError" >Número de Formulario Ocupado</div>';
    }
