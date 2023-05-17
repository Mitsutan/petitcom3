<div class="col-sm-12 col-md-4">
    <div class="section">
        <h1>新着</h1>
        <ul>
            <?php
            $dates = $db->getProjectsNew(5);
            if (empty($dates)) {
                echo '<li>データがありません</li>';
            } else {
                foreach ($dates as $key) {
                    echo '<li><a href="./project?id=' . $key['project_id'] . '">' . $key['project_name'] . '</a></li>';
                }
            }
            echo '</ul>';
            echo '</div>';
            echo '<div class="section">';
            echo '<h1>人気の作品</h1>';
            echo '<ul>';
            $dates = $db->getProjectsPopular(5);
            if (empty($dates)) {
                echo '<li>データがありません</li>';
            } else {
                foreach ($dates as $key) {
                    echo '<li><a href="./project?id=' . $key['project_id'] . '">' . $key['project_name'] . '</a></li>';
                }
            }
            echo '</ul>';
            echo '</div>';
            echo '<div class="section">';
            echo '<h1>ランダム</h1>';
            echo '<ul>';
            $dates = $db->getProjectsRand(5);
            if (empty($dates)) {
                echo '<li>データがありません</li>';
            } else {
                foreach ($dates as $key) {
                    echo '<li><a href="./project?id=' . $key['project_id'] . '">' . $key['project_name'] . '</a></li>';
                }
            }
            ?>
        </ul>
    </div>
</div>