<?php
namespace modules\entrant\helpers;
use common\helpers\EduYearHelper;
use modules\dictionary\helpers\DictIncomingDocumentTypeHelper;
use modules\entrant\models\Agreement;
use modules\entrant\models\OtherDocument;
use yii\helpers\ArrayHelper;

class OtherDocumentHelper
{
    public static function isExitsExemption($user_id): bool
    {
        return OtherDocument::find()->andWhere(['user_id' => $user_id, 'exemption_id'=> true])->exists();
    }

    public static function isExitsPatriot($user_id): bool
    {
        return OtherDocument::find()->andWhere(['user_id' => $user_id,'type'=> 43])->exists();
    }

    public static function isExitsMedicine($user_id): bool
    {
        return OtherDocument::find()->andWhere(['user_id' => $user_id,'type'=> DictIncomingDocumentTypeHelper::ID_MEDICINE])->exists();
    }

    public static function preemptiveRightUser($user_id, $type_id) {
        return OtherDocument::find()->joinWith('preemptiveRights')->andWhere(['user_id' => $user_id, 'type_id' => $type_id,
            'type'=> DictIncomingDocumentTypeHelper::rangeType(DictIncomingDocumentTypeHelper::TYPE_OTHER)])
            ->all();
    }

    public static function preemptiveRightExits($user_id) {
        return OtherDocument::find()->joinWith('preemptiveRights')->andWhere(['user_id' => $user_id,
            'type'=> DictIncomingDocumentTypeHelper::rangeType(DictIncomingDocumentTypeHelper::TYPE_OTHER)])
            ->exists();
    }

    public static function preemptiveRightAll($user_id) {
        return OtherDocument::find()->joinWith('preemptiveRights')->andWhere(['user_id' => $user_id,
            'type'=> DictIncomingDocumentTypeHelper::rangeType(DictIncomingDocumentTypeHelper::TYPE_OTHER)])
            ->all();
    }

    public static function listPreemptiveRightUser($user_id){
        return ArrayHelper::map(self::preemptiveRightAll($user_id), 'id', function ($model) {
            return  $model->otherDocumentFull  ." (". $model->typeName .")";
        });
    }
}