<?php
if (!eregi("index.php", $_SERVER['PHP_SELF']))
{
    die ("You can't access this file directly..."); 
}
echo "
<TABLE width=\"100%\" height=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"5\">
	<TBODY>
		<TR class=>
			<TD width=\"100%\" height=\"25\" vAlign=\"top\"></TD>
		</TR>
		<TR class=\"topic_title6\" height=\"100%\">
			<TD class=\"title_face4\" vAlign=\"top\">
";
include("main.html");
echo "			</TD>
		</TR>
		
		<TR>
			<TD width=\"100%\" height=\"25\"></TD>
		</TR>
	<TBODY>
</TABLE>
";
?>