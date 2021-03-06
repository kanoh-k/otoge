<?php
$base = Configure::read('url.sdvxrank') . '/history';
$mid = $music['id'];
echo $this->start('script'); ?>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load('visualization', '1.0', {'packages':['corechart']});
        google.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Date');
            data.addColumn('number', 'Hit chart');
            data.addColumn('number', 'Floor');
            data.addColumn('number', 'EXIT TUNES');
            data.addRows([
<?php
foreach ($history as $key => $value)
{
    $h = $value['hit_chart'];
    $f = $value['floor'];
    $e = $value['exit_tunes'];
    echo "['$key', $h, $f, $e],";
}
?>
                             ]);

            var options = {
            title: 'Daily ranking history',
            height: 400,
            width: 1000,
            backgroundColor: '#f6f6f6',
            vAxis: {title: 'Rank', viewWindowMode: 'explicit', viewWindow: {min: 1, max: 30}, direction: -1, gridlines: {count: 6}},
            hAxis: {title: 'Date'},
            pointSize: 5
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
}
    </script>
<?php echo $this->end(); ?>

<div id="page-title"><?php echo $music['title']; ?></div>

<div class="fixedwidth">
<div class="tab" style="text-align: right">
<ul>
<li id="week-tab" onclick=<?php echo "\"location.href='$base/$mid/week'\""?>>Week</li>
<li id="month-tab" onclick=<?php echo "\"location.href='$base/$mid/month'\""?>>Month</li>
<li id="all-tab" onclick=<?php echo "\"location.href='$base/$mid/all'\""?>>All</li>
<script type="text/javascript">$("li#" + <?php echo "'$period'"; ?> + '-tab').addClass('selected');</script>
</ul>
</div>
<div id="chart_div" style="width:1000; height:400; margin-top: 5px;"></div>
</div>