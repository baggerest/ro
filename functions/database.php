<?php
if (!eregi("index.php", $_SERVER['PHP_SELF']))
{
    die ("You can't access this file directly..."); 
}
echo '<span class="content-header">'.$lang['db'].'</span>';
echo '<form action="?fd=functions&nav=database" method="post">
<table border="0">
  <tr>
    <td>'.$lang['db_text_1'].' </td>
    <td>'.$lang['db_text_2'].'
      <input name="type" type="radio" value="item_db" checked="checked" />
    '.$lang['db_text_3'].'
    <input name="type" type="radio" value="mob_db" /></td>
  </tr>
  <tr>
    <td>'.$lang['db_text_4'].' </td>
    <td><input name="id" type="text" id="id" size="4" maxlength="5" /></td>
  </tr>
  <tr>
    <td>'.$lang['db_text_5'].' </td>
    <td><input name="name" type="text" id="name" /></td>
  </tr>
  <tr>
    <td>'.$lang['db_text_6'].' </td>
    <td><select name="order1" id="order1">
      <option value="kName" selected="selected">'.$lang['db_text_7'].'</option>
      <option value="ID">'.$lang['db_text_8'].'</option>
      <option value="EXP">'.$lang['db_text_9'].'</option>
      <option value="JEXP">'.$lang['db_text_10'].'</option>
    </select>
      <select name="order2" id="order2">
        <option value="DESC" selected="selected">'.$lang['db_text_11'].'</option>
        <option value="ASC">'.$lang['db_text_12'].'</option>
        </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="'.$lang['db_text_13'].'" /></td>
  </tr>
</table>
</form>';
if($_POST['Submit'])
{
	$type = $_POST['type'];
	$id = $_POST['id'];
	$name = $_POST['name'];
	$order1 = $_POST['order1'];
	$order2 = $_POST['order2'];
	if(empty($id) && !empty($name))
	{
		$keep = true;
	}
	elseif(empty($name) && !empty($id))
	{
		$keep = true;
	}
	elseif(!empty($name) &&!empty($id))
	{
		$keep = false;
		$err = $lang['db_err1'];
	}
	else
	{
		$keep = false;
		$err = $lang['db_err2'];
	}
	if($keep == true)
	{
		if(empty($id))
		{
			$search_by = $name;
			$search_from = 'name_japanese';
		}
		else
		{
			$search_by = $id;
			$search_from = 'id';
		}
		if($type == 'item_db')
		{
			$order1 = $_POST['order1'];
			$order1 = str_replace('kName', 'name_japanese', $order1);
			if($order1 == 'EXP' || $order1 == 'JEXP')
			{
				echo $lang['db_err3'];
			}
			else
			{
				echo '<table border="0">
					<tr>
					<td align="center">'.$lang['db_text_8'].'</td>
					<td align="center">'.$lang['db_text_7'].'</td>
					<td align="center">'.$lang['db_text_14'].'</td>
					<td align="center">'.$lang['db_text_15'].'</td>
					<td align="center">'.$lang['db_text_16'].'</td>
					<td align="center">'.$lang['db_text_17'].'</td>
					</tr>';
				$query = mysql_query("SELECT * FROM `item_db` WHERE `$search_from` LIKE '%$search_by%' ORDER BY $order1 $order2");
				while($r = mysql_fetch_array($query))
				{
					$showname = str_replace('_', ' ', $r['name_japanese']);
					echo ' <tr>
					<td align="center">'.$r['id'].'</td>
					<td align="center">'.$showname.'</td>
					<td align="center">'.$r['weight'].'</td>
					<td align="center">'.$r['price_buy'].'</td>
					<td align="center">'.$r['price_sell'].'</td>
					<td align="center">'.$r['slots'].'</td>
					</tr>';
				}
				echo '</table>';
			}
		}
		else
		{
			if(empty($id))
			{
				$search_by = $name;
				$search_from = 'kName';
			}
			else
			{
				$search_by = $id;
				$search_from = 'ID';
			}
			$query = mysql_query("SELECT * FROM `mob_db` WHERE `$search_from` LIKE '%$search_by%' ORDER BY $order1 $order2");
			while($r = mysql_fetch_array($query))
			{
				echo '<table border="0">
				<tr>
				<td>'.$lang['db_text_7'].': <strong>'.$r['kName'].'</strong></td>
				<td align"left"></td>
				<td></td>
				</tr>
				<tr>
				<td valign="top">HP: '.$r['HP'].'<br />
				SP: '.$r['SP'].'<br />
				'.$lang['db_text_9'].': '.$r['EXP'].'<br />
				'.$lang['db_text_10'].': '.$r['JEXP'].'<br />
				'.$lang['db_text_18'].': '.$r['DEF'].'<br />
				'.$lang['db_text_19'].': '.$r['MDEF'].'<br />
				Str: '.$r['STR'].'<br />
				Agi: '.$r['AGI'].'<br />
				Dex: '.$r['DEX'].'<br />
				Int: '.$r['INT'].'<br />
				Vit: '.$r['VIT'].'<br />
				'.$lang['db_text_20'].': '.$r['Speed'].'<br />
				Drops: ';
				$item1 = $func->get_item($r['Drop1id']);
				$item1 = str_replace('Default', '', $item1);
				$item2 = $func->get_item($r['Drop2id']);
				$item2 = str_replace('Default', '', $item2);
				$item3 = $func->get_item($r['Drop3id']);
				$item3 = str_replace('Default', '', $item3);
				$item4 = $func->get_item($r['Drop4id']);
				$item4 = str_replace('Default', '', $item4);
				$item5 = $func->get_item($r['Drop5id']);
				$item5 = str_replace('Default', '', $item5);
				$item6 = $func->get_item($r['Drop6id']);
				$item6 = str_replace('Default', '', $item6);
				$item7 = $func->get_item($r['Drop7id']);
				$item7 = str_replace('Default', '', $item7);
				$item8 = $func->get_item($r['Drop8id']);
				$item8 = str_replace('Default', '', $item8);
				$item9 = $func->get_item($r['Drop9id']);
				$item9 = str_replace('Default', '', $item9);
				echo "$item1 $item2 $item3 $item4 $item5 $item6 $item7 $item8 $item9";
				echo '</td>
				</tr>
				</table>[<a href="#">TOP</a>]<br /><br />';
			}
		}
	}
	else
	{
		echo $err;
	}
}
?>