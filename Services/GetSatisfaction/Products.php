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
        $product = null;

        if (isset($this->_products_obj->data[$index])) {
            $product = $this->_products_obj->data[$index];
        }

//TODO: cast as object
        return $product;
    }
}

/*
{
	"total":2,
	"data":[
        {
        	"description":"Discussion about OpenVBX Plugins",
            "canonical_name":"openvbx_openvbx_plugins",
            "created_at":"2010/06/25 19:42:28 +0000",
            "url":"https://api.getsatisfaction.com/products/57937",
            "links":[],
            "company":"openvbx",
            "name":"OpenVBX Plugins",
            "image":"https://d37wxxhohlp07s.cloudfront.net/public/uploaded_images/4772167/plugin-icon_small.png",
            "id":57937
        },
        {
            "description":"OpenVBX is a web-based open source phone system for business, powered by Twilio.",
            "canonical_name":"openvbx_openvbx",
            "created_at":"2010/06/15 11:24:08 +0000",
            "url":"https://api.getsatisfaction.com/products/57646",
            "links":[
                {
                    "label":"OpenVBX.org",
                    "created_at":"2010/06/16 00:23:10 +0000",
                    "id":175734,
                    "url":"http://www.openvbx.org"
                }
            ],
            "company":"openvbx",
            "name":"OpenVBX",
            "image":"https://d37wxxhohlp07s.cloudfront.net/public/uploaded_images/4691793/openvbx-logo-temp_small.png",
            "id":57646
        }
    ]
}
 * */