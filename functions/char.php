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
	switch($_GET['get'])
	{
		default:
		echo '<span class="content-header">'.$lang['char_text_6'].'</span>
		<a href="?fd=functions&nav=char&get=slot">'.$lang['char_text_1'].'</a><br />
		<a href="?fd=functions&nav=char&get=editstyle">'.$lang['char_text_2'].'</a><br />
		<a href="?fd=functions&nav=char&get=unstuck">'.$lang['char_text_4'].'</a><br />
		<a href="?fd=functions&nav=char&get=transfer">'.$lang['char_text_5'].'</a><br />
		<a href="?fd=functions&nav=char&get=see">'.$lang['char_text_7'].'</a>';
		break;
		case 'see':
		$user = $_SESSION['user'];
		$pass = $_SESSION['pass'];
		$q1 = mysql_query("SELECT `account_id` FROM `login` WHERE `userid`='$user' AND `user_pass`='$pass'");
		$r1 = mysql_fetch_array($q1);
		if($r1)
		{
			$id = $r1['account_id'];
			$query = mysql_query("SELECT * FROM `char` WHERE account_id='$id'");
			$check = mysql_num_rows($query);
			if($check == 0)
			{
				echo $lang['char_text_9'];
			}
			else
			{
				while($r = mysql_fetch_array($query))
				{
					echo 'Slot: '.$r['char_num'].'<br />
					Name: '.$r['name'].'<br />
					Base Level: '.$r['base_level'].'<br />
					Job Level: '.$r['job_level'].'<br />
					Base Exp: '.$r['base_exp'].'<br />
					Job Exp: '.$r['job_exp'].'<br />
					Zeny: '.$r['zeny'].'<br />
					Str: '.$r['str'].'<br />
					Agi: '.$r['agi'].'<br />
					Dex: '.$r['dex'].'<br />
					Vit: '.$r['vit'].'<br />
					Int: '.$r['int'].'<br />
					Luk: '.$r['luk'].'<br />
					HP: '.$r['max_hp'].'<br />
					SP: '.$r['max_sp'].'<br /><br />';
				}
			}
		}
		else
		{
			echo $lang['char_text_8'];
		}
		break;
		case 'slot':
		$user = $_SESSION['user'];
		$pass = $_SESSION['pass'];
		$q1 = mysql_query("SELECT `account_id` FROM `login` WHERE `userid`='$user' AND `user_pass`='$pass'");
		$r1 = mysql_fetch_array($q1);
		$id = $r1['account_id'];
		$query = mysql_query("SELECT * FROM `char` WHERE account_id='$id'");
		$check = mysql_num_rows($query);
		if($check == 0)
		{
			echo $lang['char_text_9'];
		}
		else
		{
			while($r = mysql_fetch_array($query))
			{
				echo $r['name'].' '.'<a href="?fd=functions&nav=char&get=slot&edit&id='.$r['char_id'].'">'.$lang['char_text_11'].'</a><br />';
			}
		}
		if(isset($_GET['edit']))
		{
			$id = $_GET['id'];
			$user = $_SESSION['user'];
			$pass = $_SESSION['pass'];
			$query = mysql_query("SELECT account_id FROM `login` WHERE `userid`='$user' AND `user_pass`='$pass'");
			$r = mysql_fetch_array($query);
			$acc_id = $r['account_id'];
			$query = mysql_query("SELECT * FROM `char` WHERE `account_id`='$acc_id' and `char_id`='$id'");
			$r = mysql_fetch_array($query);
			if($r)
			{
				echo '<form action="?fd=functions&nav=char&get=slot&edit&id='.$id.'" method="post">';
				echo $r['char_num'].' to <input name="slot" type="text" value="" size="4" maxlength="1" />
				<input type="submit" name="Submit" value="'.$lang['char_text_10'].'" />
				</form>';
			}
			else
			{
				echo $lang['char_text_12'];
			}
			if($_POST['Submit'])
			{
				$slot = $_POST['slot'];
				$id = $_GET['id'];
				$user = $_SESSION['user'];
				$pass = $_SESSION['pass'];
				$query = mysql_query("SELECT account_id FROM `login` WHERE `userid`='$user' AND `user_pass`='$pass'");
				$r = mysql_fetch_array($query);
				$acc_id = $r['account_id'];
				$check = mysql_query("SELECT * FROM `char` WHERE `char_num`='$slot' AND `account_id`='$acc_id'");
				$check2 = mysql_num_rows($check);
				if($check2 != 0)
				{
					echo $lang['char_text_13'];
				}
				else
				{
					$ok = mysql_query("UPDATE `char` SET `char_num`='$slot' WHERE `char_id`='$id'");
					if($ok)
					{
						echo $lang['char_text_14'];
					}
					else
					{
						echo $lang['char_text_15'];
					}
				}
			}
		}
		break;
		case 'unstuck':
		$user = $_SESSION['user'];
		$pass = $_SESSION['pass'];
		$q1 = mysql_query("SELECT `account_id` FROM `login` WHERE `userid`='$user' AND `user_pass`='$pass'");
		$r1 = mysql_fetch_array($q1);
		$id = $r1['account_id'];
		$query = mysql_query("SELECT * FROM `char` WHERE account_id='$id'");
		$check = mysql_num_rows($query);
		if($check == 0)
		{
			echo $lang['char_text_9'];
		}
		else
		{
			$query = mysql_query("SELECT * FROM `char` WHERE `account_id`='$id'");
			echo '<form action="?fd=functions&nav=char&get=unstuck" method="post">
			<select name="select">
			<option selected="selected" disabled>選擇角色</option>';
			while($r = mysql_fetch_array($query))
			{
				echo '<option value="'.$r['char_id'].'">'.$r['name'].'</option>';
			}
			echo '</select>
			<input type="submit" name="Submit" value="'.$lang['char_text_4'].'" />
			</form>';
			if($_POST['Submit'])
			{
				$id = $_POST['select'];
				if(empty($id))
				{
					die($lang['char_text_18']);
				}
				$ok = mysql_query("UPDATE `char` SET `last_map`='new_1-1.gat', `last_x`='53', `last_y`='108' WHERE `char_id`='$id'"); //自救點設定
				if($ok)
				{
					echo $lang['char_text_16'];
				}
				else
				{
					$lang['char_text_18'];
				}
			}
		}
		break;
		case 'transfer':
		echo '<form action="?fd=functions&nav=char&get=transfer" method="post">
		<select name="list1">
		<option selected="selected" disabled>'.$lang['char_text_19'].'</option>';
		$query = $func->check_chars();
		while($r = mysql_fetch_array($query))
		{
			echo '<option value="'.$r['char_id'].'">'.$r['name'].'</option>';
		}
		echo '</select>
		<select name="list2" id="list2">
		<option selected="selected" disabled>'.$lang['char_text_20'].'</option>';
		$query = $func->check_chars();
		while($r = mysql_fetch_array($query))
		{
			echo '<option value="'.$r['char_id'].'">'.$r['name'].'</option>';
		}
		echo'</select>';
		echo '<input type="submit" name="send" value="Ok" />
		</form>';
		if($_POST['send'])
		{
			$select1 = $_POST['list1'];
			$select2 = $_POST['list2'];
			if($select1 == $select2)
			{
				echo $lang['char_text_21'];
			}
			elseif(empty($select1) || empty($select2))
			{
				echo $lang['char_text_24'];
			}
			else
			{
				$query = mysql_query("SELECT * FROM `char` WHERE `char_id`='$select1'");
				$r = mysql_fetch_array($query);
				echo '<form action="?fd=functions&nav=char&get=transfer2" method="post">
				<table border="0">
				<tr>
				<td>'.$r['name'].'</td>
				<td>'.$r['zeny'].'</td>
				</tr>
				<tr>
				<td>'.$lang['char_text_22'].'</td>
				<td><input name="zeny1" type="text" value="" />
				<input name="char_id" type="hidden" value="'.$r['char_id'].'" /></td>
				</tr>';
				$query = mysql_query("SELECT * FROM `char` WHERE `char_id`='$select2'");
				$r = mysql_fetch_array($query);
				echo '<tr>
				<td>'.$r['name'].'</td>
				<td>'.$r['zeny'].'
				<input name="char_id2" type="hidden" value="'.$r['char_id'].'" /></td>
				</tr>
				<tr>
				<td>'.$lang['char_text_23'].'<br />
				<input type="submit" name="send2" value="Ok" /></td>
				<td>
				</td>
				</tr>
				</table></form>';
			}
		}
		break;
		case 'transfer2':
		if($_POST['send2'])
		{
			$zeny = $_POST['zeny1'];
			$char_id = $_POST['char_id'];
			$char_id2 = $_POST['char_id2'];
			$c = $func->check_true_char($char_id);
			if($c == true)
			{
				$query = mysql_query("SELECT * FROM `char` WHERE `char_id`='$char_id'");
				$r = mysql_fetch_array($query);
				$z = $r['zeny'];
				if($zeny > $z)
				{
					echo $lang['char_text_25'];
				}
				elseif(!is_numeric($zeny))
				{
					echo $lang['char_text_28'];
				}
				else
				{
					$remove_zeny = $z-$zeny;
					$query = mysql_query("SELECT `zeny` from `char` WHERE `char_id`='$char_id2'");
					$r = mysql_fetch_array($query);
					$z2 = $r['zeny'];
					$add_zeny = $z2+$zeny;
					$ok = mysql_query("UPDATE `char` SET `zeny`='$remove_zeny' WHERE `char_id`='$char_id'");
					$ok2 = mysql_query("UPDATE `char` SET `zeny`='$add_zeny' WHERE `char_id`='$char_id2'");
					if($ok && $ok2)
					{
						echo $lang['char_text_26'];
					}
					else
					{
						echo $lang['char_text_27'];
					}
				}
			}
			else
			{
				echo $lang['char_text_12'];
			}
		}
		break;
		case 'editstyle':
		$query = $func->check_chars();
		while($r = mysql_fetch_array($query))
		{
			echo $r['name'].' - <a href="?fd=functions&nav=char&get=editstyle&edit&id='.$r['char_id'].'">'.$lang['char_text_11'].'</a><br />';
		}
		if(isset($_GET['edit']))
		{
			$char_id = $_GET['id'];
			$c_t_c = $func->check_true_char($char_id);
			if($c_t_c)
			{
				$query = mysql_query("SELECT * FROM `char` WHERE `char_id`='$char_id'");
				$r = mysql_fetch_array($query);
				echo '<form action="?fd=functions&nav=char&get=editstyle&edit&id='.$r['char_id'].'" method="post">
				<table border="0">
				<tr>
				<td>&nbsp;</td>
				<td>'.$lang['db_text_7'].'</td>
		    	<td>'.$lang['char_text_29'].'</td>
				<td>'.$lang['char_text_30'].'</td>
				<td>'.$lang['char_text_31'].'</td>
				</tr>
				<tr>
		    	<td>'.$lang['char_text_32'].'</td>
		    	<td>'.$r['name'].'</td>
		    	<td>'.$r['hair_color'].'</td>
		    	<td>'.$r['hair'].'</td>
		    	<td>'.$r['clothes_color'].'</td>
				</tr>
				<td>'.$lang['char_text_33'].'</td>
		    	<td>&nbsp;</td>
		    	<td align="center"><input name="hair" type="text" id="hair" size="10" maxlength="3" /></td>
		    	<td align="center"><input name="hair_color" type="text" id="hair_color" size="10" maxlength="3" /></td>
		    	<td align="center"><input name="clothes_color" type="text" id="clothes_color" size="10" maxlength="3" /></td>
				</tr>
				</table>
				<input type="hidden" value="'.$r['char_id'].'" name="char_id" /><br />'.$lang['char_text_36'].'<br />
				<input type="submit" name="Submit" value="'.$lang['char_text_11'].'" />
				</form>';
				if($_POST['Submit'])
				{
					$hair = $_POST['hair'];
					$hair_color = $_POST['hair_color'];
					$clothes_color = $_POST['clothes_color'];
					$char_id = $_POST['char_id'];
					if(empty($hair) || empty($hair_color) || empty($clothes_color))
					{
						echo $lang['char_text_37'];
					}
					elseif(!is_numeric($hair) || !is_numeric($hair_color) || !is_numeric($clothes_color))
					{
						echo $lang['char_text_28'];
					}
					else
					{
						$ok = mysql_query("UPDATE `char` SET `hair`='$hair', `hair_color`='$hair_color', `clothes_color`='$clothes_color' WHERE `char_id`='$char_id'");
						if($ok)
						{
							echo $lang['char_text_34'];
						}
						else
						{
								echo $lang['char_text_35'];
						}
					}
				}
			}
			else
			{
				echo $lang['char_text_12'];
			}
		}
		break;
	}
}
else
{
	echo $lang['char_err1'];
}
?>