<?php
    echo '<div class="col-4">';
    echo '<div class="section">';
    echo '<h1>新着</h1>';
    echo '<ul>';
    $dates = $db->getProjectsNew(5);
    if (empty($dates)) {
        echo '<li>データがありません</li>';
    } else {
        foreach ($dates as $key) {
            echo '<li><a href="./project.html?id='.$key['project_id'].'">'.$key['project_name'].'</a></li>';
        }
    }
    echo '</ul>';
    echo '</div>';
    echo '<div class="section">';
    echo '<h1>人気の作品</h1>';
    echo '<ul>';
    echo '<li>データがありません</li>';
    echo '</ul>';
    echo '</div>';
    echo '<div class="section">';
    echo '<h1>ランダム</h1>';
    echo '<ul>';
    echo '<li>データがありません</li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
?>