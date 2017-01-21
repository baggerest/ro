<?php
if (!eregi("index.php", $_SERVER['PHP_SELF']))
{
    die ("You can't access this file directly..."); 
}
echo '<span class="content-header">'.$lang['guild_rank_1'].'</span>';
if(empty($_POST['order']))
{
	$order = 'guild_lv';
}
else
{
	$order = $_POST['order'];
}
if(empty($_POST['order2']))
{
	$order2 = 'DESC';
}
else
{
	$order2 = $_POST['order2'];
}
$table = 'guild';
$limit = 50;
$links_limit = 4;
$page = $_GET['page'];
$totalrows = mysql_num_rows(mysql_query("SELECT * FROM `$table`"));
if(empty($page))
{
	$page = '1';
};
$start = ($page-1)*$limit;
$start = round($start,0);
$result = mysql_query("SELECT * FROM `$table` ORDER BY $order $order2 LIMIT $start, $limit");
echo '<div align="center">
<table border="0">
<tr>
<td align="center">'.$lang['rank1'].'</td>
<td align="center">'.$lang['guild_rank_2'].'</td>
<td align="center">'.$lang['guild_rank_3'].'</td>
<td align="center">'.$lang['guild_rank_4'].'</td>
</tr>';
while ($r = mysql_fetch_array($result))
{
	$master = $r['master'];
	$q1 = mysql_query("SELECT * FROM `char` WHERE `name`='$master'");
	$test = mysql_fetch_array($q1);
	$acc_id = $test['account_id'];
	$q2 = mysql_query("SELECT * FROM login WHERE account_id='$acc_id'");
	$t = mysql_fetch_array($q2);
	if($t['level']>49)
	{
		continue;
	}
	echo '<tr>
    <td align="center">'.$r['name'].'</td>
    <td align="center">'.$r['master'].'</td>
    <td align="center">'.$r['guild_lv'].'</td>
    <td align="center">'.$r['average_lv'].'</td>
	</tr>';
};
echo '</table>';
$totalpages = $totalrows / $limit;
$totalpages = ceil($totalpages);
if($page == 1)
{
	$endpage = ($page+$links_limit)-1;
}
else
{
	$endpage = ($page+$links_limit)-2;
	$prevpage = $page-1;
	echo "<a href=\"?fd=functions&nav=guildranking&page=$prevpage\">".$lang['pag2'].'</a> ';
	echo "<a href=\"?fd=functions&nav=guildranking&page=$prevpage\">$prevpage</a> ";
}
if($endpage > $totalpages)
{
	$endpage = $totalpages;
}
for($i = $page; $i <= $endpage; $i++)
{
	if($i == $page)
	{
		echo "[$i] ";
	}
	else
	{
		echo "<a href=\"?fd=functions&nav=guildranking&page=$i\">$i</a> ";
	}
}
if($page != $totalpages)
{
	if($totalpages == 0)
	{
		echo $lang['pag3'];
	}
	else
	{
	$nextpage = $page+1;
	echo "<a href=\"?fd=functions&nav=guildranking&page=$nextpage\">".$lang['pag1'].'</a> ';
	}
}
echo '<br /><form action="?fd=functions&nav=guildranking" method="post">
<select name="order">
<option value="guild_lv" selected="selected">'.$lang['guild_rank_3'].'</option>
<option value="average_lv">'.$lang['guild_rank_4'].'</option>
</select>
<select name="order2">
<option value="DESC" selected="selected">'.$lang['rank_ord_desc'].'</option>
<option value="ASC">'.$lang['rank_ord_asc'].'</option>
</select>
<input type="submit" name="Submit" value="'.$lang['rank_ord'].'" />
</form><br />'.$totalrows.' '.$lang['guild_rank_5'].'.</div>';
?>