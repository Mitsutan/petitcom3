<?php
// セッション
session_start();

// データベースマネージャの読込
require_once "./DBManager.php";
$db = new DBManager();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['newpass'] == $_POST['newpass2']) {
        try {
            $db->changeUserPass($_SESSION['login_id'], $_POST['pass'], $_POST['newpass']);
            echo 'パスワードを変更しました。';
            echo "<script>location.replace('../mypage.php');</script>";
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    } else {
        echo '新しいパスワードが一致しません。';
    }
}
?>
