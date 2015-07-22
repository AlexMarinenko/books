<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute'=>'date_create',
                'format'=>['date', 'php:d-m-Y H:i:s']
            ],
            [
                'attribute'=>'date_update',
                'format'=>['date', 'php:d-m-Y H:i:s']
            ],
            [
                'attribute'=>'preview',
                'value'=>$model->getIcon(),
                'format' => ['image',['width'=>'100','height'=>'100']]
            ],
            [
                'attribute'=>'date_published',
                'format'=>['date', 'php:d-m-Y']
            ],
            'author.fullname'
        ],
    ]) ?>

</div>
