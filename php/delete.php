<?php
// セッション
session_start();

// データベースマネージャの読込
require_once "./DBManager.php";
$db = new DBManager();
$db->OutPutlog();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $data = $db->getProject($_POST['id']);
    if ($data['user_id'] != $_SESSION['login_id']) header("Location: ../index.php");

    try {
        $db->deleteProjectById($_POST['id']);

        array_map('unlink', glob("../img/projectimg/".(int)$_POST['id']."/*.png"));
        rmdir("../img/projectimg/".(int)$_POST['id']);
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }

    echo '削除中...';
    echo "<script>location.replace('../index.php');</script>";
    exit;
    
}
?>