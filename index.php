<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- 設定網頁編碼為UTF-8 -->
<form name="form" method="post" action="connect.php">
    帳號：<input type="text" name="id" /> <br>
    密碼：<input type="password" name="pw" /> <br>
    <input type="submit" name="button" value="登入" />&nbsp;&nbsp;
    <a href="register.php">申請帳號</a>
</form>

<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2017/11/22
 * Time: 上午 11:53
 */
//資料庫設定
//資料庫位置
$db_server = "localhost";
//資料庫名稱
$db_name = "mydb";
//資料庫管理者帳號
$db_user = "root";
//資料庫管理者密碼
$db_passwd = "1234";
//對資料庫連線
if(!@mysql_connect($db_server, $db_user, $db_passwd))
    die("無法對資料庫連線");

//資料庫連線採UTF8
mysql_query("SET NAMES utf8");

//選擇資料庫
if(!@mysql_select_db($db_name))
    die("無法使用資料庫");

//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include("mysql_connect.inc.php");
$id = $_POST['id'];
$pw = $_POST['pw'];
//搜尋資料庫資料
$sql = "SELECT * FROM member_table where username = '$id'";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);
//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if($id != null && $pw != null && $row[1] == $id && $row[2] == $pw)
{
    //將帳號寫入session，方便驗證使用者身份
    $_SESSION['username'] = $id;
    echo '登入成功!';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=member.php>';
}
else
{
    echo '登入失敗!';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}
?>
