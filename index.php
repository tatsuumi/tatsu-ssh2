<?php
// ssh接続して、ファイルのパーミッションをチェックするサンプル

$ok = "";
$ng = ""; 

$connection = ssh2_connect('126.71.242.179', 22);
ssh2_auth_password($connection, 'tatsuumi', 'tatsu227');

$stream = ssh2_exec($connection, 'echo `ls -l /home/tatsuumi/call.agi` | cut -d" " -f1');
$errorstream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);

stream_set_blocking($stream, true);
stream_set_blocking($errorstream, true);

$ok =  stream_get_contents($stream);
$ng =  stream_get_contents($errorstream); //エラーがあれば表示

if($ok == "-rwxrwxrwxn" && !$ng)
{
    echo "OK";
    exit();
}
echo "NG";
