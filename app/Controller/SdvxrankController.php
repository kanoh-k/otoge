<?php
class SdvxrankController extends AppController
{
    public $name = 'Sdvxrank';
    public $uses = array('Sdvxrank_hit_chart', 'Sdvxrank_floor', 'Sdvxrank_exit_tunes');

    private function _valid_date($date)
    {
        return preg_match('/^201[3-9]-[0-3][0-9]-[0-3][0-9]$/', $date);
    }
    
    public function index()
    {
        $this->redirect('daily');
    }

    public function daily($date = '')
    {
        $this->layout = 'sdvxrank';

        $fetched = false;

        if ($this->request->isPost() and isset($this->request->data['date']))
        {
            $date = $this->request->data['date'];
        }

        if ($this->_valid_date($date))
        {
            $hit_chart = $this->Sdvxrank_hit_chart->get_by_date($date);
            $floor = $this->Sdvxrank_floor->get_by_date($date);
            $exit_tunes = $this->Sdvxrank_exit_tunes->get_by_date($date);
            $fetched = true;
        }
        if (!$fetched) /* Get latest ranking data */
        {
            list ($date, $hit_chart) = $this->Sdvxrank_hit_chart->get_today();
            list ($_, $floor) = $this->Sdvxrank_floor->get_today();
            list ($_, $exit_tunes) = $this->Sdvxrank_exit_tunes->get_today();
        }

        /* Get date range */
        $this->set('latest', $this->Sdvxrank_hit_chart->get_latest_date());
        $this->set('oldest', $this->Sdvxrank_hit_chart->get_oldest_date());
        
        $this->set('hit_chart', $hit_chart);
        $this->set('floor', $floor);
        $this->set('exit_tunes', $exit_tunes);
        $this->set('date', $date);
    }
}