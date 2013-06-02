<?php
function _cap($str)
{
    if ($str == null or $str === '') return '-';
    return $str;
}

function _sanitize($str)
{
    return nl2br(Sanitize::stripScripts(Sanitize::stripImages($str)));
}


if ($have_data)
{
App::uses('Sanitize', 'Utility');
?>
<div class="narrow_detail"><table><tr><th colspan=3 class="name">
<?php echo Sanitize::stripAll($data['Game_center']['name']); ?>
</th></tr>
<tr><th>地域</th><td colspan=2>
<?php echo Sanitize::stripAll($data['Prefecture']['name']); ?></td></tr>
     <tr><th>住所</th><td colspan=2>
<?php echo Sanitize::stripAll($data['Game_center']['address']); ?></td></tr>
     <tr><th>URL</th><td colspan=2>
<?php 
     $url = Sanitize::stripAll($data['Game_center']['url']);
     echo "<a href='$url' target=_blank>$url</a>"; ?>
</td></tr>
<tr><th>備考</th><td colspan=2>
<?php echo _cap(_sanitize($data['Game_center']['remark'])); ?></td></tr>

<tr><th rowspan=2>IIDX</th><th>台数</th><td>
<?php echo _cap($data['Game_center']['iidx']); ?></td></tr>
<tr><th>備考</th><td>
<?php echo _cap(_sanitize($data['Game_center']['iidx_remark'])); ?></td></tr>

<tr><th rowspan=2>pop'n</th><th>台数</th><td> <!-- ' -->
<?php echo _cap($data['Game_center']['popn']); ?></td></tr>
<tr><th>備考</th><td>
<?php echo _cap(_sanitize($data['Game_center']['popn_remark'])); ?></td></tr>

<tr><th rowspan=2>DDR</th><th>台数</th><td>
<?php echo _cap($data['Game_center']['ddr']); ?></td></tr>
<tr><th>備考</th><td>
<?php echo _cap(_sanitize($data['Game_center']['ddr_remark'])); ?></td></tr>

<tr><th rowspan=2>GF</th><th>台数</th><td>
<?php echo _cap($data['Game_center']['guiter']); ?></td></tr>
<tr><th>備考</th><td>
<?php echo _cap(_sanitize($data['Game_center']['guiter_remark'])); ?></td></tr>

<tr><th rowspan=2>DM</th><th>台数</th><td>
<?php echo _cap($data['Game_center']['drum']); ?></td></tr>
<tr><th>備考</th><td>
<?php echo _cap(_sanitize($data['Game_center']['drum_remark'])); ?></td></tr>

<tr><th rowspan=6>jubeat</th><th>台数</th><td>
<?php echo _cap($data['Game_center']['jubeat']); ?></td></tr>
<tr><th>料金</th><td>
<?php echo _cap($data['Game_center']['jubeat_credit']); ?></td></tr>
<tr><th>曲数</th><td>
<?php echo _cap($data['Game_center']['jubeat_credit_tune']); ?></td></tr>
<tr><th>PASELI</th><td>
<?php echo _cap($data['Game_center']['jubeat_paseli']); ?></td></tr>
<tr><th>P曲数</th><td>
<?php echo _cap($data['Game_center']['jubeat_paseli_tune']); ?></td></tr>
<tr><th>備考</th><td>
<?php echo _cap(_sanitize($data['Game_center']['jubeat_remark'])); ?></td></tr>     

<tr><th rowspan=2>REFLEC</th><th>台数</th><td>
<?php echo _cap($data['Game_center']['reflec']); ?></td></tr>
<tr><th>備考</th><td>
<?php echo _cap(_sanitize($data['Game_center']['reflec_remark'])); ?></td></tr>

<tr><th rowspan=4>SDVX</th><th>台数</th><td>
<?php echo _cap($data['Game_center']['sdvx']); ?> </td></tr>
<tr><th>料金</th><td>
<?php echo _cap($data['Game_center']['sdvx_credit']); ?> 円</td></tr>
<tr><th>PASELI</th><td>
<?php echo _cap($data['Game_center']['sdvx_paseli']); ?> P</td></tr>
<tr><th>備考</th><td>
<?php echo _cap(_sanitize($data['Game_center']['sdvx_remark'])); ?></td></tr>

<tr><th rowspan=2>DEAC</th><th>台数</th><td>
<?php echo _cap($data['Game_center']['deac']); ?></td></tr>
<tr><th>備考</th><td>
<?php echo _cap(_sanitize($data['Game_center']['deac_remark'])); ?></td></tr>

<tr><th>編集者</th><td colspan=2>
<?php echo _cap($data['Game_center']['editor']); ?>　(<?php echo $data['Game_center']['modified']; ?>)</td></tr>
</table>
<?php
     /*
     echo $this->Form->create(false, array('type' => 'get', 'action' => 'edit/' . $data['Game_center']['id']));
echo $this->Form->end('編集する');
     */
?>
</div>
<?php
}
else
{
    echo '<div style="text-align:center"><br>マーカーをクリックすると<br>ここに詳細が表示されます</div>';
}
?>