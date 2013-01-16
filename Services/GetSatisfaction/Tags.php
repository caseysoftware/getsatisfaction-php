<?php

class Services_GetSatisfaction_Tags
    extends Services_GetSatisfaction_ResourceList
{

    public function init($topic)
    {
        $url = $this->_base_url . '/topics/' . $topic . '/tags.' . $this->_format;

        $this->_loadItems($url);
    }

    public function getTag($index = 0)
    {
        $params = array();

        if (isset($this->_obj->data[$index])) {
            $params = $this->_obj->data[$index];
        }

        $item = new Services_GetSatisfaction_Tag($this->_username, $this->_password);
        return $item->bind($params);
    }

    /**
     * This is a duplicate of getProduct so that we can have a commonly named
     *    method across all of our resources. It makes the iterator work more
     *    easily.
     *
     * @param type $index
     * @return type
     */
    public function getObject($index = 0)
    {
        return $this->getTag($index);
    }
}