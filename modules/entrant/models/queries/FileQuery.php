<?php

namespace modules\entrant\models\queries;


use yii\db\ActiveQuery;

class FileQuery extends ActiveQuery
{

    public function user($user)
    {
        return $this->andWhere(['user_id' => $user]);
    }

    public function model($name)
    {
        return $this->andWhere(['model' => $name]);
    }

    public function recordId($recordId)
    {
        return $this->andWhere(['record_id' => $recordId]);
    }

    public function defaultQueryUser($user, $modelName, $recordId) {
        return $this->user($user)->model($modelName)->recordId($recordId);

    }


}