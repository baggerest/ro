<?php
if (!eregi("index.php", $_SERVER['PHP_SELF']))
{
    die ("You can't access this file directly..."); 
}
echo '<script language="javascript">
function tos(chck, btn_id)
{
	if(document.getElementById(chck).checked = true)
	{
		document.getElementById(btn_id).disabled = false;
	}
	else
	{
		document.getElementById(btn_id).disabled = true;
	}
}
</script>';
echo '<span class="content-header">'.$lang['reg_msg'].$config_server_name.':</span><br />';
echo '<form action="?fd=functions&nav=register" method="POST">
<table border="0">
  <tr>
    <td>'.$lang['username'].'</td>
    <td><input type="text" name="user" /></td>
  </tr>
  <tr>
    <td>'.$lang['pass'].'</td>
    <td><input type="text" name="pass" /></td>
  </tr>
  <tr>
    <td>'.$lang['email'].'</td>
    <td><input type="text" name="email" /></td>
  </tr>
  <tr>
    <td>'.$lang['gender'].'</td>
    <td>'.$lang['male'].'
      <input name="gender" type="radio" value="M" checked="checked" />
    '.$lang['female'].'
    <input name="gender" type="radio" value="F" /></td>
  </tr>
  <tr>
    <td>'.$lang['sec_code'].'</td>
    <td>';
	$code = $func->make_security_code();
	echo '<img src="functions/image.php?code='.$code.'" />';
	echo '<input type="hidden" value="'.$code.'" name="code" /></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td><input type="text" name="codeinput" /></td>
  </tr>
</table>
<div style="width: 80%; border: 1px solid silver; background-color: #F8F8F8; color: #666; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; overflow:scroll; height: 100px; margin: auto; margin-bottom: 5px;">';
if(is_readable('tos.txt'))
{
	$content = file_get_contents('tos.txt');
	$content = htmlspecialchars($content, ENT_QUOTES);
	$content = stripslashes($content);
	$content = strip_tags($content);
	$content = str_replace('
', '<br />', $content);
	echo $content;
}
else
{
	echo 'The Terms Of Service File is not avaiable.';
}
echo'</div><div align="center">
<input type="checkbox" name="checkbox" value="checkbox" id="chk" onclick="tos(\'chk\',\'send\')" />
<input type="submit" name="Submit" value="'.$lang['register'].'" id="send" disabled /></div>
</form>';
if($_POST['Submit'])
{
	$code = $_POST['code'];
	$codeinput = $_POST['codeinput'];
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$que = mysql_query("select * from login where userid='$nick' or email='$email'") ;
	$count_test = mysql_num_rows($que);
	if($code != $codeinput)
	{
		echo $lang['code_err'];
	}
	elseif(eregi("admin", $user))
	{
		echo $lang['fx_1'];
	}
	elseif(eregi("mod", $user))
	{
		echo $lang['fx_2'];
	}
	elseif(empty($user) || empty($pass) || empty($email) || empty($gender))
	{
		echo $lang['reg_err'];
	}
	elseif(!ereg("[a-z||0-9]@[a-z||0-9].[a-z]", $email))
	{
		echo $lang['reg2_err'];
	}
	elseif($count_test!= 0)
	{
		echo $lang['reg3_err'];
	}
	else
	{
		$ok = mysql_query("INSERT INTO `login` (`userid`, `user_pass`, `sex`, `email`) VALUES ('$user', '$pass', '$gender', '$email')") ;
		if($ok)
		{
			echo $lang['succ_reg'];
			header( 'refresh: 1; url=?nav=main' );
		}
		else
		{
			echo $lang['reg4_err'];
		}
	}
}
?>