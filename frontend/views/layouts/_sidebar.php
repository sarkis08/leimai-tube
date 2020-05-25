<aside class="shadow">
    <?php echo \yii\bootstrap4\Nav::widget([
        'options' => [
            'class' => 'd-flex flex-column nav-pills'
        ],
        'items' => [
            [
                'label' => 'Home',
                'url' => ['/video/index']
            ],
            [
                'label' => 'History',
                'url' => ['/video/history']
            ]
        ]
    ])

    ?>
</aside>

<!--<div class="list-group">-->
<!--    <button type="button" class="list-group-item list-group-item-action active">-->
<!--        Cras justo odio-->
<!--    </button>-->
<!--    <button type="button" class="list-group-item list-group-item-action">Dapibus ac facilisis in</button>-->
<!--    <button type="button" class="list-group-item list-group-item-action">Morbi leo risus</button>-->
<!--    <button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button>-->
<!--    <button type="button" class="list-group-item list-group-item-action" disabled>Vestibulum at eros</button>-->
<!--</div>-->
