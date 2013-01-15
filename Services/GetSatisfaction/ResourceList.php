<?php

abstract class Services_GetSatisfaction_ResourceList
    extends Services_GetSatisfaction_Resource
    implements Iterator
{
    protected $_index = 0;

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
