<table id="sortable_list">
<thead>
<tr>
     <th>ID</th>
     <th>住所</th>
     <th>店舗名</th>
</tr>
</thead>
<tbody>
<?php
function print_td_tag($v)
{
    echo '<td>' . $v . '</td>';
}
foreach ($data as $key => $value)
{
    echo '<tr>';
    print_td_tag($value["Game_center"]["id"]);
    print_td_tag($value["Game_center"]["address"]);
    print_td_tag($value["Game_center"]["name"]);
    echo '</tr>';
}
?>
</tbody>
</table>
