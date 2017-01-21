<?php
include("../functions.php");
$f = new func();
$f->sec();
include("../config.php");
$id = $_REQUEST['id'];
$q = mysql_query("SELECT emblem_data FROM guild WHERE emblem_id='$id'");
$r = mysql_fetch_array($q);
header("Content-type: image/bmp");
echo base64_decode($r['emblem_data']);
?>