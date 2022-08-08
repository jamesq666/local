<?php

use common\models\tutorial\TutorialComment;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $model TutorialComment */

$this->title = 'Изменить комментарий';
$this->params['breadcrumbs'][] = 'Изменить';
?>

<div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'article_id')->textInput(['disabled' => 'disabled', 'value' => $model->article->defaultContent->title,]) ?>
    <?= $form->field($model, 'status')->dropDownList(TutorialComment::getStatusLabels()) ?>
    <?= $form->field($model, 'text')->textArea() ?>
    <?= $form->field($model, 'name')->textInput(['disabled' => 'disabled']) ?>
    <?= $form->field($model, 'email')->textInput(['disabled' => 'disabled']) ?>
    <?= $form->field($model, 'ip')->textInput(['disabled' => 'disabled']) ?>
    <?= $form->field($model, 'geoip_country')->textInput(['disabled' => 'disabled']) ?>
    <?= $form->field($model, 'geoip_region')->textInput(['disabled' => 'disabled']) ?>
    <?= $form->field($model, 'geoip_city')->textInput(['disabled' => 'disabled']) ?>
    <?= $form->field($model, 'device_info')->textInput(['disabled' => 'disabled']) ?>
    <?= $form->field($model, 'created_at')->textInput(['disabled' => 'disabled', 'value' => Yii::$app->formatter->asDatetime($model->updated_at, 'php:d.m.Y H:i:s'),]) ?>
    <?= $form->field($model, 'updated_at')->textInput(['disabled' => 'disabled', 'value' => Yii::$app->formatter->asDatetime($model->updated_at, 'php:d.m.Y H:i:s'),]) ?>

  <div>
      <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary']) ?>
  </div>

    <?php ActiveForm::end(); ?>

</div>
