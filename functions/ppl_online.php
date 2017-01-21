<?php
if (!eregi("index.php", $_SERVER['PHP_SELF']))
{
    die ("You can't access this file directly..."); 
}
echo '<span class="content-header">'.$lang['usr_online'].'</span>';
if(empty($_POST['order']))
{
	$order = 'base_level';
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
$table = 'char';
$limit = 50;
$links_limit = 4;
$page = $_GET['page'];
$totalrows = mysql_num_rows(mysql_query("SELECT * FROM `$table` WHERE `online`='1'"));
if(empty($page))
{
	$page = '1';
};
$start = ($page-1)*$limit;
$start = round($start,0);
$result = mysql_query("SELECT * FROM `$table` WHERE `online`='1' ORDER BY $order $order2 LIMIT $start, $limit");
echo '<table border="0" align="center">
  <tr>
    <td align="center">'.$lang['rank1'].'</td>
    <td align="center">'.$lang['rank2'].'</td>
    <td align="center">'.$lang['rank3'].'</td>
    <td align="center">'.$lang['rank4'].'</td>
	<td align="center">Class</td>
  </tr>';
while ($r = mysql_fetch_array($result))
{
	echo '<tr>
    <td align="center">'.$r['name'].'</td>
    <td align="center">'.$r['base_level'].'</td>
    <td align="center">'.$r['job_level'].'</td>
    <td align="center">'.$r['zeny'].'</td>
	<td align="center">'.$func -> getjob($r['class']).'</td>
  </tr>';
};
echo '</table><div align="center">';
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
	echo "<a href=\"?page=$prevpage\">".$lang['pag2'].'</a> ';
	echo "<a href=\"?page=$prevpage\">$prevpage</a> ";
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
		echo "<a href=\"?page=$i\">$i</a> ";
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
	echo "<a href=\"?page=$nextpage\">".$lang['pag1'].'</a> ';
	}
}
echo '<br /><form action="?fd=functions&nav=ppl_online" method="post">
  <select name="order">
    <option value="base_level" selected="selected">'.$lang['rank2'].'</option>
    <option value="job_level">'.$lang['rank3'].'</option>
    <option value="zeny">'.$lang['rank4'].'</option>
  </select>
  <select name="order2">
    <option value="DESC" selected="selected">'.$lang['rank_ord_desc'].'</option>
    <option value="ASC">'.$lang['rank_ord_asc'].'</option>
  </select>
  <input type="submit" name="Submit" value="'.$lang['rank_ord'].'" />
</form><br />'.$totalrows.' '.$lang['usr_online'].'.</div>';
?>