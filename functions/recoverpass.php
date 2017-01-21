<?php
if (!eregi("index.php", $_SERVER['PHP_SELF']))
{
    die ("You can't access this file directly..."); 
}
echo '<span class="content-header">'.$lang['recover_pass_1'].'</span>';
echo '<form action="?fd=functions&nav=recoverpass" method="post">
<table border="0">
<tr>
<td>'.$lang['username'].'</td>
<td><input name="user" type="text" id="user" /></td>
</tr>
<tr>
<td>'.$lang['email'].'</td>
<td><input name="email" type="text" id="email" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="'.$lang['recover_pass_2'].'" /></td>
</tr>
</table>
</form>';
if($_POST['Submit'])
{
	$user = $_POST['user'];
	$email = $_POST['email'];
	$query = mysql_query("SELECT `user_pass` FROM `login` WHERE `email`='$email' AND `userid`='$user'");
	$r = mysql_fetch_array($query);
	if($r)
	{
		$message = $lang['recover_pass_5'].$r['user_pass'];
		$ok = mail($email, $config_server_name.' Password', $message);
		if($ok)
		{
			echo $lang['recover_pass_4'];
		}
		else
		{
			echo $lang['char_text_35'];
		}
	}
	else
	{
		echo $lang['recover_pass_3'];
	}
}
?>