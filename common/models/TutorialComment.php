<?php

namespace common\models\tutorial;

use Yii;
use yii\base\InvalidConfigException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tutorial_comment".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $article_id
 * @property integer $status
 * @property string $text
 * @property string $name
 * @property string $email
 * @property string $ip
 * @property string $device_info
 * @property string $geoip_country
 * @property string $geoip_region
 * @property string $geoip_city
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Article $article
 */
class TutorialComment extends ActiveRecord
{
    const STATUS_ALLOW = 1;
    const STATUS_DISALLOW = 0;

    public static function tableName()
    {
        return 'tutorial_comment';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['text', 'name', 'email'], 'required'],
            ['email', 'email'],
            [['article_id', 'status', 'parent_id', 'id'], 'integer'],
            [['name', 'email', 'ip', 'geoip_country', 'geoip_region', 'geoip_city', 'device_info'], 'string', 'max' => 255],
            [['text'], 'string', 'max' => 2500],
            [['created_at', 'updated_at'], 'safe'],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительский ID',
            'article_id' => 'Заголовок статьи',
            'status' => 'Статус',
            'text' => 'Текст комментария',
            'name' => 'Имя автора',
            'email' => 'E-mail автора',
            'ip' => 'IP адресс',
            'device_info' => 'Информация об устройстве',
            'geoip_country' => 'Страна',
            'geoip_region' => 'Область',
            'geoip_city' => 'Город',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->created_at);
    }

    /**
     * @return int
     */
    public function isAllowed()
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function allow()
    {
        $this->status = self::STATUS_ALLOW;
        return $this->save(false);
    }

    /**
     * @return bool
     */
    public function disallow()
    {
        $this->status = self::STATUS_DISALLOW;
        return $this->save(false);
    }

    /**
     * @return array
     */
    public static function getStatusLabels()
    {
        return [
            self::STATUS_ALLOW => Yii::t('site', 'Опубликован'),
            self::STATUS_DISALLOW => Yii::t('site', 'Скрыт'),
        ];
    }

    /**
     * @return mixed
     */
    public function getStatusLabel()
    {
        return ArrayHelper::getValue(self::getStatusLabels(), $this->status, null);
    }
}
