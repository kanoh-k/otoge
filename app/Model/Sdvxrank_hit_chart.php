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

    function get_data_period(){
        $latest_str = $this->get_latest_date();
        $oldest_str = $this->get_oldest_date();
        
        $days = 0;
        While (true)
        {
            if ($latest_str === date('Y-m-d', strtotime($oldest_str . $days . 'days')))
                break;
            $days++;
        }
        return $days;
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

    function get_history($mid, $days){
        $days--;
        $latest_str = $this->get_latest_date();
        $begin = date('Y-m-d', strtotime($latest_str . ' -' . $days . 'days'));

        $params = array(
            'conditions' => array(
                'music_id =' => $mid,
                'ranking_date >=' => $begin,
                'ranking_date <=' => $latest_str),
            'order' => array('ranking_date ASC'),
            );

        $data['begin'] = $begin;
        $data['end'] = $latest_str;

        $rows = $this->find('all', $params);
        $history = array();
        
        for ($i = 0; $i <= $days; $i++)
        {
            $d = date('Y-m-d', strtotime($begin . $i . 'days'));
            $history[$d][$this->useTable] = 'null'; // Under 20th
        }

        foreach ($rows as $key => $value)
        {
            $d = $value[$this->name]['ranking_date'];
            $h = $value[$this->name]['rank'];
            $history[$d][$this->useTable] = $h;
        }
        
        $data['history'] = $history;
        return $data;
    }

    function get_week_history($mid)
    {
        return $this->get_history($mid, 7);
    }

    function get_month_history($mid)
    {
        return $this->get_history($mid, 31);
    }

    function get_all_history($mid)
    {
        return $this->get_history($mid, $this->get_data_period());
    }

    function get_rank_history($rank, $days)
    {
        $days--;
        $latest_str = $this->get_latest_date();
        $begin = date('Y-m-d', strtotime($latest_str . ' -' . $days . 'days'));
        
        $params = array(
            'conditions' => array(
                'rank =' => $rank,
                'ranking_date >=' => $begin,
                'ranking_date <=' => $latest_str),
            'order' => array('ranking_date ASC'),
            );

        $data['begin'] = $begin;
        $data['end'] = $latest_str;

        $rows = $this->find('all', $params);
        $history = array();
        
        foreach ($rows as $key => $value)
        {
            $d = $value[$this->name]['ranking_date'];
            $info = $value['Music'];
            $history[$d][$this->useTable] = $info;
        }

        $data['history'] = $history;
        return $data;

    }

    function get_week_rank_history($rank)
    {
        return $this->get_rank_history($rank, 7);
    }

    function get_month_rank_history($rank)
    {
        return $this->get_rank_history($rank, 31);
    }

    function get_all_rank_history($rank)
    {
        return $this->get_rank_history($rank, $this->get_data_period());
    }
}