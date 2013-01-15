<?php

class Services_GetSatisfaction_Products
    extends Services_GetSatisfaction_Resource
    implements Iterator
{
    protected $_products_json = '';
    protected $_obj  = null;

    protected $_index = 0;

    /**
     * Constructor.
     *
     * @param string    $username   The getsat email address
     * @param string    $password   The getsat password
     * @param string    $company    The company to start browsing from
     */
    public function __construct($username, $password, $company)
    {
        //TODO: authenticate?

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
        $product = array();

        if (isset($this->_obj->data[$index])) {
            $product = $this->_obj->data[$index];
        }

        return new Services_GetSatisfaction_Product($product);
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

    public function rewind()
    {
        $this->_index = 0;
    }
    public function current()
    {
        return $this->getProduct($this->_index);
    }
    public function key()
    {
        return $this->_index;
    }
    public function next()
    {
        $this->_index++;
    }
    public function valid()
    {
        return isset($this->_obj->data[$this->_index]);
    }
}