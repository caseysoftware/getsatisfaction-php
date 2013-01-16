<?php

class Services_GetSatisfaction_Topic extends Services_GetSatisfaction_Resource
{
    public function getTags($page = 0, $limit = 30)
    {
        $tags = new Services_GetSatisfaction_Tags($this->_username, $this->_password);
        $tags->setPage($page, $limit);
        $tags->init($this->id);
        return $tags;
    }
}