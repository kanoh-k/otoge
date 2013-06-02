<div id="page-title">詳細情報</div>
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
<div class="detail"><table><tr><th class="name" colspan=7>
<?php echo Sanitize::stripAll($data['Game_center']['name']); ?>
</th></tr>
<tr><th>都道府県</th><td>
<?php echo Sanitize::stripAll($data['Prefecture']['name']); ?></td>
     <th>住所</th><td colspan=4>
<?php echo Sanitize::stripAll($data['Game_center']['address']); ?></td></tr>
     <tr><th>URL</th><td colspan=6>
<?php 
     $url = Sanitize::stripAll($data['Game_center']['url']);
     echo "<a href='$url' target=_blank>$url</a>"; ?>
</td></tr>
<tr><th>備考</th><td colspan=6>
<?php echo _cap(_sanitize($data['Game_center']['remark'])); ?></td></tr>

<tr><th rowspan=2>beatmania IIDX</th><th>台数</th><td>
<?php echo _cap($data['Game_center']['iidx']); ?></td>
<th></th><td></td><th></th><td></td></tr>
<tr><th>備考</th><td colspan=5>
<?php echo _cap(_sanitize($data['Game_center']['iidx_remark'])); ?></td></tr>


<tr><th rowspan=2>pop'n music</th><th>台数</th><td> <!-- ' -->
<?php echo _cap($data['Game_center']['popn']); ?></td>
<th></th><td></td><th></th><td></td></tr>
<tr><th>備考</th><td colspan=5>
<?php echo _cap(_sanitize($data['Game_center']['popn_remark'])); ?></td></tr>


<tr><th rowspan=2>DDR</th><th>台数</th><td>
<?php echo _cap($data['Game_center']['ddr']); ?></td>
<th></th><td></td><th></th><td></td></tr>
<tr><th>備考</th><td colspan=5>
<?php echo _cap(_sanitize($data['Game_center']['ddr_remark'])); ?></td></tr>


<tr><th rowspan=2>GuiterFreaks</th><th>台数</th><td>
<?php echo _cap($data['Game_center']['guiter']); ?></td>
<th></th><td></td><th></th><td></td></tr>
<tr><th>備考</th><td colspan=5>
<?php echo _cap(_sanitize($data['Game_center']['guiter_remark'])); ?></td></tr>


<tr><th rowspan=2>DrumMania</th><th>台数</th><td>
<?php echo _cap($data['Game_center']['drum']); ?></td>
<th></th><td></td><th></th><td></td></tr>
<tr><th>備考</th><td colspan=5>
<?php echo _cap(_sanitize($data['Game_center']['drum_remark'])); ?></td></tr>


<tr><th rowspan=3>jubeat</th><th>台数</th><td>
<?php echo _cap($data['Game_center']['jubeat']); ?></td>
<th>料金</th><td>
<?php echo _cap($data['Game_center']['jubeat_credit']); ?></td><th>曲数</th><td>
<?php echo _cap($data['Game_center']['jubeat_credit_tune']); ?></td></tr>
<th></th><td></td><th>PASELI/曲</th><td>
<?php echo _cap($data['Game_center']['jubeat_paseli']); ?></td><th>PASELI曲数</th><td>
<?php echo _cap($data['Game_center']['jubeat_paseli_tune']); ?></td></tr>
<tr><th>備考</th><td colspan=5>
<?php echo _cap(_sanitize($data['Game_center']['jubeat_remark'])); ?></td></tr>     

<tr><th rowspan=2>REFLEC BEAT</th><th>台数</th><td>
<?php echo _cap($data['Game_center']['reflec']); ?></td>
<th></th><td></td><th></th><td></td></tr>
<tr><th>備考</th><td colspan=5>
<?php echo _cap(_sanitize($data['Game_center']['reflec_remark'])); ?></td></tr>


<tr><th rowspan=2>SOUND VOLTEX</th><th>台数</th><td>
<?php echo _cap($data['Game_center']['sdvx']); ?> </td>
<th>料金</th><td>
<?php echo _cap($data['Game_center']['sdvx_credit']); ?> 円</td>
<th>PASELI</th><td>
<?php echo _cap($data['Game_center']['sdvx_paseli']); ?> P</td></tr>
<tr><th>備考</th><td colspan=5>
<?php echo _cap(_sanitize($data['Game_center']['sdvx_remark'])); ?></td></tr>

<tr><th rowspan=2>DanceEvolution</th><th>台数</th><td>
<?php echo _cap($data['Game_center']['deac']); ?></td>
<th></th><td></td><th></th><td></td></tr>
<tr><th>備考</th><td colspan=5>
<?php echo _cap(_sanitize($data['Game_center']['deac_remark'])); ?></td></tr>

<tr><th>最終編集者</th><td colspan=6>
<?php echo _cap($data['Game_center']['editor']); ?>　(<?php echo $data['Game_center']['modified']; ?>)</td></tr>
</table>
<?php
     echo $this->Form->create(false, array('type' => 'get', 'action' => 'edit/' . $data['Game_center']['id']));
echo '<center>';
echo $this->Form->end('編集する');
echo '</center>';

?>
</div>
<?php
}
else
{
    echo 'データが存在しません';
}
?>