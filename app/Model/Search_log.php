<?php
class Search_log extends AppModel
{
    var $name = 'Search_log';
    var $useTable = 'search_log';

    function write_log($data)
    {
        if ($data['display'] === 'list')
            $data['display'] = 0;
        else if($data['display'] === 'map')
            $data['display'] = 1;
        else
            $data['display'] = false;

        $data['id'] = false;

        return $this->save(array('Search_log' => $data), false);
    }
}
