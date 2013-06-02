<div class="search-form">
<table><tr><td>
<div class="search-form-tab"><ul>
<li class="all-tab selected" onclick="changeSearchForm('all')">全機種検索</li>
<li class="sdvx-tab" onclick="changeSearchForm('sdvx')">SDVX検索</li>
</ul></div>
</td></tr><tr><td>
<div class="search-form-main">
<?php
// 
/* all search start */
echo '<div class="all-search">';
echo $this->Form->create(false, array(
                             'type' => 'post',
                             'action' => 'search/all',
                             ));
echo '<table><tr><td><table><tr><th>全般</th><td colspan=9>';
echo $this->Form->input('prefecture', array(
                            'label' => "都道府県",
                            'options' => $id2pref,
                            'after' => ' ',
                            'div' => null,
                            'id' => 'all_pref',
                            ));
echo $this->Form->input('name', array(
                            'label' => '店舗名',
                            'type' => 'text',
                            'div' => null,
                            'after' => ' ',
                            'class' => 'narrow-text',
                            'id' => 'all_name',
                            ));
echo $this->Form->input('address', array(
                            'label' => '住所',
                            'type' => 'text',
                            'div' => null,
                            'class' => 'narrow-text',
                            'id' => 'all_address',
                            ));

echo '</td></tr>';

echo '<tr><th rowspan=2>機種の台数</th><td>IIDX</td><td>pop\'n</td><td>DDR</td><td>GF</td><td>DM</td><td>jubeat</td><td>REFLEC</td><td>SDVX</td><td>DEAC</td></tr>';
echo '<tr>';
$game_options = array(
    'before' => '<td>',
    'after' => '</td>',
    'label' => false,
    'type' => 'number',
    'div' => false,
    'class' => 'narrow-num',
    'min' => 0,
    'max' => 99,
    );
echo $this->Form->input('iidx', $game_options + array('id' => 'all_iidx'));
echo $this->Form->input('popn', $game_options + array('id' => 'all_popn'));
echo $this->Form->input('ddr', $game_options + array('id' => 'all_ddr'));
echo $this->Form->input('guiter', $game_options + array('id' => 'all_guiter'));
echo $this->Form->input('drum', $game_options + array('id' => 'all_drum'));
echo $this->Form->input('jubeat', $game_options + array('id' => 'all_jubeat'));
echo $this->Form->input('reflec', $game_options + array('id' => 'all_reflec'));
echo $this->Form->input('sdvx', $game_options + array('id' => 'all_sdvx'));
echo $this->Form->input('deac', $game_options + array('id' => 'all_deac'));

echo '</tr>';
echo '<tr><th>検索結果</th><td colspan=9>';

if (isset($this->data['display']) and $this->data['display'] === 'map')
    $radio_init = 'map';
else
    $radio_init = 'list';

echo $this->Form->input('display', array(
                            'type' => 'radio',
                            'legend' => false,
                            'options' => array(
                                'list' => '一覧表示',
                                'map' => '地図で表示',
                                ),
                            'value' => $radio_init,
                            'id' => 'all_disp',
                            ));
echo '</td></tr></table></td><td>';
echo $this->Form->submit('検索');
echo '</td></tr></table>';
echo $this->Form->end();
echo '</div>';
/* all search end */
/* sdvx search start */
echo '<div class="sdvx-search invisible">';
echo $this->Form->create(false, array(
                             'type' => 'post',
                             'action' => 'search/sdvx',
                             ));
echo '<table><tr><td><table><tr><th>全般</th><td colspan=5>';
echo $this->Form->input('prefecture', array(
                            'label' => "都道府県",
                            'options' => $id2pref,
                            'after' => ' ',
                            'div' => null,
                            ));
echo $this->Form->input('name', array(
                            'label' => '店舗名',
                            'type' => 'text',
                            'div' => null,
                            'after' => ' ',
                            'class' => 'narrow-text',
                            ));
echo $this->Form->input('address', array(
                            'label' => '住所',
                            'type' => 'text',
                            'div' => null,
                            'class' => 'narrow-text',
                            ));

echo '</td></tr>';

echo '<tr><th>台数</th><td>';
$game_options = array(
    'label' => false,
    'type' => 'number',
    'div' => false,
    'class' => 'narrow-num',
    'min' => 1,
    'max' => 99,
    );
$credit_options = array(
    'label' => false,
    'type' => 'number',
    'div' => false,
    'class' => 'narrow-num',
    'min' => 0,
    'max' => 999,
    );
echo $this->Form->input('sdvx', $game_options);

echo '台以上</td><th>1プレイ</th><td>';
echo $this->Form->input('sdvx_credit', $credit_options);
echo '円以下</td><th>PASELI</th><td>';
echo $this->Form->input('sdvx_paseli', $credit_options);
echo 'P以下</td></tr>';
echo '<tr><th>検索結果</th><td colspan=5>';

if (isset($this->data['display']) and $this->data['display'] === 'map')
    $radio_init = 'map';
else
    $radio_init = 'list';

echo $this->Form->input('display', array(
                            'type' => 'radio',
                            'legend' => false,
                            'options' => array(
                                'list' => '一覧表示',
                                'map' => '地図で表示',
                                ),
                            'value' => $radio_init,
                            ));
echo '</td></tr></table></td><td>';
echo $this->Form->submit('検索');
echo '</td></tr></table>';
echo $this->Form->end();
echo '</div>';
/* sdvx search end */
?>
</div></td></tr></table></div>
