<style type="text/css">
<!--
    table.page_header {width: 100%; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
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
                        CVI Constructora
                    </td>
                </tr>
            </table>
	</page_header>
	<page_footer>
            <table class="page_footer">
                <tr>
                    <td style="width: 100%; text-align: right">
                        Página: [[page_cu]]/[[page_nb]]
                    </td>
                </tr>
            </table>
	</page_footer>
    
    
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
