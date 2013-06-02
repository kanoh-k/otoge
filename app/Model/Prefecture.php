<?php
class Prefecture extends AppModel
{
    var $name = 'Prefecture';

    function get_id2name_array()
    {
        /* 下記のfind('list')で代用
        $params = array('fields' => 'id, name');
        $data = $this->find('all', $params);
        $ret = array();
        foreach ($data as $key => $value)
        {
            $ret[$value['Prefecture']['id']] = $value['Prefecture']['name'];
        }
        return $ret;
        */
        
        $params = array('fields' => array('id', 'name'));
        return $this->find('list', $params);
    }

    function get_id2latlng_array()
    {
        $params = array('fields' => array('id', 'latlng'));
        return $this->find('list', $params);

    }

    function get_id2name_array_for_search()
    {
        return array('0' => '指定しない') + $this->get_id2name_array();
    }
}