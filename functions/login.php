<?php
if (!eregi("index.php", $_SERVER['PHP_SELF']))
{
    die ("You can't access this file directly..."); 
}
echo '<span class="content-header">'.$lang['login'].'</span>';
$user = $_SESSION['user'];
$pass = $_SESSION['pass'];
$ok = mysql_fetch_array(mysql_query("SELECT * FROM `login` WHERE `userid`='$user' AND `user_pass`='$pass'"));
if(!$ok)
{
	echo '<form action="?fd=functions&nav=login" method="POST">
	<table border="0">
	<tr>
	<td>'.$lang['username'].':</td>
	<td><input name="user" type="text" id="user" /></td>
	</tr>
	<tr>
	<td>'.$lang['pass'].'</td>
	<td><input name="pass" type="password" id="pass" /></td>
	</tr>
	<tr>
	<td>'.$lang['sec_code'].'</td>
	<td>';
	$code = $func->make_security_code();
	echo '<img src="functions/image.php?code='.$code.'" />';
	echo '</td>
	</tr>
	<tr>
	<td><input name="code1" type="hidden" id="code1" value="'.$code.'" /></td>
	<td><input name="code2" type="text" id="code2" /></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td><input type="submit" name="Submit" value="'.$lang['login'].'" /></td>
	</tr>
	</table>
	</form>';
}
else
{
	echo $lang['al_log'];
}
if($_POST['Submit'])
{
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$code1 = $_POST['code1'];
	$code2 = $_POST['code2'];
	$ok = mysql_fetch_array(mysql_query("SELECT * FROM `login` WHERE `userid`='$user' AND `user_pass`='$pass'"));
	if($code1 != $code2)
	{
		echo $lang['code_err'];
	}
	elseif($ok)
	{
		$u = $_SESSION['user'] = $user;
		$p = $_SESSION['pass'] = $pass;
		if($u && $p)
		{
			echo $lang['succ_login'].' '.$_SESSION['user'].'!';
			header( 'refresh: 1; url=?nav=main' );
		}
	}
	else
	{
		echo $lang['err_login'];
	}
}
?>