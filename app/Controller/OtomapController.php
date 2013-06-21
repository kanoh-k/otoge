<?php
App::uses('AppController', 'Controller');

class OtomapController extends AppController
{
    public $name = 'Otomap';
    public $uses = array('Game_center', 'Prefecture', 'Search_log', 'Edit_log');

    public function index()
    {
        $this->layout = 'otomap';
        /* Prefectures list for search form */
        $this->set('id2pref', $this->Prefecture->get_id2name_array_for_search());
        $this->set('title_for_layout', '音ゲーマップ');
    }

    public function welcome()
    {
        $this->layout = 'otomap';
        $this->set('title_for_layout', '音ゲー的集合知');
    }


    public function detail($id = null)
    {
        $this->layout = 'otomap';
        $this->set('title_for_layout', '音ゲーマップ');

        $result = $this->Game_center->get_by_id($id);
        
        if (!$result)
        {
            $this->set('have_data', false);
        }
        else
        {
            $this->set('have_data', true);
            $this->set('data', $result);
        }
    }

    public function narrow_detail($id = null)
    {
        $this->layout = 'info_window';
        $this->set('title_for_layout', '音ゲーマップ');

        $result = $this->Game_center->get_by_id($id);
        
        if (!$result)
        {
            $this->set('have_data', false);
        }
        else
        {
            $this->set('have_data', true);
            $this->set('data', $result);
        }
    }

    public function search($mode = 'all')
    {
        $this->layout = 'otomap';
        /* Prefectures list for search form */
        $this->set('id2pref', $this->Prefecture->get_id2name_array_for_search());
        $this->set('mode', $mode);
        $this->set('title_for_layout', '音ゲーマップ');

        if ($this->request->isPost()){
            if ($mode !== 'all' and $mode !== 'sdvx')
            {
                $have_data = false;
                return;
            }
            $list = $this->Game_center->search($this->data, $mode);
            $this->Search_log->write_log($this->data);

            $this->set('have_data', true);
            $this->set('list', $list);
            if ($this->request->data['display'] === 'map')
            {
                $this->set('display', 'map');
                $this->set('id2latlng', $this->Prefecture->get_id2latlng_array());
            }
            else
                $this->set('display', 'list');
        }
        else if ($this->request->isGet())
        {
            if ($mode === 'all'){
                $list = $this->Game_center->search();
                $this->set('have_data', true);
                $this->set('list', $list);
                $this->set('display', 'list');
            }
            else
            {
                $this->set('have_data', false);
            }
        }
        else
        {
            $this->set('have_data', false);
        }
    }

    public function edit($mode = 'new')
    {
        $this->layout = 'otomap';
        $this->set('title_for_layout', '音ゲーマップ');
        
        if ($this->request->isGet())
        {

            // もし mode が数字で、かつそれがIDのゲーセンが存在していたら、そのIDを渡す。存在していなければ'error'を渡す
            if ($mode === 'new') // New mode
            {
                $this->set('id2pref', $this->Prefecture->get_id2name_array());

            }
            else if (is_numeric($mode)) // Exist mode
            {
                $result = $this->Game_center->get_by_id(intval($mode));
                if ($result)
                {
                    $this->set('data', $result);
                    $this->set('id2pref', $this->Prefecture->get_id2name_array());
                    $mode = 'exist';
                }
                else
                {
                    $mode = 'error'; // Shop is not found in the database
                }
            }
            else
            {
                $mode = 'error';
            }
            
            $this->set('mode', $mode);
        }
        else if ($this->request->isPost())
        {
            // POST処理を受け取ったため、$mode=new/{id}に従ってDBの登録/更新を行う
            // TODO

            if ($mode === 'new' or $mode === 'exist')
            {
                // 'new' でIDが指定されていると既存データが書き換えられるため、nullにしてauto_incrementを利用
                if ($mode === 'new')
                    $this->request->data['Game_center']['id'] = null;

                $this->Game_center->set($this->request->data);
                if ($this->Game_center->validates())
                {
                    // $this->Game_center->insert($this->request->data, false);
                    $this->Game_center->save_with_latlng($this->request->data, false);
                    $this->Edit_log->write_log($this->request->data);
                    
                    // Parameter 'mode' will be used to control View
                    $this->set('mode', 'post');            
                }
                else
                {
                    // If data is invalid, go to the register form again
                    $this->set('id2pref', $this->Prefecture->get_id2name_array());
                    $this->set('mode', $mode);
                }
            }
            else
            {
                $this->set('mode', 'error');
            }
        }
    }
}