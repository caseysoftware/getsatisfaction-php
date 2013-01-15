<?php

class Services_GetSatisfaction_Product extends Services_GetSatisfaction
{
    
    protected $company = '';

    /**
     * Constructor.
     *
     * @param string    $username   The getsat email address
     * @param string    $password   The getsat password
     * @param string    $company    The company to start browsing from
     */
    public function __construct($username, $password, $company)
    {
        parent::__construct($username, $password);
        
        $this->company = $company;
    }
}