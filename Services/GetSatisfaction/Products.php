<?php

/*
 * @todo TODO: Should this be iterable so we can list them off individually?
 */
class Services_GetSatisfaction_Products extends Services_GetSatisfaction_Resource
{
    protected $_products_json = '';
    protected $_products_obj  = null;

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
        $this->_products_obj  = json_decode($this->_products_json);
    }

    public function getProductCount()
    {
        return $this->_products_obj->total;
    }

    public function getProduct($index = 0)
    {
        $product = array();

        if (isset($this->_products_obj->data[$index])) {
            $product = $this->_products_obj->data[$index];
        }

        return new Services_GetSatisfaction_Product($product);
    }
}