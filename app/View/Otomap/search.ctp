<div id="page-title">全機種検索</div>
<?php
App::uses('Sanitize', 'Utility');  
function _sanit($str)
{
    return str_replace("'", "\'", Sanitize::stripAll($str));
}

if ($have_data and count($list) > 0)
{
    $url_detail = Configure::read('url.detail') . '/';
    $url_ndetail = Configure::read('url.narrow_detail') . '/';

    if ($display === 'list')
    {

        $this->start('script'); ?>
        <script type="text/javascript">
        //<![CDATA[
            $(function () {
                    $('#sortable_list').tablesorter();
                });
        //]]>
        </script>
<?php              
        $this->end();
        echo $this->element('search_form');
?>
<div id="search_result">
<b><?php echo count($list); ?></b>
件のゲームセンターが見つかりました。</div>
<table id="sortable_list">
<thead>
<tr>
<?php if ($mode === 'sdvx') { ?>
     <th>店舗名</th>
     <th>都道府県</th>
     <th>住所</th>
     <th>SDVX</th>
     <th>料金</th>
     <th>PASELI</th>
     <th>営業時間</th>
<?php }else{ ?> 
     <th>店舗名</th>
     <th>都道府県</th>
     <th>住所</th>
     <th>IIDX</th>
     <th>pop'n</th> <!--' trick php-mode -->
     <th>DDR</th>
     <th>GF</th>
     <th>DM</th>
     <th>jubeat</th>
     <th>Reflec</th>
     <th>SDVX</th>
     <th>DEAC</th>
     <th>営業時間</th>

<?php } ?>
</tr>
</thead>
<tbody>
<?php
function _print_td_tag($v, $a = NULL)
{
    if ($a === 'c')
    {
        echo '<td class=center>';
    }else if ($a === 'r')
    {
        echo '<td class=right>';
    }else{
        echo '<td>';
    }
        
    echo $v . '</td>';
}

function _format_time($str)
{
    if ($str)
    {
        $t = strtotime($str);
        return date("H:i", $t);
    }
    return '';
}

if ($mode === 'sdvx')
{
    foreach ($list as $key => $value)
    {
        echo '<tr>';
        $a_open = '<a href="' . $url_detail . $value['Game_center']['id'] . '">';
        _print_td_tag($a_open . Sanitize::stripAll($value["Game_center"]["name"]) . '</a>');
        _print_td_tag($value["Prefecture"]["name"]);
        _print_td_tag(Sanitize::stripAll($value["Game_center"]["address"]));
        _print_td_tag($value["Game_center"]["sdvx"], 'r');
        _print_td_tag($value["Game_center"]["sdvx_credit"], 'r');
        _print_td_tag($value["Game_center"]["sdvx_paseli"], 'r');
        _print_td_tag(_format_time($value["Game_center"]["start_time"]) . ' - ' . _format_time($value["Game_center"]["end_time"]), 'c');
        echo '</tr>';
    }

}
else // $mode === 'all'
{
    foreach ($list as $key => $value)
    {
        echo '<tr>';
        $a_open = '<a href="' . $url_detail . $value['Game_center']['id'] . '">';
        _print_td_tag($a_open . Sanitize::stripAll($value["Game_center"]["name"]) . '</a>');
        _print_td_tag($value["Prefecture"]["name"]);
        _print_td_tag(Sanitize::stripAll($value["Game_center"]["address"]));
        _print_td_tag($value["Game_center"]["iidx"], 'r');
        _print_td_tag($value["Game_center"]["popn"], 'r');
        _print_td_tag($value["Game_center"]["ddr"], 'r');
        _print_td_tag($value["Game_center"]["guiter"], 'r');
        _print_td_tag($value["Game_center"]["drum"], 'r');
        _print_td_tag($value["Game_center"]["jubeat"], 'r');
        _print_td_tag($value["Game_center"]["reflec"], 'r');
        _print_td_tag($value["Game_center"]["sdvx"], 'r');
        _print_td_tag($value["Game_center"]["deac"], 'r');
        _print_td_tag(_format_time($value["Game_center"]["start_time"]) . ' - ' . _format_time($value["Game_center"]["end_time"]), 'c');
        echo '</tr>';
    }
}
?>
</tbody>
</table>
<?php
      } /* end of $display === 'list' */
    else if ($display === 'map')
    {
        App::uses('Sanitize', 'Utility');

        /* Count displayed game centers */
        $displayed = 0;
        foreach ($list as $key => $value)
        {
            if (isset($value['Game_center']['latlng']) and strlen($value['Game_center']['latlng']) > 0)
                $displayed += 1;
        }
        
        /* Set initial center of google maps */
        if ($this->data['prefecture'])
            $init_latlng = $id2latlng[$this->data['prefecture']];
        else
            $init_latlng = $id2latlng['13'];
        foreach ($list as $key => $value) // Find first latlng
        {
            if (isset($value['Game_center']['latlng']) and strlen($value['Game_center']['latlng']) > 0)
            {
                $init_latlng = _sanit($value['Game_center']['latlng']);
                break;
            }
        }
        

        /* Get information for InfoWindow of Google Maps */
        function _get_info($value)
        {
            $ret = '<table><tr><th>';
            $ret .= _sanit($value['Game_center']['name']);
            $ret .= '</th></tr>';
            $ret .= '<tr><td>';
            $ret .= _sanit($value['Game_center']['address']);
            $ret .= '</td></tr></table>';
            return $ret;
        }

        $this->start('script');
?>
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCU6pAmPcdMPPBdL6rGlXMvNisLIMP8BTw&sensor=false">
    </script>
    <script type="text/javascript">
    //<![CDATA[
        var map;
        var currentWindow = null;
        function initialize() {
            adjustCSS();
            createMaps();
            <?php
            foreach ($list as $key => $value)
            {
                if (isset($value['Game_center']['latlng']) and strlen($value['Game_center']['latlng']) > 0)
                {
                    echo "setMarker(" . $value['Game_center']['latlng'] . ", " . $value['Game_center']['id'] . ", '" . _get_info($value) . "');";
                }
            }
            ?>
        }
        function createMaps() {
            var mapOptions = {
            center: new google.maps.LatLng(<?php echo $init_latlng; ?>),
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

        }
        function showDetail(id) {
            $("iframe#detail_frame").attr("src", <?php echo "'$url_ndetail'"; ?> + String(id));
        }
        window.onload = initialize;
        window.onresize = adjustCSS;
        //]]>
    </script>
<?php
        $this->end();
        
        echo $this->element('search_form');
        
        echo '<table><tr><td>';
        echo '<div id="search_result"><b>' . count($list) . '</b>件のゲームセンターが見つかりました。<br>';
        echo "うち<b>$displayed</b>件を地図に表示しています。</div>";
        echo '<iframe id="detail_frame" name="dframe" seamless src="';
        echo $url_ndetail . '"></iframe></td><td><div id="map_canvas"></div></td></tr></table>';

    }
} /* end of $have_data branch */
else
{ // No search result
    echo $this->element('search_form');
    echo '<div style="text-align:center; color: red;">該当店舗が見つかりませんでした</div>';
}


?>