<?php
    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        $file='../img/projectimg/'.basename($_FILES['file']['name']);
    }
?>