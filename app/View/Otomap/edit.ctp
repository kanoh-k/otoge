<?php
$this_url = Configure::read('url.edit');
if($mode === 'error')
{
?>
error
<?php
}
else if ($mode === 'post')
{
?>
    <div style="text-align: center">
    データの登録が完了しました<br>ご協力ありがとうございました
    </div>
<?php    
}
else if ($mode === 'new' or $mode === 'exist')
{
    if($mode === 'new'){
        $form_title = 'ゲームセンターの新規登録';
    }
    else // 'exist' mode
    {
        $form_title = $data['Game_center']['name'] . "の編集";
        $this->Form->data = $data;
    }
?>
<div id="page-title">
<?php echo $form_title; ?>
</div><br>

<table class="register_table">
<?php
     $required_html = '<br><div class="message-for-required">※必須</div>';
     function _get_msg_tag($str)
     {
         return '<div class="reg-message">' . $str . '</div>';
     }

     $format = array('before', 'label', 'between','input', 'error', 'after');

     $game_opt = array(
         'label' => '設置台数：',
         'min' => 0,
         'max' => 99,
         'before' => '<td>',
         'after' => _get_msg_tag('※0～99の整数を入力してください。') . '</td>',
         'class' => 'narrow-num',
         'format' => $format,
         );

     $credit_opt = array(
         'label' => 'クレジット料金：',
         'min' => 0,
         'max' => 999,
         'before' => '<tr><td>',
         'after' => '円</td></tr>',
         'class' => 'narrow-num',
         'format' => $format,
         );

     $paseli_opt = array(
         'label' => 'パセリ料金：',
         'min' => 0,
         'max' => 999,
         'before' => '<tr><td>',
         'after' => 'PASELI' . _get_msg_tag('※パセリ非対応の場合は空欄にしてください') . '</td></tr>',
         'class' => 'narrow-num',
         'format' => $format,
         );

     $paseli_opt_jube = array(
         'label' => '<b>1曲あたりの</b>パセリ料金：',
         'min' => 0,
         'max' => 999,
         'before' => '<tr><td>',
         'after' => 'PASELI' . _get_msg_tag('※<font color=red>1曲あたりの</font>パセリ料金を入力してください') . _get_msg_tag('※パセリ非対応の場合は空欄にしてください') . '</td></tr>',
         'class' => 'narrow-num',
         'format' => $format,
         );

     $tune_opt = array(
         'label' => false,
         'min' => 1,
         'max' => 99,
         'before' => '<tr><td>',
         'after' => '曲</td></td>',
         'class' => 'narrow-num',
         'format' => $format,
         );
     
     $remark_opt = array(
         'label' => '備考：',
         'before' => '<tr><td>',
         'between' => '<br>',
         'after' =>  _get_msg_tag('※半角1000文字以内で入力してください') . '</td></tr>',
         'type' => 'textarea',
         'format' => $format,
         'rows' => 2,
         );
     
     // 'label' => false
     echo $this->Form->create(false, array('type'=>'post', 'action'=>'edit/' . $mode));
    echo "<tr><th>店舗名$required_html</th><td>";
    echo $this->Form->input('Game_center.name', array(
                                'label' => false,
                                'type' => 'text',
                                ));
    echo "</td></tr><tr><th>都道府県$required_html</th><td>";
    
    // $id2pref = array(100 => 'attacker');
    
    echo $this->Form->input('Game_center.prefecture', array(
                                'label' => false,
                                'type' => 'select',
                                'options' => $id2pref,
                                'format' => $format,
                                ));
    echo _get_msg_tag('※上記リストから選択してください。');
    echo "</td></tr><tr><th>住所$required_html</th><td>";
    echo $this->Form->input('Game_center.address', array(
                                'label' => false,
                                'type' => 'text',
                                'format' => $format,
                                ));
    echo _get_msg_tag('※都道府県以降の住所のみ入力してください。');
    echo "</td></tr><tr><th>営業時間$required_html</th><td>";
    echo $this->Form->input('Game_center.start_time', array(
                                'label' => false,
                                'after' => '～',
                                'div' => false,
                                'timeFormat' => '24',
                                'selected' => strtotime('10:00'),
                                'format' => $format,
                                ));
    echo $this->Form->input('Game_center.end_time', array(
                                'label' => false,
                                'after' => '',
                                'div' => false,
                                'timeFormat' => '24',
                                'selected' => strtotime('24:00'),
                                'format' => $format,
                                ));
    echo _get_msg_tag('※曜日により営業時間が異なる場合は、備考で対応してください。');
    echo '</td></tr><tr><th>URL</th><td>';
    echo $this->Form->input('Game_center.url', array(
                                'label' => false,
                                'type' => 'url',
                                'format' => $format,
                                ));
    echo '</td></tr><tr><th>備考</th><td>';
    echo $this->Form->input('Game_center.remark', array(
         'label' => '備考：',
         'between' => '<br>',
         'after' =>  _get_msg_tag('※個別の機種に関する情報は、機種ごとの備考欄に記入してください') .  _get_msg_tag('※半角1000文字以内で入力してください'),
         'type' => 'textarea',
         'rows' => 2,
         'format' => $format)
        );

    echo '</td></tr><tr><th rowspan=2>beatmania IIDX</th>';
    echo $this->Form->input('Game_center.iidx', $game_opt);
    echo $this->Form->input('Game_center.iidx_remark', $remark_opt);

    echo '</tr><tr><th rowspan=2>pop\'n music</th>'; 
    echo $this->Form->input('Game_center.popn', $game_opt);
    echo $this->Form->input('Game_center.popn_remark', $remark_opt);

    echo '</tr><tr><th rowspan=2>DDR</th>'; 
    echo $this->Form->input('Game_center.ddr', $game_opt);
    echo $this->Form->input('Game_center.ddr_remark', $remark_opt);

    echo '</tr><tr><th rowspan=2>GuiterFreaks</th>'; 
    echo $this->Form->input('Game_center.guiter', $game_opt);
    echo $this->Form->input('Game_center.guiter_remark', $remark_opt);

    echo '</tr><tr><th rowspan=2>DrumMania</th>'; 
    echo $this->Form->input('Game_center.drum', $game_opt);
    echo $this->Form->input('Game_center.drum_remark', $remark_opt);

    echo '</tr><tr><th rowspan=6>jubeat</th>'; 
    echo $this->Form->input('Game_center.jubeat', $game_opt);
    echo $this->Form->input('Game_center.jubeat_credit', $credit_opt);
    $tune_opt['label'] = '曲数：';
    echo $this->Form->input('Game_center.jubeat_credit_tune', $tune_opt);
    echo $this->Form->input('Game_center.jubeat_paseli', $paseli_opt_jube);
    $tune_opt['label'] = 'PASELI使用時最大曲数：';
    echo $this->Form->input('Game_center.jubeat_paseli_tune', $tune_opt);
    echo $this->Form->input('Game_center.jubeat_remark', $remark_opt);

    echo '</tr><tr><th rowspan=2>REFLEC BEAT</th>'; 
    echo $this->Form->input('Game_center.reflec', $game_opt);
    echo $this->Form->input('Game_center.reflec_remark', $remark_opt);

    echo '</tr><tr><th rowspan=4>SOUND VOLTEX</th>'; 
    echo $this->Form->input('Game_center.sdvx', $game_opt);
    echo '</tr>';
    echo $this->Form->input('Game_center.sdvx_credit', $credit_opt);
    echo $this->Form->input('Game_center.sdvx_paseli', $paseli_opt);
    echo $this->Form->input('Game_center.sdvx_remark', $remark_opt);

    echo '</tr><tr><th rowspan=2>DanceEvolution</th>'; 
    echo $this->Form->input('Game_center.deac', $game_opt);
    echo $this->Form->input('Game_center.deac_remark', $remark_opt);

    echo "</tr><tr><th>投稿者$required_html</th><td>";
    echo $this->Form->input('Game_center.editor', array(
                                'label' => false,
                                'type' => 'text',
                                'format' => $format,
                                'value' => '',
                                ));
    echo _get_msg_tag('※あなたの名前（ハンドルネーム）を入力してください。<br>');
    echo _get_msg_tag('※ゲームセンター詳細画面にて、最終編集者名が表示されます。');
    echo '</td></tr></table><center>';
    if ($mode === 'exist'){
        echo $this->Form->hidden('Game_center.id');
    }
    echo $this->Form->end("登録");
    echo '</center>';
     } // end of 'new' mode
?>
