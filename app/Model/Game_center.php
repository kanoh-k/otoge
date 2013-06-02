<?php
/**
 * <カラム追加手順>
 *    - $validate に検証する条件を追加
 *    - insert() で、保存する際の対象レコードに追加
 */
class Game_center extends AppModel
{
    var $name = 'Game_center';
    
    var $validate = array(
        'id' => array(
            'rule' => 'numeric',
            'required' => false,
            'message' => 'IDが不正です',
            ),
        'name' => array(
            array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
                'message' => '店舗名の入力は必須です',
                ),
            array(
                'rule' => 'isUnique',
                'message' => '既に登録されています',
                'on' => 'create',
                ),
            array(
                'rule' =>  array('maxLength', 100),
                'message' => '店舗名は半角100文字以下にしてください',
                ),
            ),
        'prefecture' => array(
            array(
                'rule' => 'numeric',
                'required' => true,
                'allowEmpty' => false,
                'message' => '都道府県が不正です',
                ),
            array(
                'rule' => array('comparison', '>=', 1),
                'message' => '都道府県が不正です',
                ),
            array(
                'rule' => array('comparison', '<=', 47),
                'message' => '都道府県が不正です',
                ),
            ),
        'address' => array(
            array(
                'rule' => 'notEmpty',
                'message' => '住所の入力は必須です',
                ),
            array(
                'rule' =>  array('maxLength', 256),
                'message' => '店舗名は半角256文字以下にしてください',
                ),
            ),
        'url' => array(
            array(
                'rule' => array('maxLength', 256),
                'message' => 'URLは半角256文字以下にしてください',
                ),
            array(
                'rule' => array('url', true),
                'message' => '正しいURLを入力してください',
                ),
            ),
        'start_time' => array(
            array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
                'message' => '営業時間を正しく指定してください',
                ),
            ),
        'end_time' => array(
            array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
                'message' => '営業時間を正しく指定してください',
                ),
            ),
        'editor' => array(
            array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
                'message' => '投稿者の入力は必須です',
                ),
            array(
                'rule' =>  array('maxLength', 100),
                'message' => '投稿者は半角100文字以下にしてください',
                ),
            ),
        );

    function __construct()
    {
        parent::__construct();
        
        $remark_rules = array(
            array(
                'rule' => array('maxLength', 1000),
                'required' => false,
                'allowEmpty' => true,
                'message' => '備考は半角1000文字以下にしてください',
                ),
            );

        $game_rules = array(
            array(
                'rule' => 'numeric',
                'allowEmpty' => true,
                'message' => '台数には0～99の整数が使用可能です',
                ),
            array(
                'rule' => array('comparison', '>=', 0),
                'message' => '台数には0～99の整数が使用可能です',
                ),
            array(
                'rule' => array('comparison', '<=', 99),
                'message' => '台数には0～99の整数が使用可能です',
                ),
            );

        $paseli_rules = array(
            array(
                'rule' => 'numeric',
                'required' => false,
                'allowEmpty' => true,
                'message' => 'パセリ料金は0以上の整数を指定してください',
                ),
            array(
                'rule' => array('comparison', '>=', 0),
                'message' => 'パセリ料金は0以上の整数を指定してください',                
                ),
            );

        $credit_rules = array(
            array(
                'rule' => 'numeric',
                'required' => false,
                'allowEmpty' => true,
                'message' => 'クレジット料金は0以上の整数を指定してください',
                ),
            array(
                'rule' => array('comparison', '>=', 0),
                'message' => 'クレジット料金は0以上の整数を指定してください',
                ),
            );

        $tune_rules = array(
            array(
                'rule' => 'numeric',
                'required' => false,
                'allowEmpty' => true,
                'message' => '曲数は0以上の整数を指定してください',
                ),
            array(
                'rule' => array('comparison', '>=', 1),
                'message' => '曲数は1以上の整数を指定してください',
                ),
            );
            

        $this->validate['iidx'] = $game_rules;
        $this->validate['popn'] = $game_rules;
        $this->validate['ddr'] = $game_rules;
        $this->validate['guiter'] = $game_rules;
        $this->validate['drum'] = $game_rules;
        $this->validate['jubeat'] = $game_rules;
        $this->validate['reflec'] = $game_rules;
        $this->validate['sdvx'] = $game_rules;
        $this->validate['deac'] = $game_rules;
        $this->validate['remark'] = $remark_rules;

        $this->validate['jubeat_credit'] = $credit_rules;
        $this->validate['jubeat_credit_tune'] = $tune_rules;
        $this->validate['jubeat_paseli'] = $paseli_rules;
        $this->validate['jubeat_paseli_tune'] = $tune_rules;
        $this->validate['jubeat_remark'] = $remark_rules;
        
        $this->validate['sdvx_credit'] = $credit_rules;
        $this->validate['sdvx_paseli'] = $paseli_rules;
        $this->validate['sdvx_remark'] = $remark_rules;

        $this->validate['iidx_remark'] = $remark_rules;

        $this->validate['popn_remark'] = $remark_rules;

        $this->validate['ddr_remark'] = $remark_rules;

        $this->validate['guiter_remark'] = $remark_rules;

        $this->validate['drum_remark'] = $remark_rules;

        $this->validate['reflec_remark'] = $remark_rules;

        $this->validate['deac_remark'] = $remark_rules;

    }
    
    function search($cond = null, $mode = 'all')
    {
        $joins = array(
            array(
                'type' => 'left',
                'table' => 'prefectures',
                'alias' => 'Prefecture',
                'conditions' => array('Game_center.prefecture = Prefecture.id')
                )
            );

        // $params: 検索結果に表示するフィールドのみ取得
        if($mode === 'sdvx')
        {
            if (isset($cond['sdvx']))
                $cond['sdvx'] = max(1, $cond['sdvx']);
            else
                $cond['sdvx'] = 1;
            $params = array('fields' => 'Prefecture.name, Prefecture.latlng, id, name, address, Game_center.latlng, sdvx, sdvx_credit, sdvx_paseli, start_time, end_time', 'joins' => $joins);
        }
        else // $mode === 'all'
            $params = array('fields' => 'Prefecture.name, Prefecture.latlng, id, name, address, Game_center.latlng, iidx, popn, ddr, guiter, drum, jubeat, reflec, sdvx, deac, start_time, end_time', 'joins' => $joins);


        // Search condition
        if(isset($cond))
        {
            if (isset($cond['prefecture']) and intval($cond['prefecture']) > 0)
            {
                $params['conditions']['AND']['Game_center.prefecture'] = intval($cond['prefecture']);
            }
            if (isset($cond['iidx']) and intval($cond['iidx']) > 0)
            {
                $params['conditions']['AND']['Game_center.iidx >='] = intval($cond['iidx']);
            }
            if (isset($cond['popn']) and intval($cond['popn']) > 0)
            {
                $params['conditions']['AND']['Game_center.popn >='] = intval($cond['popn']);
            }
            if (isset($cond['ddr']) and intval($cond['ddr']) > 0)
            {
                $params['conditions']['AND']['Game_center.ddr >='] = intval($cond['ddr']);
            }
            if (isset($cond['guiter']) and intval($cond['guiter']) > 0)
            {
                $params['conditions']['AND']['Game_center.guiter >='] = intval($cond['guiter']);
            }
            if (isset($cond['drumn']) and intval($cond['drumn']) > 0)
            {
                $params['conditions']['AND']['Game_center.drumn >='] = intval($cond['drumn']);
            }
            if (isset($cond['jubeat']) and intval($cond['jubeat']) > 0)
            {
                $params['conditions']['AND']['Game_center.jubeat >='] = intval($cond['jubeat']);
            }
            if (isset($cond['reflec']) and intval($cond['reflec']) > 0)
            {
                $params['conditions']['AND']['Game_center.reflec >='] = intval($cond['reflec']);
            }
            if (isset($cond['sdvx']) and intval($cond['sdvx']) > 0)
            {
                $params['conditions']['AND']['Game_center.sdvx >='] = intval($cond['sdvx']);
            }
            if (isset($cond['sdvx_credit']) and intval($cond['sdvx_credit']) > 0)
            {
                $params['conditions']['AND']['Game_center.sdvx_credit >'] = 0;
                $params['conditions']['AND']['Game_center.sdvx_credit <='] = intval($cond['sdvx_credit']);
            }
            if (isset($cond['sdvx_paseli']) and intval($cond['sdvx_paseli']) > 0)
            {
                $params['conditions']['AND']['Game_center.sdvx_paseli >'] = 0;
                $params['conditions']['AND']['Game_center.sdvx_paseli <='] = intval($cond['sdvx_paseli']);
            }
            if (isset($cond['deac']) and intval($cond['deac']) > 0)
            {
                $params['conditions']['AND']['Game_center.deac >='] = intval($cond['deac']);
            }
            $str_array = array();
            if(isset($cond['name']))
            {
                $str = mb_convert_kana($cond['name'], 's');
                $keywords = preg_split('/[\s]+/', $str, -1, PREG_SPLIT_NO_EMPTY);
                foreach ($keywords as $word)
                {
                    array_push($str_array, array('Game_center.name LIKE' => "%$word%"));
                }
            }
            if(isset($cond['address']))
            {
                $str = mb_convert_kana($cond['address'], 's');
                $keywords = preg_split('/[\s]+/', $str, -1, PREG_SPLIT_NO_EMPTY);
                foreach ($keywords as $word)
                {
                    array_push($str_array, array('Game_center.address LIKE' => "%$word%"));
                }
            }
            $params['conditions']['AND']['AND'] = $str_array;
        }
        
        $data = $this->find('all', $params);
        return $data;
    }

    function get_by_id($id = null)
    {
        if (!isset($id) and intval($id) > 0)
            return false;
        
        $joins = array(
            array(
                'type' => 'left',
                'table' => 'prefectures',
                'alias' => 'Prefecture',
                'conditions' => array('Game_center.prefecture = Prefecture.id')
                )
            );

         $params = array('fields' => 'Prefecture.name, Prefecture.latlng, Game_center.*', 'joins' => $joins);

        $params['conditions']['Game_center.id'] = intval($id);

        
        $data = $this->find('first', $params);
        return $data;
        
    }

    /**
     * 住所からLatLngを求めてその情報も追加
     */
    function save_with_latlng($data, $do_validation = true)
    {
        // Limit the fields added by user
        /*
        $fields = array(
            'name',
            'prefecture',
            'address',
            'start_time',
            'end_time',
            'iidx',
            'popn',
            'ddr',
            'guiter',
            'drum',
            'jubeat',
            'reflec',
            'sdvx',
            'deac',
            'remark',
            'editor',
            'sdvx_credit'
            'sdvx_paseli',
            'sdvx_remark',
            'jubeat_credit',
            'jubeat_credit_tune',
            'jubeat_paseli',
            'jubeat_paseli,tune',
            'jubeat_remark',
            );
        */

        if (isset($data['Game_center']['address']))
        {
            $json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($data['Game_center']['address']) . '&sensor=false', true);
            if ($json)
            {
                $obj = json_decode($json, true);
                if ($obj['status'] === 'OK')
                {
                    $latlng = $obj['results'][0]['geometry']['location']['lat'] . ', ' . $obj['results'][0]['geometry']['location']['lng'];
                    $data['Game_center']['latlng'] = $latlng;
                }
            }
        }
            
        return $this->save($data, $do_validation/*, $fields*/);
    }
}