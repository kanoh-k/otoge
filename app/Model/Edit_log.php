<?php
class Edit_log extends AppModel
{
    var $name = 'Edit_log';
    var $useTable = 'edit_log';

    function write_log($data)
    {
        $log['id'] = false;
        $log['shop_id'] = $data['Game_center']['id'];
        $log['editor'] = $data['Game_center']['editor'];

        return $this->save(array('Edit_log' => $log));
    }
}
