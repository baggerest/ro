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
	echo '<form action="?fd=functions&nav=changetemplate" method="post">
	<select name="template">';
	if ($opendir = opendir('templates/'))
	{
		while (false !== ($files = readdir($opendir)))
		{
			if ($files != "." && $files != "..")
			{
				echo "<option value=\"$files\">$files</option>";
			}
		}
	}
	closedir($opendir);
	echo '</select>
	<input type="submit" name="Submit" value="'.$lang['change_pass_2'].'">
	</form>';
	$showstyle = $_COOKIE['template'];
	if(empty($showstyle))
	{
		$showstyle = 'Our Ro';
	}
	echo $lang['template_change_2'].': '.$showstyle; 
	if($_POST['Submit'])
	{
		$style = $_POST['template'];
		setcookie('template',$style,time()+3600000);
		echo '<br />'.$lang['template_change_3'].' '.$style.'...';
		header( 'refresh: 1; url=?nav=main' );
	}
}
else
{
	echo $lang['char_err1'];
}
?>