<?php
header("Content-Type: text/html; charset=UTF-8");
$cmd='df -h |grep -v Filesystem |grep -v none';
exec($cmd, $arr_h, $elv);
echo '<table class="df">';
echo '<tr>';
echo '<th class="df">FileSystem</th>';
echo '<th class="df">Size</th>';
echo '<th class="df">Used</th>';
echo '<th class="df">Avail</th>';
echo '<th class="df">Use%</th>';
echo '<th class="df">Mounted on</th>';
echo '</tr>';
foreach($arr_h as $v){
    echo '<tr>';
    $items = preg_split('/ +/', $v);
    foreach($items as $item){
        echo sprintf('<td class="df">%s</td>', $item);
    }
    echo '</tr>';
}
echo '</table>';

$cmd='df |grep -v Filesystem |grep -v none';
exec($cmd, $arr, $elv);
foreach($arr as $v){
    $items = preg_split('/ +/', $v);
    echo sprintf('<span class="detail">%dKB : %f%%</span><br/>', $items[2], $items[2] / $items[1]);
}
?>
