<?php

use common\models\tutorial\TutorialComment;
use frontend\modules\tutorial\models\CommentForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $model_id */
/* @var $commentForm CommentForm */
/* @var $form ActiveForm */
/* @var $this yii\web\View */
/* @var $comments TutorialComment */

$this->registerJs(<<<JS
    const maxCommentCount = 5;

    $(document).ready(function() {
        $('.reply').hide();
    });

    $('.reply-button').on('click', function() {
          $('.reply').hide();
          $('.form-control').filter('.reply-text').val('');
          $('.form-control').filter('.reply-name').val('');
          $('.form-control').filter('.reply-email').val('');
          $('.field-comment').children('.help-block-error').html('');
          $('.field-name').children('.help-block-error').html('');
          $('.field-email').children('.help-block-error').html('');
          $(".reply").filter('.' + this.id).show();
    });
    
    $("#more").on('click', function() {
        let q = $("#more").attr('data'); 
        if (q == 0) {
            $('.show').removeAttr('hidden');
            $('.show').show();
            $("#more").text('Hide more comments');
            $("#more").attr('data', '1');
            
        } else {
            $('.show').hide();
            for (let i = 0; i < maxCommentCount; i++) {
                $('.show').filter('.' + i).show();
            }
            $("#more").text('Show more comments...');
            $("#more").attr('data', '0');
        }
    })
JS
);

?>

<div class="row signature">
  <div class="col-md-12">
    <p><?= Yii::t('site', 'Total comments') . ' (' . count($comments) . ')'; ?></p>
  </div>
    <?php foreach ($comments as $key => $comment) { ?>
      <div class="show <?= $key ?>" style="margin: 0px 0px 0px <?= $comment->updated_at * 30; ?>px" <?php if ($key > 4) echo 'hidden' ?>>
        <div class="col-md-12">
          <p style="font-size: large"><?= $comment->name ?></p>
          <p style="font-size: medium"><?= $comment->getDate(); ?></p>
        </div>
        <div class="col-md-12">
          <p><?= $comment->text; ?></p>
        </div>
        <div class="col-md-12">
          <p><?= Html::a('Reply', '#reply', ['class' => 'btn btn-outline-dark btn-secondary btn-sm reply-button', 'id' => "$comment->id"]) ?></p>
        </div>
        <div class="reply <?= $comment->id; ?>">
          <hr align="center" width="850" color="black"/>
            <?= $this->render('_form_reply_comment', [
                'model_id' => $model_id,
                'comment_id' => $comment->id,
                'updated_at' => $comment->updated_at,
                'commentForm' => $commentForm,
            ]) ?>
        </div>
        <hr align="center" width="850" color="black"/>
      </div>
    <?php } ?>
</div>

<?php if (count($comments) > 5) { ?>
  <div class="col-md-12" style="text-align: center">
      <?= Html::a('Show more comments...', '#reply', ['id' => 'more', 'data' => '0']) ?>
  </div>
<?php } ?>
