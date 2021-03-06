<?php
App::uses('AppController', 'Controller');

class SdvxrankController extends AppController
{
    public $name = 'Sdvxrank';
    public $uses = array('Sdvxrank_hit_chart', 'Sdvxrank_floor', 'Sdvxrank_exit_tunes', 'Sdvxrank_music');

    private function _valid_date($date)
    {
        return preg_match('/^201[3-9]-[0-3][0-9]-[0-3][0-9]$/', $date);
    }
    
    public function index()
    {
        $this->redirect('daily');
    }

    public function daily($target = 'hit_chart', $date = '')
    {
        $this->layout = 'sdvxrank';

        $fetched = false;

        if ($this->request->isPost() and isset($this->request->data['date']))
        {
            $date = $this->request->data['date'];
        }

        if ($this->request->isPost() and isset($this->request->data['target']))
        {
            $target = $this->request->data['target'];
        }

        if ($target !== 'hit_chart' and $target !== 'floor' and $target !== 'exit_tunes')
        {
            $target = 'hit_chart';
        }

        if ($this->_valid_date($date))
        {
            if ($target === 'hit_chart')
            {
                $ranking = $this->Sdvxrank_hit_chart->get_by_date($date);                
            }
            else if ($target === 'floor')
            {
                $ranking = $this->Sdvxrank_floor->get_by_date($date);
            }
            else if ($target === 'exit_tunes')
            {
                $ranking = $this->Sdvxrank_exit_tunes->get_by_date($date);
            }
            $fetched = true;
        }
        if (!$fetched) /* Get latest hit chart and its data */
        {
            if ($target === 'hit_chart')
            {
                list ($date, $ranking) = $this->Sdvxrank_hit_chart->get_today();
            }
            else if ($target === 'floor')
            {
                list ($date, $ranking) = $this->Sdvxrank_floor->get_today();
            }
            else if ($target === 'exit_tunes')
            {
                list ($date, $ranking) = $this->Sdvxrank_exit_tunes->get_today();
            }
        }

        /* Get date range */
        $this->set('latest', $this->Sdvxrank_hit_chart->get_latest_date());
        $this->set('oldest', $this->Sdvxrank_hit_chart->get_oldest_date());
        
        $this->set('target', $target);
        $this->set('ranking', $ranking);
        $this->set('date', $date);
    }

    public function history($mid = 0, $period = 'week')
    {
        $this->layout = 'sdvxrank';

        if (preg_match('/^[0-9]+$/', $mid) and $this->Sdvxrank_music->music_exist($mid))
        {
            if ($period !== 'week' and $period !== 'month' and $period !== 'all')
            {
                $period = 'week';
            }
            
            $music = $this->Sdvxrank_music->get_by_id($mid);

            if ($period === 'week')
            {
                $h = $this->Sdvxrank_hit_chart->get_week_history($mid);
                $f = $this->Sdvxrank_floor->get_week_history($mid);
                $e = $this->Sdvxrank_exit_tunes->get_week_history($mid);
            }
            else if ($period === 'month')
            {
                $h = $this->Sdvxrank_hit_chart->get_month_history($mid);
                $f = $this->Sdvxrank_floor->get_month_history($mid);
                $e = $this->Sdvxrank_exit_tunes->get_month_history($mid);
            }
            else if ($period === 'all')
            {
                $h = $this->Sdvxrank_hit_chart->get_all_history($mid);
                $f = $this->Sdvxrank_floor->get_all_history($mid);
                $e = $this->Sdvxrank_exit_tunes->get_all_history($mid);
            }
            $history = array_merge_recursive($h, $f, $e);
            $this->set('music', $music['Sdvxrank_music']);
            $this->set('begin', $history['begin']);
            $this->set('end', $history['end']);
            $this->set('history', $history['history']);
            $this->set('period', $period);
        }
        else
        {
            /* midがDBに存在しなかったらエラー */
            $this->set('message', '曲情報が見つかりません');
            $this->render('error');
        }
    }

    public function rank_history($target = 'hit_chart', $rank = 1, $period = 'week')
    {
        $this->layout = 'sdvxrank';

        if ($period !== 'week' and $period !== 'month' and $period !== 'all')
        {
            $period = 'week';
        }

        if ($target === 'hit_chart')
        {
            $target_model = $this->Sdvxrank_hit_chart;
        }
        else if ($target === 'floor')
        {
            $target_model = $this->Sdvxrank_floor;
        }
        else if ($target === 'exit_tunes')
        {
            $target_model = $this->Sdvxrank_exit_tunes;
        }
        else
        {
            $this->set('message', 'パラメータを正しく指定してください');
            $this->render('error');
        }

        if ($period === 'week')
        {
            $history = $target_model->get_week_rank_history($rank);
        }
        else if ($period === 'month')
        {
            $history = $target_model->get_month_rank_history($rank);
        }
        else if ($period === 'all')
        {
            $history = $target_model->get_all_rank_history($rank);
        }

        $this->set('rank', $rank);
        $this->set('target', $target);
        $this->set('begin', $history['begin']);
        $this->set('end', $history['end']);
        $this->set('history', $history['history']);
        $this->set('period', $period);
    }
}