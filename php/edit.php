<?php
// セッション
session_start();

// データベースマネージャの読込
require_once "./DBManager.php";
$db = new DBManager();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $filesize = 0;
    foreach ($_FILES['projectimg']['size'] as $key => $value) {
        $filesize += $value;
    }
    if ($filesize > 200000) {
        echo "ファイルサイズが大きすぎます：".($filesize - 200000)."kb over";
        exit;
    }
    if (count($_FILES['projectimg']['size']) > 4) {
        echo "画像は4枚までです";
        exit;
    }

    // タグ分割---
    $str = $_POST['projecttags'];
    $delimiter = " ";
    $token = strtok($str, $delimiter);
    $arr = array();

    while ($token !== false) {
        array_push($arr, $token);
        $token = strtok($delimiter);
    }

    $data = $db->getProject($_POST['id']);
    if ($data['user_id'] != $_SESSION['login_id']) header("Location: ../index.html");

    // print_r($_POST);
    $db->editProject($_POST['id'], $_POST['projectname'], $_POST['projectpk'], $_POST['projectdesc'], $arr, $_POST['tags'], $_POST['imgs']);
    echo "更新中...";
    echo "<script>location.replace('../index.html');</script>";
    exit;
}
?>