<?php
/** @var $channel \common\models\User */
/** @var $user \common\models\User */
?>

<p>Hello <?php echo $channel->username ?></p>
<p>
    User <?php echo \common\helpers\Html::channelLink($user, true) ?>
    has subscribed to your channel
</p>

<p>LeimaiTube Team</p>