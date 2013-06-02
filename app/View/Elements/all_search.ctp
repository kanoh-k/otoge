<div class="search-form">
<table><tr><td>
<table>
<tr><th>全般</th><td colspan=9>
<?php
$options = array(
    'action' => 'search',
    'type' => 'text',
    );

echo $this->Form->create(false, array(
                             'type' => 'post',
                             'action' => 'search',
                             ));
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
echo '<tr><th rowspan=2>機種の台数</th><td>IIDX</td><td>pop\'n</td><td>DDR</td><td>GF</td><td>DM</td><td>jubeat</td><td>REFLEC</td><td>SDVX</td><td>DEAC</td></tr>';
echo '<tr>';
$options = array(
    'before' => '<td>',
    'after' => '</td>',
    'label' => false,
    'type' => 'number',
    'div' => false,
    'class' => 'narrow-num',
    'min' => 0,
    'max' => 99,
    );
echo $this->Form->input('iidx', $options);
echo $this->Form->input('popn', $options);
echo $this->Form->input('ddr', $options);
echo $this->Form->input('guiter', $options);
echo $this->Form->input('drum', $options);
echo $this->Form->input('jubeat', $options);
echo $this->Form->input('reflec', $options);
echo $this->Form->input('sdvx', $options);
echo $this->Form->input('deac', $options);

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
                            ));
echo '</td></tr></table></td><td>';
echo $this->Form->end('検索');
?>
</td></tr></table>
</div>