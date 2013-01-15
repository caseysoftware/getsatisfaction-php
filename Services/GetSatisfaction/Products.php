<?php

class Services_GetSatisfaction_Products
    extends Services_GetSatisfaction_ResourceList
{

    public function init($company)
    {
        $url = $this->_base_url . '/companies/' . $company . '/products.' . $this->_format;

        $this->_loadItems($url);
    }

    public function getProductCount()   {   return $this->getCount();   }

    public function getProduct($index = 0)
    {
        $params = array();

        if (isset($this->_obj->data[$index])) {
            $params = $this->_obj->data[$index];
        }

        $item = new Services_GetSatisfaction_Product($this->_username, $this->_password);
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
        return $this->getProduct($index);
    }
}