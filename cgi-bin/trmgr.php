<?php
$uploaddir = '/var/www/torrents/';
$uploadfile = $uploaddir . basename($_FILES['torrentfile']['name']);
$targetfile = str_replace('.torrent', '', $uploadfile);
$linkedpath = str_replace('/var/www', '', $targetfile);

if (move_uploaded_file($_FILES['torrentfile']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.<br/>";
    echo '/usr/local/bin/ctorrent "'.$uploadfile.'" -d -s "'.$targetfile.'"<br/>';
    exec('/usr/local/bin/ctorrent "'.$uploadfile.'" -d -s "'.$targetfile.'"');
    echo '<a href="'.$linkedpath.'">'.$linkedpath.'</a>';
} else {
    echo "Possible file upload attack!<br/>";
}

echo '<pre>';
echo 'Here is some more debugging info:';
print_r($_FILES);

print "</pre>";
?>
