<?php

class Services_GetSatisfaction_Product
{
    public function __construct($params = array()) {
        foreach($params as $param => $value) {
            $this->$param = $value;
        }
    }
}