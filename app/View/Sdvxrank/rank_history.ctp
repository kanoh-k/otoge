<?php
$base = Configure::read('url.sdvxrank') . '/rank_history';
$daily_base = Configure::read('url.sdvxrank') . '/daily';
$history_base = Configure::read('url.sdvxrank') . '/history';
$target_str = array(
    'hit_chart' => 'Hit chart',
    'floor' => 'Floor',
    'exit_tunes' => 'EXIT TUNES',
    );
?>

<div id="page-title"><?php echo "$target_str[$target] ${rank}位の推移" ?></div>

<div class="fixedwidth">
<div class="tab" style="text-align: right">
<ul>
<li id="week-tab" onclick=<?php echo "\"location.href='$base/$target/$rank/week'\""?>>Week</li>
<li id="month-tab" onclick=<?php echo "\"location.href='$base/$target/$rank/month'\""?>>Month</li>
<li id="all-tab" onclick=<?php echo "\"location.href='$base/$target/$rank/all'\""?>>All</li>
<script type="text/javascript">$("li#" + <?php echo "'$period'"; ?> + '-tab').addClass('selected');</script>
</ul>
</div>
<div class="ranking">
<table><tr><th>日付</th><th class="titlecol-narrow">曲名</th><th class="artistcol-narrow">アーティスト</th></tr>
<?php
foreach ($history as $date => $music)
{
    $mid = $music[$target]['id'];
    $title = $music[$target]['title'];
    $artist = $music[$target]['artist'];
    $date_url = $daily_base . "/$date";
    $history_url = $history_base . "/$mid";
    echo "<tr><td class=\"center\"><a href=\"$date_url\">$date</a></td>";
    echo "<td><a href=\"$history_url\">$title</a></td><td>$artist</td></tr>";
}
?>
</table>
</div>
</div>
