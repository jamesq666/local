<?php

use common\models\tutorial\Article;
use common\models\tutorial\TutorialComment;
use frontend\modules\tutorial\models\CommentForm;
use yii\bootstrap\ActiveForm;

/* @var $model Article */
/* @var $commentForm CommentForm */
/* @var $this yii\web\View */
/* @var $comments TutorialComment */
/* @var $form ActiveForm */

?>

<?php if (!empty($comments)) { ?>
    <?= $this->render('_form_view_comment', [
        'model_id' => $model->id,
        'commentForm' => $commentForm,
        'comments' => $comments,
    ]) ?>
<?php } else { ?>
  <div class="col-md-12">
    <p><?= Yii::t('site', 'There are no comments posted yet. Be the first one!'); ?></p>
  </div>
<?php } ?>
<?= $this->render('_form_send_comment', [
    'model_id' => $model->id,
    'commentForm' => $commentForm,
]) ?>
