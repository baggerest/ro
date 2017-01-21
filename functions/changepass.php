<?php
if (!eregi("index.php", $_SERVER['PHP_SELF']))
{
    die ("You can't access this file directly..."); 
}
$user = $_SESSION['user'];
$pass = $_SESSION['pass'];
$ok = mysql_fetch_array(mysql_query("SELECT * FROM `login` WHERE `userid`='$user' AND `user_pass`='$pass'"));
if($ok)
{
	echo '<span class="content-header">'.$lang['change_pass_1'].'</span>';
	echo '<form action="?fd=functions&nav=changepass" method="post">
	<table border="0">
	<tr>
	<td>'.$lang['username'].'</td>
	<td><input name="user" type="text" id="user" /></td>
	</tr>
	<tr>
	<td>'.$lang['change_pass_3'].'</td>
	<td><input name="pass1" type="password" id="pass1" /></td>
	</tr>
	<tr>
	<td>'.$lang['change_pass_4'].'</td>
	<td><input name="pass2" type="password" id="pass2" /></td>
	</tr>
	</table>
	<input type="submit" name="Submit" value="'.$lang['change_pass_2'].'" />
	</form>';
	if($_POST['Submit'])
	{
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		$user = $_POST['user'];
		$check = $func->check_user($user, $pass1);
		if($check)
		{
			$ok = mysql_query("UPDATE `login` SET `user_pass`='$pass2' WHERE `userid`='$user'");
			if($ok)
			{
				echo $lang['change_pass_6'];
				header( 'refresh: 1; url=?nav=main' );
			}
			else
			{
				echo $lang['char_text_35'];
			}
		}
		else
		{
			echo $lang['change_pass_5'];
		}
	}
}
else
{
	echo $lang['char_err1'];
}
?>