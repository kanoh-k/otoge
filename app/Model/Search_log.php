<?php
class Search_log extends AppModel
{
    var $name = 'Search_log';
    var $useTable = 'search_log';

    function write_log($data)
    {
        /* Display */
        if ($data['display'] === 'list')
            $data['display'] = 0;
        else if($data['display'] === 'map')
            $data['display'] = 1;
        else
            $data['display'] = false;

        /* IP address */
        $data['ip_addr'] = ip2long($_SERVER['REMOTE_ADDR']);

        /* ID is assigned automatically */
        $data['id'] = false;

        return $this->save(array('Search_log' => $data), false);
    }
}
