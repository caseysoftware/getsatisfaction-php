<?php

class Services_GetSatisfaction_Product extends Services_GetSatisfaction_Resource
{

    public function getTopics($page = 0, $limit = 30)
    {
        $topics = new Services_GetSatisfaction_Topics($this->_username, $this->_password);
        $topics->setPage($page, $limit);
        $topics->init($this->id);
        return $topics;
    }
}