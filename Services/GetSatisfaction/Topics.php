<?php

class Services_GetSatisfaction_Topics
    extends Services_GetSatisfaction_ResourceList
{

    public function init($product)
    {
        $url = $this->_base_url . '/products/' . $product . '/topics.' . $this->_format;

        $this->_loadItems($url);
    }

    public function getTopicCount() {   return $this->getCount();   }

    public function getTopic($index = 0)
    {
        $params = array();

        if (isset($this->_obj->data[$index])) {
            $params = $this->_obj->data[$index];
        }

        $item = new Services_GetSatisfaction_Topic($this->_username, $this->_password);
        return $item->bind($params);
    }

    /**
     * This is a duplicate of getTopic so that we can have a commonly named
     *    method across all of our resources. It makes the iterator work more
     *    easily.
     *
     * @param type $index
     * @return type
     */
    public function getObject($index = 0)
    {
        return $this->getTopic($index);
    }
}