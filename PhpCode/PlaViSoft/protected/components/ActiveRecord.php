<?php

class ActiveRecord extends CActiveRecord {

    public function setAttributes($values, $safeOnly = true) {
        if (!is_array($values))
            return;
        $attributes = array_flip($safeOnly ? $this->getSafeAttributeNames() : $this->attributeNames());
        foreach ($values as $name => $value) {
            if (isset($attributes[$name])) {
                $column = $this->getTableSchema()->getColumn($name); 
                if (stripos($column->dbType, 'decimal') !== false OR
                    stripos($column->dbType, 'float') !== false OR
                    stripos($column->dbType, 'double') !== false OR
                    stripos($column->dbType, 'real') !== false) 
                    $value = Yii::app()->format->unformatNumber($value); 
                $this->$name = $value;
            }
            else if ($safeOnly)
                $this->onUnsafeAttribute($name, $value);
        }
    }
    
}