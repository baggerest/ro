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
$lang['wel_title'] = '歡迎!';
$lang['welcome'] = '歡迎來到 '.$config_server_name.'註冊頁!';
$lang['con_error'] = '無法連接到SQL資料庫，!';
$lang['reg'] = '註冊';
$lang['login'] = '登入';
$lang['exit'] = '登出';
$lang['usr_online'] = 'Users Online';
$lang['404'] = 'Error 404. 這網頁不存在';
$lang['menu_title'] = '主要選單';
$lang['menu_personal'] = '個人選單';
$lang_menu = array(
'<a href="?nav=main">首頁</a><br />',
'<a href="?fd=functions&nav=register">註冊</a><br />',
'<a href="?fd=functions&nav=login">登入</a><br />',
'<a href="?fd=functions&nav=recoverpass">忘記密碼</a><br />',
'<a href="?fd=functions&nav=database">資料查詢</a><br />',
'<a href="?fd=functions&nav=ppl_online">在線使用者</a><br />',
'<a href="?fd=functions&nav=ranking">個人排名</a><br />',
'<a href="?fd=functions&nav=guildranking">公會排名</a><br />',
'<a href="?fd=functions&nav=download">下載專區</a>'
);
$lang_personal_menu = array(
'<a href="?fd=functions&nav=char">角色管理系統</a><br />',
'<a href="?fd=functions&nav=changepass">更改密碼</a><br />',
'<a href="?fd=functions&nav=changetemplate">更改首頁風格</a><br />',
'<a href="?fd=functions&nav=logout">登出</a>'
);
$lang['db'] = '資料查詢';
$y = $func->check_year();
$lang['copyright'] = 'Code From BlackRO '.$y.' Kuraun CP v1.1 - All Rights Reserved - Server: '.$config_server_name;
$lang['username'] = '帳號';
$lang['pass'] = '密碼';
$lang['email'] = '電子信箱';
$lang['gender'] = '角色性別';
$lang['male'] = '男';
$lang['female'] = '女';
$lang['sec_code'] = '驗證碼';
$lang['register'] = '送出';
$lang['login'] = '登入';
$lang['code_err'] = '驗證碼輸入錯誤!';
$lang['reg_msg'] = '註冊';
$lang['reg_err'] = '所有資料都必須填寫';
$lang['reg2_err'] = '請輸入有效的電子信箱<br />我們不會發送任何信件，它只是用來刪除角色';
$lang['reg3_err'] = '您的帳號或信箱已經存在<br />請再次選擇其他帳號或信箱';
$lang['reg4_err'] = '註冊系統出錯，資料無法寫入，請聯絡管理員';
$lang['succ_reg'] = '註冊成功<br />遊戲愉快!';
$lang['err_login'] = '您的帳號或密碼錯誤，請再次輸入<br />或者您還沒註冊該帳號';
$lang['succ_login'] = '登入成功 Welcome';
$lang['al_log'] = '您已經登入';
$lang['logout'] = '您已經登出';
$lang['nologout'] = '您沒有登入，無法登出';
$lang['pag1'] = '下一頁';
$lang['pag2'] = '上一頁';
$lang['pag3'] = '沒有資料';
$lang['rank_name'] = '個人排行';
$lang['rank1'] = '角色名稱';
$lang['rank2'] = '基本等級';
$lang['rank3'] = '職業等級';
$lang['rank4'] = '金錢';
$lang['rank_ord'] = '排列方式';
$lang['rank_ord_desc'] = '降序';
$lang['rank_ord_asc'] = '升序';
$lang['usr_total'] = '全部角色';
$lang['usr_online'] = '在線角色';
$lang['db_text_1'] = '尋找';
$lang['db_text_2'] = '物品';
$lang['db_text_3'] = '怪物';
$lang['db_text_4'] = '編號查詢';
$lang['db_text_5'] = '名稱查詢';
$lang['db_text_6'] = '查詢類別';
$lang['db_text_7'] = '名稱';
$lang['db_text_8'] = '編號';
$lang['db_text_9'] = '基本經驗';
$lang['db_text_10'] = '職業經驗';
$lang['db_text_11'] = '降序';
$lang['db_text_12'] = '升序';
$lang['db_text_13'] = '尋找';
$lang['db_text_14'] = '重量';
$lang['db_text_15'] = '購買價格';
$lang['db_text_16'] = '賣出價格';
$lang['db_text_17'] = '洞數';
$lang['db_text_18'] = '防禦力';
$lang['db_text_19'] = '魔法防禦力';
$lang['db_text_20'] = '攻擊速度';
$lang['db_err1'] = '您只能用編號 <strong>或</strong> 名稱尋找';
$lang['db_err2'] = '您必須選擇編號或名稱尋找';
$lang['db_err3'] = '在查詢物品時，您不能選擇基本/職業經驗排序';
$lang['char_err1'] = '您必須登入才能查詢';
$lang['char_text_1'] = '角色欄位更改';
$lang['char_text_2'] = '髮型/衣服顏色修改';
$lang['char_text_3'] = '髮色修改';
$lang['char_text_4'] = '卡點自救';
$lang['char_text_5'] = '轉移金錢';
$lang['char_text_6'] = '歡迎來到您的腳色管理系統';
$lang['char_text_7'] = '查看角色資訊';
$lang['char_text_8'] = '您還沒有帳號';
$lang['char_text_9'] = '您還沒有任何角色';
$lang['char_text_10'] = '角色欄位更改';
$lang['char_text_11'] = '更改';
$lang['char_text_12'] = '這不是您的腳色';
$lang['char_text_13'] = '您有其他角色在這個欄位<br />請選擇其他欄位.';
$lang['char_text_14'] = '角色改變欄位成功.';
$lang['char_text_15'] = '發生錯誤，請聯絡管理員.';
$lang['char_text_16'] = '卡位自救成功.';
$lang['char_text_17'] = '自救失敗，請聯絡管理員.';
$lang['char_text_18'] = '您必須選擇角色!';
$lang['char_text_19'] = '從';
$lang['char_text_20'] = '轉到';
$lang['char_text_21'] = '轉移角色必須不同<br />您不能轉移金錢至相同角色';
$lang['char_text_22'] = '送出';
$lang['char_text_23'] = '接收';
$lang['char_text_24'] = '您必須選擇兩個角色.';
$lang['char_text_25'] = '您的錢不夠轉移<br />GM已經收到回報，請勿再次執行';
$lang['char_text_26'] = '轉移成功!';
$lang['char_text_27'] = '轉移失敗，請聯絡管理員.';
$lang['char_text_28'] = '只能輸入數字!';
$lang['char_text_29'] = '頭髮顏色';
$lang['char_text_30'] = '頭髮造型';
$lang['char_text_31'] = '衣服顏色';
$lang['char_text_32'] = '舊';
$lang['char_text_33'] = '新';
$lang['char_text_34'] = '更改成功.';
$lang['char_text_35'] = '發生錯誤，請回報管理員.';
$lang['char_text_36'] = '所有資料必須輸入，若不想更改請照原值輸入.';
$lang['char_text_37'] = '所有資料必須輸入，您不能輸入0.';
$lang['change_pass_1'] = '密碼更改';
$lang['change_pass_2'] = '送出';
$lang['change_pass_3'] = '舊密碼';
$lang['change_pass_4'] = '新密碼';
$lang['change_pass_5'] = '帳號或密碼不正確.';
$lang['change_pass_6'] = '密碼更改成功.';
$lang['recover_pass_1'] = '找回密碼';
$lang['recover_pass_2'] = '找回密碼';
$lang['recover_pass_3'] = '帳號或信箱錯誤';
$lang['recover_pass_4'] = '密碼將傳送到您的信箱';
$lang['recover_pass_5'] = '這是您的密碼，請記勞 ';
$lang['template_change_1'] = '首頁風格';
$lang['template_change_2'] = '目前風格';
$lang['template_change_3'] = '改變風格  to';
$lang['guild_rank_1'] = '公會排行';
$lang['guild_rank_2'] = '公會會長';
$lang['guild_rank_3'] = '公會等級';
$lang['guild_rank_4'] = '平均等級';
$lang['guild_rank_5'] = '個公會';
?>