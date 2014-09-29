<input type="hidden" id="cheques_agregados" value="<?php echo $cheques_agregados; ?>">
<?php
    if(count($cheques)>0){
        $this->widget('application.extensions.tablesorter.SorterChequesRuntime', array(
            'id'=>'cuota-grid',
            'data'=>$cheques,
            'columns'=>array(
                'Cta_cte',
                'valor',
                'NombreTitular',
                array(
                    'header' => 'Banco',
                    'value' => 'banco.Banco',
                ),                      
                
                
            ),
        )); 
    }
?>