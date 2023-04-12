<?php
    // セッション
    session_start();
        
    // データベースマネージャの読込
    require_once "./DBManager.php";
    $db = new DBManager();

    if (is_uploaded_file($_FILES['projectimg']['tmp_name'])) {
        $file='../img/projectimg/'.basename($_FILES['projectimg']['name']);
    }

    $desc = $db->regexHtml($_POST['projectdesc']);
    echo $desc;
?>