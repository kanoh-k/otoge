<div id="page-title">SOUND VOLTEX ヒットチャート</div>

<div class="calender">
<?php
echo $this->start('script');
echo <<< EOS
<script type="text/javascript">
     $(function(){
             　$("#datepicker").datepicker({
                         dateFormat: "yy-mm-dd",
                         minDate: "$oldest",
                         maxDate: "$latest",
                         });
         });
</script>
EOS;
echo $this->end();
echo $this->Form->create(false, array('type'=>'post', 'action'=>'daily'));
echo $this->Form->input('date', array(
                       'id' => 'datepicker',
                       'div' => false,
                       'label' => '日付を選択してください：',
                       'size' => 8,
                       ));
echo $this->Form->end(array('label'=>'日付変更', 'div'=>false));
?>
</div>
<div class="ranking">
<h3 style="text-align:center"><?php echo $date; ?>のランキング</h3>
<table><tr><th colspan=3>全てのカテゴリ</th></tr>
<tr><th>順位</th><th class="titlecol">曲名</th><th class="artistcol">アーティスト</th></tr>
<?php
foreach($hit_chart as $key => $value)
{
    $history = 'history/' . $value['Sdvxrank_hit_chart']['music_id'];
    echo '<tr><td class="center">' . $value['Sdvxrank_hit_chart']['rank'] . '</td>';
    echo "<td><a href='$history'>" . $value['Music']['title'] . '</a></td>';
    echo '<td>' . $value['Music']['artist'] . '</td></tr>';

}
?>
</table>

<table><tr><th colspan=3>Floor</th></tr>
<tr><th>順位</th><th class="titlecol">曲名</th><th class="artistcol">アーティスト</th></tr>
<?php
foreach($floor as $key => $value)
{
    $history = 'history/' . $value['Sdvxrank_floor']['music_id'];
    echo '<tr><td class="center">' . $value['Sdvxrank_floor']['rank'] . '</td>';
    echo "<td><a href='$history'>" . $value['Music']['title'] . '</a></td>';
    echo '<td>' . $value['Music']['artist'] . '</td></tr>';

}
?>
</table>

<table><tr><th colspan=3>EXIT TUNES</th></tr>
<tr><th>順位</th><th class="titlecol">曲名</th><th class="artistcol">アーティスト</th></tr>
<?php
foreach($exit_tunes as $key => $value)
{
    $history = 'history/' . $value['Sdvxrank_exit_tunes']['music_id'];
    echo '<tr><td class="center">' . $value['Sdvxrank_exit_tunes']['rank'] . '</td>';
    echo "<td><a href='$history'>" . $value['Music']['title'] . '</a></td>';
    echo '<td>' . $value['Music']['artist'] . '</td></tr>';

}
?>
</table>
</div>

<div class="notification">
<h3>お知らせ</h3>
<p>6/5-6/7のデータと、6/10のFLOORおよびEXIT TUNESのデータが保存できておりません。<br>もしデータをお持ちの方がいらっしゃいましたら、<a href="https://twitter.com/kanoh_k">@kanoh_k</a>まで連絡いただけると幸いです。</p>
</div>