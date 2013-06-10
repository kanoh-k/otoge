<div id="page-title">SOUND VOLTEX ヒットチャート</div>

<div class="ranking">
<?php
foreach($data as $key => $value)
{
    echo $value['Sdvxrank_hit_chart']['ranking_date'];
    echo $value['Sdvxrank_hit_chart']['rank'];
    echo $value['Music']['title'];
    echo '<br>';
}
?>
</div>