<style type="text/css">
<!--
    table.page_header {width: 100%; border: none; border-bottom: solid 1mm #000000; padding: 2mm }
    table.page_footer {width: 100%; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}

    div.niveau
    {
        padding-left: 5mm;
    }
-->
</style>
<page backtop="14mm" backbottom="54mm" backleft="5mm" backright="5mm" style="font-size: 10pt">
	<page_header>
            <table class="page_header">
                <tr>
                    <td style="width: 100%; text-align: left">
                        CVI Constructora - Reporte de Suscripción
                    </td>
                </tr>
            </table>
	</page_header>
	<page_footer>
            <table class="page_footer">
                <tr>
                    <td style="width: 50%; text-align: left">
                        Página: [[page_cu]]/[[page_nb]]
                    </td>
                    <td style="width: 50%; text-align: right">
                        Fecha de Reporte: <?php echo date('d/m/Y');?>
                    </td>
                </tr>
            </table>
	</page_footer>
    
    
        <table width="100%">
            <tr>
                <td>
                    <?php echo CHtml::image(Yii::app()->request->getBaseUrl(true).'/img/cvi150.jpg'); ?>
                </td>
                <td>
                    <p>
                        <h2><?php echo $suscripcion->persona->nombreCompleto; ?></h2>
                        <?php echo "Suscripción: <b>".$suscripcion->nombreStr."</b>"; ?>
                        <?php echo "<br>Financiacion: <b>".$suscripcion->financiacion->tipoVivienda->Descripcion."</b>"; ?>
                        <?php echo "<br>Fecha de Reporte: <b>".date('d/m/Y')."</b>"; ?>
                        
                    </p>
                </td>
            </tr>
        </table>
        <br><br>
        <table width=700>
            <thead>
                <tr>
                    <td width="70" height="20">Nro. Cuota</td>
                    <td width="200" height="20">Cuota</td>
                    <td width="80" height="20" align="right" >Importe</td>
                    <td width="150" height="20" style="padding-left:15px;" >Cancelado</td>
                    <td width="80" height="20" align="right" >Saldo</td>
                </tr>
            </thead>
            <?php 
                foreach ($cuotasSaldo as $cuota){
            ?>
            <tbody>
                <tr>
                    <td width="70"  height="20"><?php echo $cuota->nro_cuota; ?></td>
                    <td width="200" height="20"><?php echo $cuota->cuotaStr; ?></td>
                    <td width="100" height="20" align="right" ><?php echo $cuota->valorStr; ?></td>
                    <td width="150" height="20" style="padding-left:15px;" ><?php echo $cuota->estadoStr; ?></td>
                    <td width="80" height="20" align="right" ><?php echo '$ '.Yii::app() -> format -> number($valor); ?></td>
                    <?php 
                        $valor = $valor - $cuota->totalSaldado;
                    ?>
                </tr>
            </tbody>
            <?php        
                }
            ?>
        </table>
    
</page>
