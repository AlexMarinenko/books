<?php

use app\models\Author;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $authors = ArrayHelper::map(Author::find()->orderBy('lastname')->all(), 'id', 'fullname') ?>

<?php
    $this->registerJsFile('js/main.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">

        <div class="col col-sm-4">
            <?= $form->field($model, 'previewFile')->fileInput(array('id'=>'uploadCtl')) ?>
            <img id="preview" <?php if ($model->preview){ ?>src="<?= $model->getFullImage() ?>"<?php } ?> style="max-width: 200px;"/>
        </div>

        <div class="col col-sm-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'author_id')->dropDownList($authors, array('label' => 'Author', 'class'=>'form-control') ) ?>
            <?= $form->field($model, 'date_published')->widget(
                DatePicker::className(), [
                'inline' => false,
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);?>
        </div>

    </div>


    <div class="form-group">
        <br/>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

