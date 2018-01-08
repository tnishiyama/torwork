<?php
$callback = "getProcessList";
if(isset($_GET['callback'])){
    $callback=$_GET['callback'];
}
$cmd='ps -ef |grep ctorrent|grep -v grep';
if(isset($_GET['pid'])){
    $rmpid=$_GET['pid'];
    system('kill '.$rmpid);
    sleep(3);
}
exec($cmd, $arr, $elv);
foreach($arr as $v){
	$pid = preg_split('/ +/', $v);
	$ptn = array('/^.*\/usr\/local\/bin\/ctorrent /','/ -d -s .*$/');
	$rvs = array('','');
	$t_file = preg_replace($ptn, $rvs, $v);
        $stock[] = array(
          "pid" => $pid[1],
          "title" => $t_file
        );
}
$json = json_encode($stock, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
header("Content-type: application/x-javascript; charset=UTF-8");
print <<<END
$callback($json);
END;
?>
