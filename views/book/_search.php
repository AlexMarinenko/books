<?php

use app\models\Author;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $authors = ArrayHelper::map(Author::find()->orderBy('lastname')->all(), 'id', 'fullname') ?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <div class="row">
        <div class="col col-sm-4">
            <?= $form->field($model, 'author_id')->dropDownList($authors, array('label' => 'Author', 'class'=>'form-control') ) ?>
        </div>
        <div class="col col-sm-4">
            <?php echo $form->field($model, 'name') ?>
        </div>
    </div>

    <div class="row">
        <div class="col col-sm-4">
            <?= $form->field($model, 'date_published_from')->widget(
                DatePicker::className(), [
                'inline' => false,
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);?>
        </div>
        <div class="col col-sm-4">
            <?= $form->field($model, 'date_published_to')->widget(
                DatePicker::className(), [
                'inline' => false,
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);?>
        </div>
        <div class="col col-sm-4">
            <div>&nbsp;</div>
            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'id'=>'search']) ?>
                <?= Html::submitButton('Reset', ['class' => 'btn btn-default', 'name'=>'reset']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
