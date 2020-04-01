<?php


namespace modules\dictionary\models\queries;


use yii\db\ActiveQuery;

class DictIndividualAchievementCgQuery extends ActiveQuery
{
    /**
     * @param  $individualAchievementId
     * @return $this
     */

    public function individualAchievementId($individualAchievementId)
    {
        return $this->andWhere(['individual_achievement_id' => $individualAchievementId]);
    }

}