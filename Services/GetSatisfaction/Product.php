<?php

class Services_GetSatisfaction_Product extends Services_GetSatisfaction_Resource
{

    public function getTopics()
    {
        $topics = new Services_GetSatisfaction_Topics($this->_username, $this->_password);
        $topics->init($this->id);
        return $topics;
    }
}