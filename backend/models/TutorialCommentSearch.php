<?php

namespace backend\modules\tutorial\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\tutorial\TutorialComment;

/**
 * TutorialCommentSearch represents the model behind the search form of `common\models\tutorial\TutorialComment`.
 */
class TutorialCommentSearch extends TutorialComment
{
    public $id;
    public $article_id;
    public $status;
    public $text;
    public $name;
    public $email;
    public $geoip_city;
    public $geoip_country;
    public $geoip_region;
    public $created_at;
    public $updated_at;

    /**
     * @return array[]
     */
    public function rules()
    {
        return [
            [['id', 'article_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['text', 'name', 'email', 'geoip_city', 'geoip_region', 'geoip_country'], 'string'],
        ];
    }

    /**
     * @return array|array[]
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TutorialComment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'article_id' => $this->article_id,
            'status' => $this->status,
            'text' => $this->text,
            'name' => $this->name,
            'email' => $this->email,
            'geoip_country' => $this->geoip_country,
            'geoip_region' => $this->geoip_region,
            'geoip_sity' => $this->geoip_city,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
