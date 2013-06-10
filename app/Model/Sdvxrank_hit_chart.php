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

    function get_today()
    {
        $date_ary = $this->query("SELECT max(ranking_date) from $this->useTable;");
        $date = $date_ary[0][0]['max(ranking_date)'];

        $params = array(
            'conditions' => array(
                'Sdvxrank_hit_chart.ranking_date =' => $date,
                ),
            );
        return $this->find('all', $params);
    }
}