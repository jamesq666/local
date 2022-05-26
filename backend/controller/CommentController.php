<?php

namespace backend\modules\tutorial\controllers;

use backend\modules\tutorial\models\TutorialCommentSearch;
use common\models\tutorial\TutorialComment;
use Yii;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CommentController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TutorialCommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return void|Response
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = TutorialComment::findOne($id);
        if ($model->delete()) {
            return $this->redirect(['index']);
        }
    }

    /**
     * @param $id
     * @return string|Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     * @return void|Response
     */
    public function actionAllow($id)
    {
        $model = TutorialComment::findOne($id);
        if ($model->allow()) {
            return $this->redirect(['index']);
        }
    }

    /**
     * @param $id
     * @return void|Response
     */
    public function actionDisallow($id)
    {
        $model = TutorialComment::findOne($id);
        if ($model->disallow()) {
            return $this->redirect(['index']);
        }
    }

    /**
     * @param $id
     * @return TutorialComment|null
     */
    protected function findModel($id)
    {
        if (($model = TutorialComment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}