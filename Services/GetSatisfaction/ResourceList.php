<?php

abstract class Services_GetSatisfaction_ResourceList
    extends Services_GetSatisfaction_Resource
    implements Iterator
{
    protected $_json = '';
    protected $_obj  = null;
    protected $_index = 0;
    protected $_page  = 0;
    protected $_limit = 30;

    public $count = 0;

    protected function _loadItems($url)
    {
        $url .= (false === strpos($url, '?')) ? '?' : '&';
        $url .= 'limit=' . $this->_limit . '&page=';
        $currentUrl = $url . $this->_page;

        $this->_json = $this->_get($currentUrl);
        $this->_obj  = json_decode($this->_json);
        $this->count = count($this->_obj->data);
        $this->total = $this->_obj->total;
        $this->pages = 1 + floor($this->_obj->total/$this->_limit);

        $this->first_page = $url . '0';
        $this->prev_page  = $url . max(0, $this->_page-1);
        $this->next_page  = $url . min($this->_page+1, (int) $this->total/$this->_limit);
        $this->last_page  = $url . ($this->pages - 1);
    }

    public function setPage($page = 0, $limit = 30)
    {
        $this->_page  = (int) $page;
        $this->_limit = ($limit > 30) ? 30 : (int) $limit;
    }

    public function rewind()
    {
        $this->_index = 0;
    }
    public function current()
    {
        return $this->getObject($this->_index);
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
