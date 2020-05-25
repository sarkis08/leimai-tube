<?php

use \yii\widgets\ListView;

/** @var $dataProvider \yii\data\ActiveDataProvider */

?>

<h1>My History</h1>
<?php echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_video_item',
    'layout' => '<div class="d-flex flex-wrap">{items}</div> {pager}',
    'itemOptions' => [
        'tag' => false
    ]
])

?>
