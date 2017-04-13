<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Post;
use frontend\models\Tag;
use frontend\models\PostTag;



/* @var $this yii\web\View */
/* @var $model frontend\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value'=> Yii::$app->user->getId()])->label(false) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
 <?= $form->field($model, 'tag')->dropDownList($model->getTag() , array(     'multiple' => true, 'selected' => 'selected'))?>

    <?= $form->field($model, 'cat_id')->dropDownList($model->getCateg()) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
