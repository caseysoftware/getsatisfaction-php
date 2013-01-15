<?php

class Services_GetSatisfaction_Product extends Services_GetSatisfaction_Resource
{
    public function bind($params = array()) {
        foreach($params as $param => $value) {
            $this->$param = $value;
        }

        return $this;
    }
}