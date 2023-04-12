<?php
    if (is_uploaded_file($_FILES['projectimg']['tmp_name'])) {
        $file='../img/projectimg/'.basename($_FILES['projectimg']['name']);
    }


    // POSTされた文字列を取得
    $str = $_POST['projectdesc'];

    // 改行を削除して一行にする
    $str = str_replace(array("\r\n", "\r", "\n"), '', $str);

    $htmlString = strip_tags($str, '<a><p><br><b><i><u><ul><ol><li><h3>');
    $regex = '/<(?!a\s)(\w+)\s*([^>]*?)(?<!\/)>/';
    $result = preg_replace($regex, '<$1>', $htmlString);
    echo $result;

?>