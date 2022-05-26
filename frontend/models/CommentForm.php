<?php

namespace frontend\modules\tutorial\models;

use common\components\Country;
use common\models\tutorial\TutorialComment;
use Yii;
use yii\base\Model;

class CommentForm extends Model
{
    public $text;
    public $name;
    public $email;
    public $article_id;
    public $parent_id;
    public $ip;
    public $device_info;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['text', 'name', 'email'], 'required'],
            ['email', 'email'],
            [['text'], 'string', 'length' => [1, 2500]],
            [['article_id', 'parent_id'], 'integer'],
            [['name', 'email', 'ip', 'device_info'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return bool
     */
    public function saveComment()
    {
        $comment = new TutorialComment;
        $comment->status = 0;
        $comment->article_id = $this->article_id;
        $comment->text = $this->text;
        $comment->name = $this->name;
        $comment->email = $this->email;
        $comment->ip = Yii::$app->getRequest()->getUserIP();
        $comment->device_info = Yii::$app->getRequest()->getUserAgent();
        $comment->geoip_country = Country::geoIpCountry();
        $comment->geoip_region = Country::geoIpRegion();
        $comment->geoip_city = Country::geoIpCity();

        if ($this->parent_id !== null) {
            $comment->parent_id = $this->parent_id;
        } else {
            $comment->parent_id = null;
        }

        return $comment->save();
    }
}