<?php
//////////////////////////////////////////////////////////////
// Ragnarok Online Control Panel - Kuraun CP                //
// Version: v1.1 (2010/11/21)                               //
// 源碼來源: Federico Ram甏ez (fedekiller - www.php4all.org)//
// 源碼源檔: BlackRO                                        //
// 漢化:Kuraun (Kuraun技術流 - Kuraun.uni.cc                //
// 技術支援:Kuraun (Kuraun技術流 - Kuraun.uni.cc            //
// 分站:http://blog.yam.com/kuraun							//
// 更新支援:Kuraun (Kuraun技術流 - Kuraun.uni.cc            //
// 分站:http://blog.yam.com/kuraun							//
// 風格支援:Kuraun (Kuraun技術流 - Kuraun.uni.cc            //
// 分站:http://blog.yam.com/kuraun							//
// RO私服相關漢化,模擬器漢化,腳本漢化 Kuraun.uni.cc         //
// 分站:http://blog.yam.com/kuraun							//
//////////////////////////////////////////////////////////////
ob_start();
session_start();
include("config.php");
if($config_gzip == true)
{
	ob_start("ob_gzhandler");
}
if($config_debug_mode == true)
{
	error_reporting(E_ALL ^ E_NOTICE);
}
else
{
	error_reporting(null);
}
include("functions.php");
$func = new func();
$func->sec();
$language_include = include('languages/'.$config_language.'.php');
if(!$language_include)
{
	die('語系檔錯誤，您沒有 languages/'.$config_language.'.php<br />請再次確認!');
}
$chosen_template = $_COOKIE['template'];
if(!empty($_COOKIE['template']))
{
	$temp = $_COOKIE['template'];
}
else
{
	$temp = 'Our Ro';
}
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>'.$config_site_title.'</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />';

echo '<link rel="stylesheet" href="templates/'.$temp.'/style.css" type="text/css" />';
echo '</head>
<body>
<div id="all">
<div id="header">
<div id="header-sep"></div>
<div id="header-status"><br />
<br />
<br />
<strong>伺服器狀態:</strong><br />
<br />';
foreach($config_server_port as $k => $v)
{
	$func->server_status($config_server_ip, $v, $k);
}
echo '<br />';
echo '<strong>'.$lang['usr_online'].':</strong> '.$func->users_online();
echo '</div>
</div>
<div id="maincontent">
<div id="menu"><span class="menu-header">'.$lang['menu_title'].'</span>';
foreach($lang_menu as $k => $v)
{
	echo $v;
}
if(isset($_SESSION['user']) && isset($_SESSION['pass']))
{
	$ok = mysql_fetch_array(mysql_query("SELECT * FROM `login` WHERE `userid`='$user' AND `user_pass`='$pass'"));
	if($ok)
	{
		echo '<br /><span class="menu-header">'.$lang['menu_personal'].'</span>';
		foreach($lang_personal_menu as $k => $v)
		{
			echo $v;
		}
	}
}
echo '</div>
<div id="sep">&nbsp;</div>
<div id="content">';
if(isset($_GET['fd']) && isset($_GET['nav']) && file_exists($_GET['fd'].'/'.$_GET['nav'].".php"))
{
	include ($_GET['fd']."/".$_GET['nav'].".php");
}
else if(isset($_GET['nav']) && file_exists($_GET['nav'].".php"))
{
	include ($_GET['nav'].".php");
}
else if (empty($_GET['nav']))
{
	include("main.php");
}
else
{
	echo $lang['404'];
}
echo '</div>
</div>
<div id="footer"><br />
<br />
<br />
<br />
<br />
<span class="copyright">';

	echo $lang['copyright'];

echo '</span></div>
</div>
</body>
</html>';
ob_end_flush();
?>