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
if (!eregi("index.php", $_SERVER['PHP_SELF']))
{
    die ("You can't access this file directly..."); 
}

$config_sql_host = '127.0.0.1'; // Sql Host Name 資料庫IP (必須和私服設定相同) 默認:127.0.0.1 
$config_sql_user = 'baggerest'; // Sql Username 資料庫帳號 (必須和私服設定相同)
$config_sql_pass = '0936970907'; // Sql Password 資料庫密碼 (必須和私服設定相同)
$config_sql_db = 'ragnarok'; // Sql Database Name 資料庫名稱 (必須和私服設定相同)
mysql_connect($config_sql_host, $config_sql_user, $config_sql_pass) or die ($lang['con_error']);
mysql_select_db($config_sql_db);
$config_language = 'chinese'; // 語系檔 目前僅支援繁體中文(BIG5)
$config_server_name = 'Kuraun 私服'; //伺服器名稱
$config_site_title = 'Kuraun 私服註冊網頁'; // 網站標題
$config_data_download_1 = 'http://127.0.0.1'; //私服補丁網址1 請務必加上http://
//$config_data_download_2 = 'http://127.0.0.1'; //私服補丁網址2 (需要使用請把 // 去除)
//$config_data_download_3 = 'http://127.0.0.1'; //私服補丁網址3 (需要使用請把 // 去除)
//$config_data_download_4 = 'http://127.0.0.1'; //私服補丁網址4 (需要使用請把 // 去除)
$config_server_ip = '127.0.0.1'; // no-ip or numeric ip 私服ip
$config_server_port['Login'] = '6900'; // Login Server Port **請勿更動
$config_server_port['Char'] = '6121'; // Char Server Port **請勿更動
$config_server_port['Map'] = '5121'; // Map Server Port  **請勿更動
$config_gzip = true; // Allow GZIP. Change to false to deny it.
$config_gzip_lvl = '6'; // Level of compression for html, Max lvl 9.
$config_debug_mode = false; // Debug mode

?>