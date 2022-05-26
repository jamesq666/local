<?php

use frontend\modules\tutorial\models\CommentForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $form ActiveForm */
/* @var $this yii\web\View */
/* @var $commentForm CommentForm */
/* @var $model_id */
/* @var $comment_id */
/* @var $updated_at */

$this->registerJs(<<<JS
    $('form').on('beforeSubmit', function() {
      let id = this.id;
      let data = $(this).serialize();
      $.post({
          url: '/forex-tutorial/comment',
          data: data,
          dataType: 'json',
          success: function() {
              $('#' + id)[0].reset();
              alert('Your comment will be added soon!');
              $('.reply').hide();
          },
          error: function(response) {
              if (response !== null) {
                    if (typeof response['responseJSON']['text'] !== "undefined") {
                        $('.' + id).find('.field-comment').children('.help-block-error').html(response['responseJSON']['text']['0']);
                    }
                    if (typeof response['responseJSON']['name'] !== "undefined") {
                        $('.' + id).find('.field-name').find('.help-block-error').html(response['responseJSON']['name']['0']);
                    }
                    if (typeof response['responseJSON']['email'] !== "undefined") {
                        $('.' + id).find('.field-email').children('.help-block-error').html(response['responseJSON']['email']['0']);
                    }
              }
          }
      });
      return false;
    });

    $('.cancel').on('click', function() {
        $('.reply').hide();
        $('.form-control').filter('.reply-text').val('');
        $('.form-control').filter('.reply-name').val('');
        $('.form-control').filter('.reply-email').val('');
        $('.field-comment').children('.help-block-error').html('');
        $('.field-name').children('.help-block-error').html('');
        $('.field-email').children('.help-block-error').html('');
    });
    
     $('.form-control').filter('.reply-text').keyup(function() {
         $('.field-comment').children('.help-block-error').html('');
     });
     $('.form-control').filter('.reply-name').keyup(function() {
         $('.field-name').children('.help-block-error').html('');
     });
     $('.form-control').filter('.reply-email').keyup(function() {
         $('.field-email').children('.help-block-error').html('');
     });
     $('.form-control').filter('.send-text').keyup(function() {
         $('.field-comment').children('.help-block-error').html('');
     });
     $('.form-control').filter('.send-name').keyup(function() {
         $('.field-name').children('.help-block-error').html('');
     });
     $('.form-control').filter('.send-email').keyup(function() {
         $('.field-email').children('.help-block-error').html('');
     });
     
JS
);

$this->registerCSS(<<<CSS
    help-block-error {
        color: #e52525;
        font-family: Montserrat;
        font-size: 10px;
        line-height: 12px;
        padding-left: 20px;
        margin-top: 10px;
    }

    reply-name reply-text reply-email send-text send-name send-email{
        border: 0;
        padding: 12px 25px 13px;
        border-radius: 5px;
        color: #fff;
    }
CSS
);
?>

<div class="row signature form-reply-comment<?= $comment_id ?>" style="margin: 0px 0px 0px <?= $updated_at * 30; ?>px">
  <div class="col-md-12">
    <p><?= Yii::t('site', 'Reply to comment'); ?></p>
      <?php $form = ActiveForm::begin(['id' => "form-reply-comment$comment_id"]); ?>
      <?= $form->field($commentForm, 'parent_id')->hiddenInput(['value' => $comment_id])->label(false) ?>
      <?= $form->field($commentForm, 'article_id')->hiddenInput(['value' => $model_id])->label(false) ?>
  </div>
  <div class="col-md-12">
    <div class="field">
        <?= $form->field($commentForm, 'text')->textarea(['style' => 'background-color: #242424; border: 0; padding: 12px 25px 13px; border-radius: 5px; color: #fff; resize: none', 'rows' => 3, 'class' => 'form-control reply-text', 'placeholder' => 'Enter the text here!', 'id' => 'comment'])->label(false) ?>
    </div>
  </div>
  <div class="col-md-6">
      <?= $form->field($commentForm, 'name')->textInput(['style' => 'background-color: #242424; border: 0; padding: 12px 25px 13px; border-radius: 5px; color: #fff', 'id' => 'name', 'class' => 'form-control reply-name'])->label('Name') ?>
  </div>
  <div class="col-md-6">
      <?= $form->field($commentForm, 'email')->input('email', ['style' => 'background-color: #242424; border: 0; padding: 12px 25px 13px; border-radius: 5px; color: #fff', 'id' => 'email', 'class' => 'form-control reply-email'])->label('Email') ?>
  </div>
  <div class="col-md-6">
      <?= Html::submitButton('Reply', ['class' => 'btn btn-red', 'id' => $comment_id]) ?>
      <?php ActiveForm::end(); ?>
  </div>
  <div class="col-md-6">
      <?= Html::button('Cancel', ['class' => 'btn btn-red cancel', 'id' => $comment_id]) ?>
  </div>
</div>
