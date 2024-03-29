<?php
// セッション
session_start();

// データベースマネージャの読込
require_once "./DBManager.php";
$db = new DBManager();
$db->OutPutlog();
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
    $str = mb_convert_kana($_POST['projecttags'], 's', 'UTF-8');
    $delimiter = " ";
    $token = strtok($str, $delimiter);
    $arr = array();

    while ($token !== false) {
        array_push($arr, $token);
        $token = strtok($delimiter);
    }

    $data = $db->getProject($_POST['id']);
    if ($data['user_id'] != $_SESSION['login_id']) header("Location: ../index.php");

    // print_r($_POST);
    $db->editProject($_POST['id'], $db->regexHtml($_POST['projectname']), $db->regexHtml($_POST['projectpk']), $_POST['projectdesc'], $arr, isset($_POST['tags'])?$_POST['tags']:null, isset($_POST['imgs'])?$_POST['imgs']:null);
    echo "更新中...";
    echo "<script>location.replace('../project.php?id=".$_POST['id']."');</script>";
    exit;
}
?>
