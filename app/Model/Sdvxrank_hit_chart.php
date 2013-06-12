<?php
class Sdvxrank_hit_chart extends AppModel
{
    var $name = 'Sdvxrank_hit_chart';
    var $useDbConfig = 'sdvx_ranking';
    var $useTable = 'hit_chart';
    var $belongsTo = array(
        'Music' => array(
            'className' => 'Sdvxrank_music',
            'foreignKey' => 'music_id',
            ),
        );

    function get_latest_date()
    {
        $date_ary = $this->query("SELECT max(ranking_date) FROM $this->useTable;");
        $date = $date_ary[0][0]['max(ranking_date)'];
        return $date;
    }

    function get_oldest_date()
    {
        $date_ary = $this->query("SELECT min(ranking_date) FROM $this->useTable;");
        $date = $date_ary[0][0]['min(ranking_date)'];
        return $date;
    }

    function get_by_date($date)
    {
        $params = array(
            'conditions' => array(
                'Sdvxrank_hit_chart.ranking_date =' => $date,
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