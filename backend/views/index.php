<?php

use common\models\tutorial\TutorialComment;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $comments TutorialComment */
/* @var $searchModel backend\modules\tutorial\models\TutorialCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Комментарии';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="tutorial-author-index">
  <div class="box box-success">
    <div class="box-body">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'article_id',
                    'value' => function (TutorialComment $model) {
                        return $model->article->defaultContent->title;
                    },
                ],
                [
                    'attribute' => 'status',
                    'value' => function (TutorialComment $model) {
                        return $model->getStatusLabel();
                    },
                ],
                [
                    'attribute' => 'text',
                    /*'value' => function (TutorialComment $model) {
                        return StringHelper::truncate($model->text, 50);
                    },*/
                ],
                'name',
                'email',
                [
                    'attribute' => 'created_at',
                    'value' => function (TutorialComment $model) {
                        return Yii::$app->formatter->asDatetime($model->created_at, 'php:d M Y H:i:s');
                    }
                ],
                [
                    'attribute' => 'updated_at',
                    'value' => function (TutorialComment $model) {
                        return Yii::$app->formatter->asDatetime($model->updated_at, 'php:d M Y H:i:s');
                    }
                ],
                'geoip_country',
                //'geoip_region',
                //'geoip_city',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{allow} {update}', //{delete}',
                    'buttons' => [
                        'allow' => function ($url, $model) {
                            if ($model->isAllowed()) {
                                return Html::a('<span class="glyphicon glyphicon-remove" title="Скрыть комментарий"></span>', Url::toRoute(['comment/disallow', 'id' => $model->id]));
                            } else {
                                return Html::a('<span class="glyphicon glyphicon-ok" title="Опубликовать комментарий"></span>', Url::toRoute(['comment/allow', 'id' => $model->id]));
                            }
                        },
                    ],
                ],
            ],

        ]); ?>
    </div>
  </div>
</div>
