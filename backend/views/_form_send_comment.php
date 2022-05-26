<?php

use frontend\modules\tutorial\models\CommentForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $model_id */
/* @var $commentForm CommentForm */
/* @var $form ActiveForm */
/* @var $this yii\web\View */

?>

<div class="row signature form-send-comment">
  <div class="col-md-12">
    <p><?= Yii::t('site', 'Post a new comment'); ?></p>
      <?php $form = ActiveForm::begin(['id' => 'form-send-comment']); ?>
      <?= $form->field($commentForm, 'article_id')->hiddenInput(['value' => $model_id])->label(false) ?>
  </div>
  <div class="col-md-12">
    <div class="field">
        <?= $form->field($commentForm, 'text')->textarea(['style' => 'background-color: #242424; border: 0; padding: 12px 25px 13px; border-radius: 5px; color: #fff; resize: none;', 'rows' => 4, 'class' => 'form-control send-text', 'placeholder' => 'Enter the text here!', 'id' => 'comment'])->label(false) ?>
    </div>
  </div>
  <div class="col-md-6">
      <?= $form->field($commentForm, 'name')->textInput(['style' => 'background-color: #242424; border: 0; padding: 12px 25px 13px; border-radius: 5px; color: #fff', 'id' => 'name', 'class' => 'form-control send-name'])->label('Name') ?>
  </div>
  <div class="col-md-6">
      <?= $form->field($commentForm, 'email')->input('email', ['style' => 'background-color: #242424; border: 0; padding: 12px 25px 13px; border-radius: 5px; color: #fff', 'id' => 'email', 'class' => 'form-control send-email'])->label('Email') ?>
  </div>
  <div class="col-md-12">
      <?= Html::submitButton('Submit Comment', ['class' => 'btn btn-red']) ?>
      <?php ActiveForm::end(); ?>
  </div>
</div>
