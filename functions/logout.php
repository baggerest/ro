<?php
if (!eregi("index.php", $_SERVER['PHP_SELF']))
{
    die ("You can't access this file directly..."); 
}
echo '<span class="content-header">'.$lang['exit'].'</span>';
$user = $_SESSION['user'];
$pass = $_SESSION['pass'];
$ok = mysql_fetch_array(mysql_query("SELECT * FROM `login` WHERE `userid`='$user' AND `user_pass`='$pass'"));
if(!$ok)
{
	echo $lang['nologout'];
}
else
{
	session_start(); 
	$_SESSION['user'] = $user;
	$_SERVER['pass'] = $pass;
	session_unregister('user');
	session_unregister('pass');
	session_destroy();
	echo $lang['logout'];
	header( 'refresh: 1; url=?nav=main' );
}
?>