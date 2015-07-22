<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('js/main.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            [
                'attribute' => 'preview',
                'value' => function ($data) { return Html::img($data->getIcon(), array('data-zoom' => $data->getFullImage(), 'class' => 'thumb-list')); },
                'format' => 'raw'
            ],
            [
                'attribute' => 'author.fullname',
                'label' => 'Author'
            ],
            [
                'attribute'=>'date_published',
                'format'=>['date', 'php:d-m-Y']
            ],
            [
            'attribute'=>'date_create',
            'format'=>['date', 'php:d-m-Y H:i:s']
            ],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $key){
                            $options = array_merge([
                                'title' => Yii::t('yii', 'View'),
                                'aria-label' => Yii::t('yii', 'View'),
                                'data-pjax' => '0',
                                'class' => 'ajax-details'
                            ], array());
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                    }
                ]
            ]
        ],
    ]); ?>

</div>
