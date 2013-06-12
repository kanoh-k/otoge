<?php
class Sdvxrank_floor extends AppModel
{
    var $name = 'Sdvxrank_floor';
    var $useDbConfig = 'sdvx_ranking';
    var $useTable = 'floor';
    var $belongsTo = array(
        'Music' => array(
            'className' => 'Sdvxrank_music',
            'foreignKey' => 'music_id',
            ),
        );

    function get_by_date($date)
    {
        $params = array(
            'conditions' => array(
                'Sdvxrank_floor.ranking_date =' => $date,
                ),
            'order' => 'ranking_date ASC',
            );
        return $this->find('all', $params);
    }

    function get_today()
    {
        $date_ary = $this->query("SELECT max(ranking_date) FROM $this->useTable;");
        $date = $date_ary[0][0]['max(ranking_date)'];
        return array ($date, $this->get_by_date($date));
    }
}