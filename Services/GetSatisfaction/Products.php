<?php

class Services_GetSatisfaction_Products
    extends Services_GetSatisfaction_ResourceList
{
    protected $_products_json = '';
    protected $_obj  = null;

    public function init($company)
    {
        $this->_company = $company;
        $this->_loadProducts();
    }

    protected function _loadProducts()
    {
        $product_url = $this->_base_url . '/companies/' . $this->_company .
                '/products.' . $this->_format;

        $this->_products_json = $this->_get($product_url);
        $this->_obj  = json_decode($this->_products_json);
    }

    public function getProductCount()
    {
        return $this->_obj->total;
    }

    public function getProduct($index = 0)
    {
        $params = array();

        if (isset($this->_obj->data[$index])) {
            $params = $this->_obj->data[$index];
        }

        $product = new Services_GetSatisfaction_Product($this->_username, $this->_password);
        return $product->bind($params);
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