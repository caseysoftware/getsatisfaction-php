<?php

abstract class Services_GetSatisfaction_Resource
{
    protected $_username;
    protected $_password;

    protected $_base_url = 'https://api.getsatisfaction.com';
    protected $_format = 'json';

    /**
     * Constructor.
     *
     * @param string    $username   The getsat email address
     * @param string    $password   The getsat password
     */
    public function __construct($username, $password)
    {
        $this->_username = $username;
        $this->_password = $password;
    }

    protected function _get($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $response = curl_exec( $ch );
        curl_close ($ch);

        return $response;
    }
}