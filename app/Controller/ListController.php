<?php
// app/controllers/list_controller.php
class ListController extends AppController
{
    public $name = 'List';
    public $uses = array('Game_center');

    public function index()
    {
        $this->layout = 'otomap';
        $this->set('data', $this->Game_center->find('all'));
    }
}