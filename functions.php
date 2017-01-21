<?php
if (!eregi("index.php", $_SERVER['PHP_SELF']))
{
    die ("You can't access this file directly..."); 
}

class func 
{
	function sec()
	{
		foreach($_POST as $key => $val)
		{
		$_POST[$key] = stripslashes(strip_tags(htmlspecialchars($val, ENT_QUOTES)));
		$$key = stripslashes(strip_tags(htmlspecialchars($val, ENT_QUOTES)));
		}
		foreach($_GET as $key => $val)
		{
		$_GET[$key] = stripslashes(strip_tags(htmlspecialchars($val, ENT_QUOTES)));
		$$key = stripslashes(strip_tags(htmlspecialchars($val, ENT_QUOTES)));
		}
	}
	
	function users_online()
	{
		$query = mysql_query ("SELECT * FROM `char` WHERE `online` = 1");
		$total = mysql_num_rows($query);
		return $total;
	}
	
	function server_status($config_server_ip, $v, $k)
	{
		if($fp=@fsockopen($config_server_ip,$v, $errno, $errstr,(float)0.5))
		{
			echo($k.' Server: <font color ="#009933">開機中</font><br />');
			fclose($fp);
		}
		else
		{
			echo($k.' Server: <font color ="#FF0000">關機中</font><br />');
		}
	}
	
	function make_security_code()
	{
		$string = rand (00000,99999);
		$ck = rand(1, 3);
		if($ck == 1)
		{
			$string = str_replace ('2', 'F', $string);
			$string = str_replace ('6', 'e', $string);
			$string = str_replace ('7', 'L', $string);
		}
		elseif($ck == 2)
		{
			$string = str_replace ('3', 'k', $string);
			$string = str_replace ('9', 'M', $string);
			$string = str_replace ('1', 's', $string);
		}
		else
		{
			$string = str_replace ('4', 'V', $string);
			$string = str_replace ('8', 'D', $string);
			$string = str_replace ('0', 'a', $string);
		}
		return $string;
	}
	
	function get_item($id)
	{
		$q = mysql_query("SELECT `name_japanese` FROM `item_db` WHERE id='$id'");
		$r = mysql_fetch_array($q);
		return $r['name_japanese'];
	}
	
	function check_chars()
	{
		$user = $_SESSION['user'];
		$pass = $_SESSION['pass'];
		$q1 = mysql_query("SELECT `account_id` FROM `login` WHERE `userid`='$user' AND `user_pass`='$pass'");
		$r1 = mysql_fetch_array($q1);
		$id = $r1['account_id'];
		$query = mysql_query("SELECT * FROM `char` WHERE account_id='$id'");
		$check = mysql_num_rows($query);
		if($check == 0)
		{
			die('You have not created a character yet!');
		}
		else
		{
			return $query;
		}
	}
	
	function check_true_char($char_id)
	{
		$user = $_SESSION['user'];
		$pass = $_SESSION['pass'];
		$query = mysql_query("SELECT account_id FROM `login` WHERE `userid`='$user' AND `user_pass`='$pass'");
		$r = mysql_fetch_array($query);
		$acc_id = $r['account_id'];
		$query = mysql_query("SELECT * FROM `char` WHERE `account_id`='$acc_id' AND `char_id`='$char_id'");
		$count = mysql_num_rows($query);
		if($count == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function check_user($user, $pass)
	{
		$ok = mysql_query("SELECT * FROM `login` WHERE `userid`='$user' AND `user_pass`='$pass'");
		if($ok)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function check_year()
	{
		$st_date = '2010';
		$actual_year = date('Y');
		if($st_date == $actual_year)
		{
			$ret = $actual_year;
			return $ret;
		}
		else
		{
			$ret = $st_date.' - '.$actual_year;
			return $ret;
		}
	}
	
	function getjob($num)  //職業檢查 1.2.3轉
	{
		switch($num)
		{
			default:
				return '初新者';
			break;
			case '7':
				return '騎士';
			break;
			case '14':
				return '十字軍';
			break;
			case '22':
				return 'Formal';
			break;
			case '1':
				return '劍士';
			break;
			case '8':
				return 'Priest';
			break;
			case '15':
				return 'Monk';
			break;
			case '23':
				return 'Super Novice';
			break;
			case '2':
				return 'Mage';
			break;
			case '9':
				return 'Wizard';
			break;
			case '19':
				return 'Sage';
			break;
			case '3':
				return 'Archer';
			break;
			case '10':
				return 'Blacksmith';
			break;
			case '17':
				return 'Rogue';
			break;
			case '4':
				return 'Acolyte';
			break;
			case '11':
				return 'Hunter';
			break;
			case '18':
				return 'Alchemist';
			break;
			case '5':
				return 'Merchant';
			break;
			case '12':
				return 'Assasin';
			break;
			case '6':
				return 'Thief';
			break;
			case '13':
				return 'Knight';
			break;
			case '20':
				return 'Dancer';
			break;
			case '21':
				return 'Crusader';
			break;
			case '24':
				return 'Novice High';
			break;
			case '31':
				return 'Lord Knight';
			break;
			case '38':
				return 'Paladin';
			break;
			case '25':
				return 'Swordman High';
			break;
			case '32':
				return 'High Priest';
			break;
			case '39':
				return 'Monk';
			break;
			case '26':
				return 'Mage High';
			break;
			case '33':
				return 'High Wizzard';
			break;
			case '40':
				return 'Professor';
			break;
			case '27':
				return 'Archer High';
			break;
			case '34':
				return 'Whitesmith';
			break;
			case '41':
				return 'Stalker';
			break;
			case '28':
				return 'Acolyte High';
			break;
			case '35':
				return 'Sniper';
			break;
			case '42':
				return 'Creator';
			break;
			case '29':
				return 'Merchant High';
			break;
			case '36':
				return 'Assasin Cross';
			break;
			case '43':
				return 'Clown';
			break;
			case '30':
				return 'Thief High';
			break;
			case '37':
				return 'Peko Knight';
			break;
			case '44':
				return 'Gypsy';
			break;
			case '45':
				return 'Paladin';
			break;
			case '4046':
				return 'Taekwon';
			break;
			case '24':
				return 'Gunslinger';
			break;
			case '25':
				return 'Ninja';
			break;
			case '4001':
				return 'Novice High';
			break;
			case '4002':
				return 'Swordman High';
			break;
			case '4003':
				return 'Magician High';
			break;
			case '4004':
				return 'Archer High';
			break;
			case '4005':
				return 'Acolyte High';
			break;
			case '4006':
				return 'Merchant High';
			break;
			case '4007':
				return 'Thief High';
			break;
			case '4008':
				return 'Lord Knight';
			break;
			case '4009':
				return 'High Priest';
			break;
			case '4010':
				return 'High Wizard';
			break;
			case '4011':
				return 'Whitesmith';
			break;
			case '4013':
				return 'Assasin Cross';
			break;
			case '4014':
				return 'Lord Knight Peko';
			break;
			case '4022':
				return 'Paladin';
			break;
			case '4016':
				return 'Champion';
			break;
			case '4017':
				return 'Professor';
			break;
		}
	}
}
?>