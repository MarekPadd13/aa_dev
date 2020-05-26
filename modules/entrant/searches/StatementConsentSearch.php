<?php
namespace modules\entrant\searches;

use modules\entrant\models\Statement;
use modules\entrant\models\StatementCg;
use modules\entrant\models\StatementConsentCg;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class StatementConsentSearch extends  Model
{
    public  $faculty_id, $speciality_id, $edu_level, $special_right, $cg, $user_id, $date_from, $date_to;

    public function rules()
    {
        return [
            [['user_id', 'faculty_id', 'speciality_id', 'edu_level', 'special_right', 'cg', 'user_id'], 'integer'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }
    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = StatementConsentCg::find()->alias('consent')->statusNoDraft('consent.')->orderByCreatedAtDesc();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([

        ]);

        $query->innerJoin(StatementCg::tableName() . ' cg', 'cg.id = consent.statement_cg_id');
        $query->innerJoin(Statement::tableName() . ' statement', 'statement.id = cg.statement_id');

        if (!empty($this->user_id)) {
            $query->andWhere(['statement.user_id' => $this->user_id]);
        }

        if (!empty($this->faculty_id)) {
            $query->andWhere(['statement.faculty_id' => $this->faculty_id]);
        }

        $query
            ->andFilterWhere(['>=', 'consent.created_at', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
            ->andFilterWhere(['<=', 'consent.created_at', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null]);

        return $dataProvider;
    }

    public function attributeLabels()
    {
        return [
            'faculty_id' => "Факультет",
//            'speciality_id' => "Направление подготовки",
//            'edu_level' => "Уровень образования",
//            'special_right' => "Основание приема",
            'user_id'=> "Абитуриент",
            'created_at' => "Дата создания"
        ];
    }




}