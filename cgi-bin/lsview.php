<?php
$callback = "getFileList";
if(isset($_GET['callback'])){
    $callback=$_GET['callback'];
}
$cmd='find /var/www/torrents -type f';
exec($cmd, $fl_arr);
$cnt=0;
foreach($fl_arr as $p){
  exec("ls -lh '". $p ."'|awk '{print $5}'", $ls_arr);
  exec("du -h '". $p ."'|cut -f 1", $du_arr);
  $stack[] = array(
    "lsize" => $ls_arr[$cnt] ,
    "rsize" => $du_arr[$cnt] ,
    "fpath" => $p
  );
  $cnt++;
}
$json = json_encode($stack, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
header("Content-type: application/x-javascript; charset=UTF-8");
print <<<END
$callback($json);
END;
?>
