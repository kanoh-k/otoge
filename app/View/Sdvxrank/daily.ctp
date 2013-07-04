<?php
$base = Configure::read('url.sdvxrank');
$table_title = array(
    'hit_chart' => 'ヒットチャート',
    'floor' => 'Floorランキング',
    'exit_tunes' => 'EXIT_TUNESランキング',
    );
?>
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
echo $this->Form->hidden('target', array('value' => $target));
echo $this->Form->end(array('label'=>'日付変更', 'div'=>false));
?>
</div>
<div class="ranking">
<h3 style="text-align:center"><?php echo $date; ?>の<?php echo $table_title[$target]; ?></h3>
<div class="tab" style="text-align: right">
<ul>
<li id="hit_chart-tab" onclick=<?php echo "\"location.href='$base/$target/$date'\""?>>Hit chart</li>
<li id="floor-tab" onclick=<?php echo "\"location.href='$base/$target/$date'\""?>>Floor</li>
<li id="exit_tunes-tab" onclick=<?php echo "\"location.href='$base/$target/$date'\""?>>EXIT TUNES</li>
<script type="text/javascript">$("li#" + <?php echo "'$target'"; ?> + '-tab').addClass('selected');</script>
</ul>
</div>
<table><tr><th>順位</th><th class="titlecol">曲名</th><th class="artistcol">アーティスト</th></tr>
<?php
foreach($ranking as $key => $value)
{
    $rank_history = $base . "/rank_history/$target/" . $value["Sdvxrank_$target"]['rank'];
    $history = "$base/history/" . $value["Sdvxrank_$target"]['music_id'];
    echo "<tr><td class='center'><a href='$rank_history'>" . $value["Sdvxrank_$target"]['rank'] . '</a></td>';
    echo "<td><a href='$history'>" . $value['Music']['title'] . '</a></td>';
    echo '<td>' . $value['Music']['artist'] . '</td></tr>';

}
?>
</table>
</div>

<div class="notification">
<h3>お知らせ</h3>
<ul>
<li>
2013年の6/5-6/7のデータと、6/10のFLOORおよびEXIT TUNESのデータが保存できておりません。もしデータをお持ちの方がいらっしゃいましたら、<a href="https://twitter.com/kanoh_k">@kanoh_k</a>まで連絡いただけると幸いです。
</li>
<li>
以前は公式サイトで20位のデータまでしか公開されていなかったため、2013/07/04以前のデータについては21位～30位のデータは保存されておりません。
</li>
</ul>
</div>