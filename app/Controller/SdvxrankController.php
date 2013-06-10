<?php
class SdvxrankController extends AppController
{
    public $name = 'Sdvxrank';
    public $uses = array('Sdvxrank_hit_chart', 'Sdvxrank_floor', 'Sdvxrank_exit_tunes');

    public function index()
    {
        $this->layout = 'otomap';
        $this->set('data', $this->Sdvxrank_hit_chart->get_today());
    }
}