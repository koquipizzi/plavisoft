<?php
/**
 * Tablesorter extension for Yii.
 *
 * jQuery tablesorter extension for Yii, for turning a standard grid view into a sortable table without page refreshes.
 * Its a wrapper of  https://github.com/Mottie/tablesorter
 *
 * @author Nachi <innovativenachi@gmail.com>
 * @link https://github.com/Mottie/tablesorter
 * @link https://github.com/innovativenachi/tablesorter
 * @version 0.1
 *
 */
class Sorter extends CWidget
{
	//Parameters passed
	private $_options = array(
        'data'    => null,
        'columns'   => null,
        'filters'   => null,
    );
    
    public function init()
	{
		//Table sorter was intialized
	}
	
	//Magic function for get parameters
	public function __get($name) {
        if(array_key_exists($name, $this->_options)) {
            return $this->_options[$name];
        }
        return parent::__get($name);
    }
	
	//Magic function for setting parameters
    public function __set($name, $value) {
        if(array_key_exists($name, $this->_options)) {
            return $this->_options[$name] = $value;
        }
        return parent::__set($name, $value);
    }
	
	//Register CSS and Jquery
	public function registerClientScript()
	{
		$bu = Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets/');
                $cs = Yii::app()->clientScript;
                //Intialize CSS
                $cs->registerCssFile($bu . '/css/tablesorter.css');
		$cs->registerCssFile($bu . '/css/tablesorter.pager.css');
		$cs->registerCssFile($bu . '/css/bootstrap.css');
		//Intialize Jquery
		$cs->registerScriptFile($bu . '/js/tablesorter.js');
		$cs->registerScriptFile($bu . '/js/tablesorter.pager.js');
		$cs->registerScriptFile($bu . '/js/tablesorter.widgets.js');
		$cs->registerScriptFile($bu . '/js/tablesorter.widgets-filter-formatter.js');
		$cs->registerScriptFile($bu . '/js/scripts.js');
	}
	
	public function genTable()
	{
		$datas=$this->data;
                if(count($datas)>0){
                    $object=$datas[0];
                    $class=get_class($object);
                    $count=count($datas);
                    echo "Total: ".$count." resultados encontrados";

                    //delete by using post method
                    echo '<script>
                             function del_data(url,data) {
                                    var result = confirm("¿Está seguro de querer borrar el registro?");
                                    if (result==true) {
                                            $.post( url , { id : data }).
                                                done(function( data ) {
                                                    //alert( data );
                                                    location.reload();
                                                });
                                    }	
                             }
                             </script>';

                    //Table start
                    echo "<table class='tablesorter-bootstrap'>";
                    //Table head start
                    echo "<thead>";
                    echo "<tr>";
                    $filters=$this->filters;
                    $i=0;
                    foreach($this->columns as $column)
                    {
                            //checking whether the column name is customized
                            if(is_array($column))
                            {
                                    $column=$column['header'];	
                            }

                            $find = explode(".", $column);
                            if(count($find)>1) {
                            echo "<th class='".$filters[$i]."'>".ucfirst($find[1])."</th>";	
                            }
                            else
                            echo "<th class='".$filters[$i]."'>".ucfirst($column)."</th>";

                            $i++;
                    }
                    echo "<th class='filter-false'>Acciones</th>";
                    echo "</tr>\n";
                    echo "</thead>\n";
                    //Table head end

                    //Table body start
                    echo "<tbody>\n";
                    foreach($datas as $data)
                    {
                            $this->print_row($data,$class);
                    }
                    echo "</tbody>\n";
                    //Table body end

                    //Table footer 
                    echo $this->footer();

                    echo "</table>\n";
                    //Table end
                    
                }
                else
                {
                    echo '<div style="text-align:center;" >No se han encontrado objetos</div>';
                }
	}
	
	//Runs after the widget is intialized
	public function run()
	{
		$this->registerClientScript();
		$this->genTable();
	}
        
        public function buttons($class, $data){
            $r = '';
            //View, Edit and Delete Urls
            $view_url=Yii::app()->createAbsoluteUrl($class.'/view',array('id'=>$data->id));
            $edit_url=Yii::app()->createAbsoluteUrl($class.'/update',array('id'=>$data->id));
            $delete_url='"'.Yii::app()->createAbsoluteUrl($class.'/delete',array('id'=>$data->id)).'"';
            $del_data='"'.$data->id.'"';
            //View, Edit, Delete Icons (bootstrap)
            $r .= "
                <td>  
                    <a class='btn btn-small' href='".$view_url."'><i class='icon-search'></i></a>&nbsp; 
                    <a class='btn btn-small' href='".$edit_url."'><i class='icon-edit'></i></a>&nbsp; 
                    <a class='btn btn-small' href='javascript:void(0);' onclick='del_data(".$delete_url.",".$del_data.");'><i class='icon-trash'></i></a>
                </td>
            ";
            
            return $r;
        }
        
        
        public function footer(){
            $r =  ' 
                <tfoot>\n
                    <tr>
                        <th colspan="7" class="pager form-horizontal">
                                <button type="button" class="btn first"><i class="icon-step-backward"></i></button>
                                <button type="button" class="btn prev"><i class="icon-arrow-left"></i></button>
                                <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
                                <button type="button" class="btn next"><i class="icon-arrow-right"></i></button>
                                <button type="button" class="btn last"><i class="icon-step-forward"></i></button>
                                <select class="pagesize input-mini" title="Seleccione tamaño de página">
                                        <option selected="selected" value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                </select>
                                <select class="pagenum input-mini" title="Seleccione número de página"></select>
                        </th>
                    </tr>
                </tfoot>\n';
            return $r;
        }
        
        public function print_row($data,$class){
                $row_style = $this->getRowStyle($data);
                echo "<tr $row_style>\n";
                foreach($this->columns as $column)
                {
                        //checking whether the column name is customized
                        $col_style = $this->getColStyle($column);                    
                        if(is_array($column))
                        {
                                $column=$column['value'];	
                        }

                        $find = explode(".", $column);
                        if(count($find)>1) {
                                echo "<td $col_style >".$data->$find[0]->$find[1]."</td>";	
                        }
                        else {	
                                echo "<td $col_style >".$data->$column."</td>";
                        }
                }
                // Agregado por Diego
                echo $this->buttons($class, $data);

                echo "</tr>\n";            
        }
        
        
        public function getRowStyle($data){
                return '';
        }
        
        
        public function getColStyle($column){
                if(is_array($column) &&  array_key_exists('style', $column))
                {
                        return 'style="'.$column['style'].'"';	
                }            
                return '';
        }
        
        
        

}
?>