<?php
//////////////////////////////////////////////////////////////
// Ragnarok Online Control Panel - Kuraun CP                //
// Version: v1.1 (2010/11/21)                               //
// 源碼來源: Federico Ram甏ez (fedekiller - www.php4all.org)//
// 源碼源檔: BlackRO                                        //
// 漢化:Kuraun (Kuraun技術流 - Kuraun.uni.cc                //
// 技術支援:Kuraun (Kuraun技術流 - Kuraun.uni.cc            //
// 分站:http://blog.yam.com/kuraun							//
// 更新支援:Kuraun (Kuraun技術流 - Kuraun.uni.cc            //
// 分站:http://blog.yam.com/kuraun							//
// 風格支援:Kuraun (Kuraun技術流 - Kuraun.uni.cc            //
// 分站:http://blog.yam.com/kuraun							//
// RO私服相關漢化,模擬器漢化,腳本漢化 Kuraun.uni.cc         //
// 分站:http://blog.yam.com/kuraun							//
//////////////////////////////////////////////////////////////
if (!eregi("index.php", $_SERVER['PHP_SELF']))
{
    die ("You can't access this file directly..."); 
}
echo "
<TABLE width=\"100%\" height=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"5\">
	<TBODY>
		<TR class=>
			<TD width=\"100%\" height=\"25\" vAlign=\"top\"><center><h4>檔案下載系統</h4></center></TD>
		</TR>
		<TR class=\"topic_title6\" height=\"100%\">
			<TD class=\"title_face4\" vAlign=\"top\">
";
				include("download.html");

echo "			</TD>
		</TR>
		
		<TR>
			<TD width=\"100%\" height=\"25\"></TD>
		</TR>
	<TBODY>
</TABLE>
";

?>