<?php
class Sdvxrank_music extends AppModel
{
    var $name = 'Sdvxrank_music';
    var $useDbConfig = 'sdvx_ranking';
    var $useTable = 'musics';

    public function music_exist($id)
    {
        $count_ary = $this->query("SELECT count(*) FROM $this->useTable WHERE id = $id;");
        $count = $count_ary[0][0]['count(*)'];
        if ($count > 0)
            return True;
        else
            return False;
    }

    public function get_by_id($id)
    {
        $params = array('conditions' => array('Sdvxrank_music.id' => $id));
        return $this->find('first', $params);
    }
}